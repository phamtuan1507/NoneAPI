{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Thêm danh mục')

{{-- Đặt file css cho page --}}
@section('file', 'admin.categories.create')

{{-- Đặt class cho body --}}
@section('page', 'admin.categories.create')
@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Thêm danh mục mới</h1>
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên danh mục</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md"
                        required>
                </div>
                <div class="mb-4">
                    <label>Loại danh mục</label>
                    <select name="type" required>
                        <option value="product" {{ old('type') == 'product' ? 'selected' : '' }}>Sản phẩm</option>
                        <option value="blog" {{ old('type') == 'blog' ? 'selected' : '' }}>Blog</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="parent_id" class="block text-sm font-medium text-gray-700">Danh mục cha</label>
                    <select name="parent_id" id="parent_id" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">Không có</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu</button>
                <button onclick="location.href='{{ route('admin.categories.index') }}'" type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Quay lại</button>
            </form>
        </div>
    </main>
@endsection
