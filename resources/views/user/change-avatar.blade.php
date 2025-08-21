@extends('layouts.master')

@section('title', 'Đổi ảnh đại diện')

@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Đổi ảnh đại diện</h1>
            <form action="{{ route('change-avatar') }}" method="POST" enctype="multipart/form-data" class="max-w-md">
                @csrf
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Ảnh đại diện mới</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md"
                        accept="image/*" required>
                </div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Cập nhật
                    ảnh</button>
                <a href="{{ route('profile') }}" class="ml-4 text-gray-600 hover:text-gray-800">Quay lại</a>
            </form>
        </div>
    </main>
@endsection
