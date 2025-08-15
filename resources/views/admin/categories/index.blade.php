{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Quản lý danh mục')

{{-- Đặt file css cho page --}}
@section('file', 'admin.categories')

{{-- Đặt class cho body --}}
@section('page', 'admin.categories')
@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Quản lý danh mục</h1>
            <a href="{{ route('admin.categories.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Thêm danh mục mới</a>
            <table class="w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4">Tên</th>
                        <th class="py-2 px-4">Danh mục cha</th>
                        <th class="py-2 px-4">Hình ảnh</th>
                        <th class="py-2 px-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="border px-4 py-2">{{ $category->name }}</td>
                            <td class="border px-4 py-2">{{ $category->parent ? $category->parent->name : 'Không có' }}</td>
                            <td class="border px-4 py-2">
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                        class="w-16 h-16 object-cover">
                                @else
                                    Không có
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-500">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
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
        </div>
    </main>
@endsection
