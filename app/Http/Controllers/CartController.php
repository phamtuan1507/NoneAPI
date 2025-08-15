<?php
namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        $total     = CartItem::where('user_id', Auth::id())
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->sum(DB::raw('products.price * cart_items.quantity'));

        return view('cart', [
            'cartItems' => $cartItems,
            'total'     => $total,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $cartItem    = CartItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
            $action      = $request->input('action');
            $quantity    = $request->input('quantity', $cartItem->quantity);
            $maxQuantity = $cartItem->product->quantity;

            if ($action === 'decrease' && $cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } elseif ($action === 'increase' && $cartItem->quantity < $maxQuantity) {
                $cartItem->increment('quantity');
            } elseif ($quantity >= 1 && $quantity <= $maxQuantity) {
                $cartItem->update(['quantity' => $quantity]);
            } else {
                return response()->json(['success' => false, 'message' => "Số lượng tối đa trong kho là {$maxQuantity} cho {$cartItem->product->name}!"], 400);
            }

            $newTotal = CartItem::where('user_id', Auth::id())
                ->join('products', 'cart_items.product_id', '=', 'products.id')
                ->sum(DB::raw('products.price * cart_items.quantity'));

            $cartCount = CartItem::where('user_id', Auth::id())->sum('quantity');

            return response()->json([
                'success'       => true,
                'message'       => 'Số lượng đã được cập nhật!',
                'product_price' => number_format($cartItem->product->price, 0, '', ''),
                'quantity'      => $cartItem->quantity,
                'total'         => $newTotal,
                'cart_count'    => $cartCount,
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật giỏ hàng: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi cập nhật số lượng.'], 500);
        }
    }

    public function remove($id)
    {
        try {
            $cartItem    = CartItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
            $productName = $cartItem->product->name;

            // Xóa hình ảnh nếu có
            if ($cartItem->product->image) {
                Storage::disk('public')->delete($cartItem->product->image);
            }
            foreach ($cartItem->product->additionalImages as $image) {
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }

            $cartItem->delete();

            $newTotal = CartItem::where('user_id', Auth::id())
                ->join('products', 'cart_items.product_id', '=', 'products.id')
                ->sum(DB::raw('products.price * cart_items.quantity'));

            $cartCount = CartItem::where('user_id', Auth::id())->sum('quantity');

            return response()->json([
                'success'    => true,
                'message'    => "Sản phẩm '{$productName}' đã được xóa khỏi giỏ hàng!",
                'total'      => $newTotal,
                'cart_count' => $cartCount,
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa sản phẩm khỏi giỏ hàng: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi xóa sản phẩm.'], 500);
        }
    }

    public function store(Request $request, $productId)
    {
        try {
            $product  = Product::findOrFail($productId);
            $quantity = $request->input('quantity', 1);
            $userId   = Auth::id();

            $cartItem = CartItem::where('user_id', $userId)->where('product_id', $productId)->first();

            if ($cartItem) {
                if ($cartItem->quantity + $quantity <= $product->quantity) {
                    $cartItem->increment('quantity', $quantity);
                } else {
                    return response()->json(['success' => false, 'message' => "Số lượng tối đa trong kho là {$product->quantity} cho {$product->name}!"], 400);
                }
            } else {
                if ($quantity <= $product->quantity) {
                    CartItem::create([
                        'user_id'    => $userId,
                        'product_id' => $productId,
                        'quantity'   => $quantity,
                    ]);
                } else {
                    return response()->json(['success' => false, 'message' => "Số lượng vượt quá tồn kho!"], 400);
                }
            }

            $newCount = CartItem::where('user_id', $userId)->sum('quantity');
            return response()->json([
                'success' => true,
                'message' => "{$product->name} đã được thêm vào giỏ hàng!",
                'count'   => $newCount,
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi trong CartController@store: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi thêm sản phẩm.'], 500);
        }
    }

    public function count()
    {
        try {
            $count = Auth::check() ? CartItem::where('user_id', Auth::id())->sum('quantity') : 0;
            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi lấy số lượng giỏ hàng: ' . $e->getMessage());
            return response()->json(['count' => 0]);
        }
    }
}
