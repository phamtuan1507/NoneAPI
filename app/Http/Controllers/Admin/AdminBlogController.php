<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->paginate(12);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title'       => 'required|string|max:255',
                'description' => 'nullable|string',
                'content'     => 'nullable|string',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'nullable|exists:categories,id',
            ]);

            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('blogs', 'public');
            }

            $blog = Blog::create($data);

            return redirect()->route('admin.blogs.index')->with('success', 'Bài viết đã được tạo!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo bài viết: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tạo bài viết. Vui lòng thử lại.');
        }
    }

    public function edit($id)
    {
        $blog       = Blog::findOrFail($id); // Loại bỏ with('additionalImages')
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            $request->validate([
                'title'       => 'required|string|max:255',
                'description' => 'nullable|string',
                'content'     => 'nullable|string',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'nullable|exists:categories,id',
            ]);

            $data = $request->all();
            if ($request->hasFile('image')) {
                if ($blog->image) {
                    Storage::disk('public')->delete($blog->image);
                }
                $data['image'] = $request->file('image')->store('blogs', 'public');
            }

            $blog->update($data);

            return redirect()->route('admin.blogs.index')->with('success', 'Bài viết đã được cập nhật!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật bài viết: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật bài viết. Vui lòng thử lại.');
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->delete(); // Loại bỏ xử lý additionalImages

            return redirect()->route('admin.blogs.index')->with('success', 'Bài viết đã được xóa!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa bài viết: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa bài viết. Vui lòng thử lại.');
        }
    }
}
