<?php
namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        $subTotal  = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $total = $subTotal; // Add shipping or tax logic if needed

        return view('checkout', [
            'cartItems' => $cartItems,
            'subTotal'  => $subTotal,
            'total'     => $total,
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Validate form data
            $request->validate([
                'ho'          => 'required|string|max:255',
                'ten'         => 'required|string|max:255',
                'soDienThoai' => 'required|string|max:20',
                'diaChiEmail' => 'required|email|max:255',
                'quocGia'     => 'required|in:Vietnam,US,CA,FR,DE',
                'diaChi'      => 'required|string|max:255',
                'tax'         => 'required|string|max:10',
                'taxAdress'   => 'required|string|max:255',
                'orderNotes'  => 'nullable|string',
            ]);

            // Lấy thông tin giỏ hàng (giả sử bạn có $cartItems từ session hoặc database)
            $cartItems = session()->get('cart', []);
            $total     = 0;
            foreach ($cartItems as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // Chuẩn bị dữ liệu cho VNPay
            $vnp_Url        = env('VN_VNP_URL', 'http://sandbox.vnpayment.vn/paymentv2/vpcpay.html');
            $vnp_Returnurl  = route('checkout.return'); // Định nghĩa route trả về
            $vnp_TmnCode    = env('VN_TMN_CODE', 'UDOPNWS1');
            $vnp_HashSecret = env('VN_HASH_SECRET', 'EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN');
            $vnp_TxnRef     = time(); // Mã giao dịch, nên lưu vào database
            $vnp_OrderInfo  = 'Thanh toan don hang #' . $vnp_TxnRef;
            $vnp_Amount     = $total * 100; // Số tiền * 100 (VND)
            $vnp_Locale     = 'vn';
            $vnp_IpAddr     = $request->ip();
            $vnp_OrderType  = 'other';

            // Tạo URL thanh toán
            $inputData = [
                'vnp_Version'    => '2.1.0',
                'vnp_Command'    => 'pay',
                'vnp_TmnCode'    => $vnp_TmnCode,
                'vnp_Amount'     => $vnp_Amount,
                'vnp_CreateDate' => date('YmdHis'),
                'vnp_CurrCode'   => 'VND',
                'vnp_IpAddr'     => $vnp_IpAddr,
                'vnp_Locale'     => $vnp_Locale,
                'vnp_OrderInfo'  => $vnp_OrderInfo,
                'vnp_OrderType'  => $vnp_OrderType,
                'vnp_ReturnUrl'  => $vnp_Returnurl,
                'vnp_TxnRef'     => $vnp_TxnRef,
            ];

            ksort($inputData);
            $query          = http_build_query($inputData);
            $hashData       = $vnp_HashSecret . $query;
            $vnp_SecureHash = hash('sha256', $hashData);
            $vnp_Url .= '?' . $query . '&vnp_SecureHash=' . $vnp_SecureHash;

            // Lưu thông tin đơn hàng vào database (tùy chọn)
            // Ví dụ: Order::create([...]);

            // Chuyển hướng đến VNPay
            return redirect($vnp_Url);

        } catch (\Exception $e) {
            Log::error('Lỗi khi xử lý thanh toán: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xử lý thanh toán. Vui lòng thử lại.');
        }
    }

    public function return (Request $request)
    {
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $inputData      = $request->all();
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData   = env('VN_HASH_SECRET', 'EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN') . http_build_query($inputData);
        $secureHash = hash('sha256', $hashData);

        if ($secureHash === $vnp_SecureHash) {
            if ($request->input('vnp_ResponseCode') === '00') {
                // Thanh toán thành công
                $vnp_TxnRef = $request->input('vnp_TxnRef');
                // Cập nhật trạng thái đơn hàng trong database
                // Ví dụ: Order::where('transaction_id', $vnp_TxnRef)->update(['status' => 'paid']);
                return redirect()->route('checkout.success')->with('success', 'Thanh toán thành công!');
            } else {
                // Thanh toán thất bại
                return redirect()->route('checkout.failure')->with('error', 'Thanh toán thất bại. Mã lỗi: ' . $request->input('vnp_ResponseCode'));
            }
        } else {
            // Hash không khớp, có thể bị thay đổi dữ liệu
            return redirect()->route('checkout.failure')->with('error', 'Dữ liệu thanh toán không hợp lệ.');
        }
    }
    public function received($orderId)
    {
        return view('order-received', ['orderId' => $orderId]);
    }
}
