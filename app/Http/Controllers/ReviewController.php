<?php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|between:1,5',
            'comment'    => 'nullable|string',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
        ]);

        $review = Review::create([
            'product_id' => $request->product_id,
            'user_id'    => auth()->check() ? auth()->id() : null,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
            'name'       => $request->name,
            'email'      => $request->email,
        ]);

        return response()->json(['success' => true, 'message' => 'Đánh giá đã được gửi thành công!']);
    }
}
