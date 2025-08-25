<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminStaffController extends Controller
{

    public function index()
    {
        $staffs = Staff::paginate(10);
        return view('admin.team.index', compact('staffs'));
    }

    public function create()
    {
        $categories = Staff::all();
        return view('admin.team.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'        => 'required|string|max:255',
                'position'    => 'required|string|max:255',
                'description' => 'nullable|string',
                'exp'         => 'required|integer|min:0',
                'phone'       => 'required|string|max:20',
                'email'       => 'required|email|unique:staffs,email',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'facebook'    => 'nullable|url',
                'twitter'     => 'nullable|url',
                'instagram'   => 'nullable|url',
                'linkedin'    => 'nullable|url',
            ]);

            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('team', 'public');
            }

            $staff = Staff::create($data);

            return redirect()->route('admin.team.index')->with('success', 'Nhân viên đã được tạo thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo nhân viên: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tạo nhân viên. Vui lòng thử lại. Chi tiết: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.team.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        try {
            $staff = Staff::findOrFail($id);

            $request->validate([
                'name'        => 'required|string|max:255',
                'description' => 'nullable|string',
                'position'    => 'nullable|string',
                'exp'         => 'nullable|integer', // Đổi thành integer nếu kinh nghiệm là số
                'phone'       => 'nullable|string',
                'email'       => 'nullable|email',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'facebook'    => 'nullable|url',
                'twitter'     => 'nullable|url',
                'instagram'   => 'nullable|url',
                'website'     => 'nullable|url',
            ]);

            $data = $request->all();
            if ($request->hasFile('image')) {
                if ($staff->image) {
                    Storage::disk('public')->delete($staff->image);
                }
                $data['image'] = $request->file('image')->store('team', 'public');
            }

            $staff->update($data);

            return redirect()->route('admin.team.index')->with('success', 'Nhân viên đã được cập nhật!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật nhân viên: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật nhân viên. Vui lòng thử lại. Chi tiết: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Staff::findOrFail($id);
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->delete(); // Loại bỏ xử lý additionalImages

            return redirect()->route('admin.team.index')->with('success', 'Bài viết đã được xóa!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa bài viết: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa bài viết. Vui lòng thử lại.');
        }

    }
    public function show($id)
    {
        try {
            $staff = Staff::with('skills')->findOrFail($id);

            // Chuyển đổi skills thành mảng để hiển thị
            $skills        = $staff->skills->pluck('percentage', 'skill_name')->toArray();
            $staff->skills = $skills;

            return view('admin.team.show', compact('staff'));
        } catch (\Exception $e) {
            Log::error('Lỗi khi lấy chi tiết nhân viên: ' . $e->getMessage());
            return redirect()->route('admin.team.index')->with('error', 'Đã xảy ra lỗi khi tải chi tiết nhân viên.');
        }
    }

}
