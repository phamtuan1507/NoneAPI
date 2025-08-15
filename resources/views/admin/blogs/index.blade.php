{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Quản lý bài viết')

{{-- Đặt file css cho page --}}
@section('file', 'admin.blogs.index')

{{-- Đặt class cho body --}}
@section('page', 'admin.blogs.index')
@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Quản lý bài viết</h1>
            <a href="{{ route('admin.blogs.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Thêm bài viết mới</a>
            <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Quay
                lại trang dashboard</a>
            <table class="w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4">Tên</th>
                        <th class="py-2 px-4">Danh mục</th>
                        <th class="py-2 px-4">Hình ảnh</th>
                        <th class="py-2 px-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td class="border px-4 py-2">{{ $blog->title }}</td>
                            <td class="border px-4 py-2">{{ $blog->category ? $blog->category->name : 'Không có' }}
                            </td>
                            <td class="border px-4 py-2">
                                @if ($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                        class="w-16 h-16 object-cover">
                                @else
                                    Không có
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="text-blue-500">Sửa</a>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $blogs->links() }}
        </div>
    </main>
@endsection
