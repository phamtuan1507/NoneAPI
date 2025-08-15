<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        $subTotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $total = $subTotal; // Add shipping or tax logic if needed

        return view('checkout', [
            'cartItems' => $cartItems,
            'subTotal' => $subTotal,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ho' => 'required|string|max:255',
            'ten' => 'required|string|max:255',
            'tenCongTy' => 'nullable|string|max:255',
            'soDienThoai' => 'required|string|max:20',
            'diaChiEmail' => 'required|email|max:255',
            'quocGia' => 'required|in:Vietnam,US,CA,FR,DE',
            'diaChi' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'tax' => 'required|string|max:20',
            'taxAdress' => 'required|string|max:255',
            'orderNotes' => 'nullable|string',
            'createAccount' => 'boolean',
            'paymentMethod' => 'required|array|min:1',
            'paymentMethod.*' => 'in:bank,cash',
        ]);

        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORDER-' . rand(1000, 9999),
            'total_amount' => $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            }),
            'status' => 'pending',
            'payment_method' => $request->input('paymentMethod')[0],
            'billing_name' => trim($request->input('ho') . ' ' . $request->input('ten')),
            'billing_company' => $request->input('tenCongTy'),
            'billing_address1' => $request->input('diaChi'),
            'billing_address2' => $request->input('apartment'),
            'billing_city' => $request->input('taxAdress'),
            'billing_postal_code' => $request->input('tax'),
            'billing_phone' => $request->input('soDienThoai'),
            'billing_email' => $request->input('diaChiEmail'),
            'billing_country' => $request->input('quocGia'),
            'notes' => $request->input('orderNotes'),
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
            $item->delete(); // Clear cart item after order
        }

        return redirect()->route('order.received', ['orderId' => $order->id])->with('success', 'Đơn hàng đã được đặt thành công!');
    }
    public function received($orderId)
{
    return view('order-received', ['orderId' => $orderId]);
}
}
