{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Tạo bài viết')

{{-- Đặt file css cho page --}}
@section('file', 'admin.services.create')

{{-- Đặt class cho body --}}
@section('page', 'admin.services.create')
@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Thêm bài viết mới</h1>
            <a href="{{ route('admin.services.index') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Quay
                lại trang Quản lý bài viết</a>
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên bài viết</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md"
                        required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Nội dung</label>
                    <textarea name="content" id="content" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="position" class="block text-sm font-medium text-gray-700">Tên danh mục</label>
                    <input type="text" name="position" id="position" class="mt-1 block w-full border-gray-300 rounded-md"
                        required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu</button>
                <button onclick="location.href='{{ route('admin.services.index') }}'" type="button"
                    class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Quay lại</button>
            </form>
        </div>
    </main>
@endsection
