<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminStaffSkillController extends Controller
{
    // Hiển thị form thêm kỹ năng cho nhân viên
    public function create($staffId)
    {
        $staff = Staff::findOrFail($staffId);
        return view('admin.team.create-skill', compact('staff'));
    }

    // Lưu kỹ năng mới
    public function store(Request $request, $staffId)
    {
        try {
            $request->validate([
                'skill_name' => 'required|string|max:255',
                'percentage' => 'required|integer|min:0|max:100',
                'description' => 'nullable|string',
            ]);

            $staff = Staff::findOrFail($staffId);
            $staff->skills()->create($request->all());

            return redirect()->route('admin.team.show', $staffId)->with('success', 'Kỹ năng đã được thêm thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm kỹ năng: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi thêm kỹ năng. Vui lòng thử lại. Chi tiết: ' . $e->getMessage())->withInput();
        }
    }
}
