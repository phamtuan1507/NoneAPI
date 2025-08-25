{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Tạo bài viết')

{{-- Đặt file css cho page --}}
@section('file', 'admin.services.edit')

{{-- Đặt class cho body --}}
@section('page', 'admin.services.edit')
@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Thêm bài viết mới</h1>
            <a href="{{ route('admin.services.index') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Quay
                lại trang Quản lý bài viết</a>
            <form action="{{ route('admin.services.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên bài viết</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $staff->name) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description', $staff->description) }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Nội dung</label>
                    <textarea name="content" id="content" class="mt-1 block w-full border-gray-300 rounded-md">
                        {!! $staff->content !!}
                    </textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                    @if ($staff->image)
                        <img src="{{ asset('storage/' . $staff->image) }}" alt="{{ $staff->title }}"
                            class="w-16 h-16 object-cover mb-2">
                    @else
                        <p class="mb-2 text-gray-500">Không có hình ảnh</p>
                    @endif
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="position" class="block text-sm font-medium text-gray-700">Tên danh mục</label>
                    <input type="text" name="position" id="position" value="{{ old('position', $staff->position) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu</button>
                <button onclick="location.href='{{ route('admin.services.index') }}'" type="button"
                    class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Quay lại</button>
            </form>
        </div>
    </main>
@endsection
