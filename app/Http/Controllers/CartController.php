<?php
namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        $total     = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart', [
            'cartItems' => $cartItems,
            'total'     => $total,
        ]);
    }

    public function update(Request $request, $id)
    {
        $cartItem    = CartItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $action      = $request->input('action');
        $maxQuantity = $cartItem->product->quantity;

        if ($action === 'decrease' && $cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } elseif ($action === 'increase' && $cartItem->quantity < $maxQuantity) {
            $cartItem->increment('quantity');
        } else {
            return response()->json(['success' => false, 'message' => "Số lượng tối đa trong kho là {$maxQuantity} cho {$cartItem->product->name}!"], 400);
        }

        return response()->json(['success' => true, 'message' => 'Số lượng đã được cập nhật!']);
    }

    public function remove($id)
    {
        $cartItem = CartItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cartItem->delete();

        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!']);
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
                CartItem::create([
                    'user_id'    => $userId,
                    'product_id' => $productId,
                    'quantity'   => $quantity,
                ]);
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
        $count = CartItem::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['count' => $count]);
    }
}
