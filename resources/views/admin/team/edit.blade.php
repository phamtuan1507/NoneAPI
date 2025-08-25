@extends('layouts.master')

@section('title', 'Sửa nhân viên')

@section('file', 'admin.team.edit')

@section('page', 'admin.team.edit')

@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Sửa nhân viên</h1>
            <a href="{{ route('admin.team.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Quay
                lại trang Quản lý nhân viên</a>
            <form action="{{ route('admin.team.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên nhân viên</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $staff->name) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="position" class="block text-sm font-medium text-gray-700">Chức vụ</label>
                    <input type="text" name="position" id="position" value="{{ old('position', $staff->position) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description', $staff->description) }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="exp" class="block text-sm font-medium text-gray-700">Kinh nghiệm làm việc</label>
                    <input type="text" name="exp" id="exp" value="{{ old('exp', $staff->exp) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $staff->phone) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email cá nhân</label>
                    <input type="text" name="email" id="email" value="{{ old('email', $staff->email) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
                    <input type="text" name="facebook" id="facebook" value="{{ old('facebook', $staff->facebook) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="twitter" class="block text-sm font-medium text-gray-700">Twitter</label>
                    <input type="text" name="twitter" id="twitter" value="{{ old('twitter', $staff->twitter) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                    <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $staff->instagram) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="linkedin" class="block text-sm font-medium text-gray-700">linkedin</label>
                    <input type="text" name="linkedin" id="linkedin" value="{{ old('linkedin', $staff->linkedin) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                    @if ($staff->image)
                        <img src="{{ asset('storage/' . $staff->image) }}" alt="{{ $staff->name }}"
                            class="w-16 h-16 object-cover mb-2">
                    @else
                        <p class="mb-2 text-gray-500">Không có hình ảnh</p>
                    @endif
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu</button>
                <button onclick="location.href='{{ route('admin.team.index') }}'" type="button"
                    class="bg-blue-500 text-white px-4 py-2 rounded">Quay lại</button>
            </form>
        </div>
    </main>
@endsection
