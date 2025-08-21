<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $sort  = $request->query('sort', 'default');
        $query = Blog::query();

        if ($sort === 'price') {
            $query->orderBy('price', 'asc');
        }

        $blogs = $query->paginate(12);

        return view('blogs', compact('blogs'));
    }

    public function detail($id)
    {
        $post                = Blog::with(['category', 'comments', 'comments.user'])->findOrFail($id);
        $post->comment_count = $post->comments->count();

        // Fetch recent posts
        $recentPosts = Blog::with(['comments'])
            ->withCount('comments')
            ->latest()
            ->where('id', '!=', $id)
            ->take(5)
            ->get();

        // Fetch categories
        $categories = Category::where('type', 'blog')
            ->withCount('blogs')
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'no'   => $category->blogs_count,
                ];
            });
        $allCount = Blog::count();

        // Format createTime
        $post->createTime = \Carbon\Carbon::parse($post->created_at)->format('d Tháng m, Y');

        return view('blogs-detail', compact('post', 'recentPosts', 'categories', 'allCount'));
    }
    public function comment(Request $request, $id)
    {
        if (! auth()->check()) {
            return redirect()->back()->with('error', 'Vui lòng đăng nhập để gửi bình luận.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        try {
            $blog = Blog::findOrFail($id);
            $blog->comments()->create([
                'user_id' => auth()->id(),
                'content' => $request->input('content'),
                'status'  => 'pending',
            ]);

            return redirect()->back()->with('success', 'Bình luận đã được gửi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi gửi bình luận: ' . $e->getMessage());
        }
    }
}
