@extends('layouts.master')

@section('title', 'Tạo nhân viên')

@section('file', 'admin.team.create')

@section('page', 'admin.team.create')

@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Thêm nhân viên mới</h1>
            <a href="{{ route('admin.team.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Quay
                lại trang Quản lý nhân viên</a>
            <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên nhân viên</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="position" class="block text-sm font-medium text-gray-700">Chức vụ</label>
                    <input type="text" name="position" id="position" value="{{ old('position') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="exp" class="block text-sm font-medium text-gray-700">Kinh nghiệm làm việc (năm)</label>
                    <input type="number" name="exp" id="exp" value="{{ old('exp') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email cá nhân</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
                    <input type="url" name="facebook" id="facebook" value="{{ old('facebook') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="twitter" class="block text-sm font-medium text-gray-700">Twitter</label>
                    <input type="url" name="twitter" id="twitter" value="{{ old('twitter') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                    <input type="url" name="instagram" id="instagram" value="{{ old('instagram') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="linkedin" class="block text-sm font-medium text-gray-700">LinkedIn</label>
                    <input type="url" name="linkedin" id="linkedin" value="{{ old('linkedin') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu</button>
                <button onclick="location.href='{{ route('admin.team.index') }}'" type="button"
                    class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Quay lại</button>
            </form>
        </div>
    </main>
@endsection
