@extends('layouts.master')

@section('title', 'Chỉnh sửa thông tin cá nhân')

@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Chỉnh sửa thông tin cá nhân</h1>
            <form action="{{ route('edit-profile') }}" method="POST" enctype="multipart/form-data" class="max-w-md">
                @csrf
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">Tên</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Họ</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Ảnh đại diện mới</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md">
                    @if ($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Current Avatar" class="w-24 h-24 object-cover mt-2 rounded-full">
                    @endif
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cập nhật thông tin</button>
                <a href="{{ route('profile') }}" class="ml-4 text-gray-600 hover:text-gray-800">Quay lại</a>
            </form>
        </div>
    </main>
@endsection
