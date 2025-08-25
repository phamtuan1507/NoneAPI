<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sv = Service::paginate(10);
        return view('admin.services.index', compact('sv')); //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sv = Service::all();
        return view('admin.services.create', compact('sv'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'        => 'required|string|max:255',
                'position'    => 'required|string|max:255',
                'description' => 'nullable|string',
                'content'     => 'required|string',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('services', 'public');
            }

            $staff = Service::create($data);

            return redirect()->route('admin.services.index')->with('success', 'Nhân viên đã được tạo thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo nhân viên: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tạo nhân viên. Vui lòng thử lại. Chi tiết: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staff = Service::findOrFail($id);
        return view('admin.services.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $staff = Service::findOrFail($id);

            $request->validate([
                'name'        => 'required|string|max:255',
                'position'    => 'required|string|max:255',
                'description' => 'nullable|string',
                'content'     => 'required|string',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->all();
            if ($request->hasFile('image')) {
                if ($staff->image) {
                    Storage::disk('public')->delete($staff->image);
                }
                $data['image'] = $request->file('image')->store('services', 'public');
            }

            $staff->update($data);

            return redirect()->route('admin.services.index')->with('success', 'Nhân viên đã được cập nhật!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật nhân viên: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật nhân viên. Vui lòng thử lại. Chi tiết: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $blog = Service::findOrFail($id);
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->delete(); // Loại bỏ xử lý additionalImages

            return redirect()->route('admin.services.index')->with('success', 'Bài viết đã được xóa!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa bài viết: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa bài viết. Vui lòng thử lại.');
        }
    }
}
