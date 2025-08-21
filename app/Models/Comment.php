<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'blog_id',
        'user_id', // Giả định bình luận có thông tin người dùng
        'content',
        'status', // Ví dụ: approved, pending
    ];

    /**
     * Get the blog that the comment belongs to.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * Get the user that created the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Giả định dùng model User mặc định của Laravel
    }
}
