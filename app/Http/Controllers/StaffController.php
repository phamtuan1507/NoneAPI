<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function index()
    {
        $team = Staff::paginate(10);
        return view('team', compact('team'));
    }

    public function show($id)
    {
        try {
            $expert = Staff::with('skills')->findOrFail($id);

            // Chuyển đổi skills từ bảng staff_skills sang mảng
            $skills = $expert->skills->pluck('percentage', 'skill_name')->toArray();
            $expert->skills = $skills;

            return view('team-details', compact('expert'));
        } catch (\Exception $e) {
            Log::error('Lỗi khi lấy chi tiết chuyên gia: ' . $e->getMessage());
            return redirect()->route('team.show')->with('error', 'Đã xảy ra lỗi khi tải chi tiết chuyên gia.');
        }
        // Logic to retrieve and display a specific team member's details
        // return view('team-details', ['id' => $id]);
    }
}
