<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function index()
    {
        $team = Service::paginate(10);
        return view('services', compact('team'));
    }

    public function show($id)
    {
        $staff = Service::findOrFail($id);

        // Log the staff view
        Log::info('Staff viewed', ['staff_id' => $id, 'name' => $staff->name]);

        return view('services-detail', compact('staff'));
    }
}
