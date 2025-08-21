<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:2048', // Giới hạn 2MB
        ]);

        $path = $request->file('upload')->store('blogs', 'public');
        $url = Storage::url($path);

        return response()->json(['url' => $url]);
    }
}
