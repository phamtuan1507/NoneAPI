{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Sửa bài viết')

{{-- Đặt file css cho page --}}
@section('file', 'admin.blogs.edit')

{{-- Đặt class cho body --}}
@section('page', 'admin.blogs.edit')
@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Sửa bài viết</h1>
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Tên bài viết</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description', $blog->description) }}</textarea>
                </div>
                {{-- <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Nội dung</label>
                    <textarea name="content" id="content" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('content', $blog->content) }}</textarea>
                </div> --}}
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Nội dung</label>
                    <div id="content" class="mt-1 border border-gray-300 rounded-md p-2 min-h-[200px]">{!! $blog->content !!}</div>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                    @if ($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                            class="w-16 h-16 object-cover mb-2">
                    @else
                        <p class="mb-2 text-gray-500">Không có hình ảnh</p>
                    @endif
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">Không có</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật</button>
                                <button onclick="location.href='{{ route('admin.blogs.index') }}'" type="button"
                    class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Quay lại</button>
            </form>
        </div>
    </main>
@endsection
