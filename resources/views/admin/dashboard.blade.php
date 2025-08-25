{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Dashboard')

{{-- Đặt file css cho page --}}
@section('file', 'dashboard')


{{-- Đặt class cho body --}}
@section('page', 'dashboard')
@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('admin.products.index') }}"
                    class="bg-white rounded-lg shadow p-6 text-center hover:bg-gray-50 transition">
                    <h2 class="text-xl font-semibold text-gray-800">Quản lý sản phẩm</h2>
                    <p class="text-gray-600 mt-2">Thêm, sửa, xóa sản phẩm</p>
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="bg-white rounded-lg shadow p-6 text-center hover:bg-gray-50 transition">
                    <h2 class="text-xl font-semibold text-gray-800">Quản lý danh mục</h2>
                    <p class="text-gray-600 mt-2">Thêm, sửa, xóa danh mục</p>
                </a>
                <a href="{{ route('admin.blogs.index') }}"
                    class="bg-white rounded-lg shadow p-6 text-center hover:bg-gray-50 transition">
                    <h2 class="text-xl font-semibold text-gray-800">Quản lý bài viết</h2>
                    <p class="text-gray-600 mt-2">Thêm, sửa, xóa bài viết</p>
                </a>
                <a href="{{ route('admin.team.index') }}"
                    class="bg-white rounded-lg shadow p-6 text-center hover:bg-gray-50 transition">
                    <h2 class="text-xl font-semibold text-gray-800">Quản lý nhân viên</h2>
                    <p class="text-gray-600 mt-2">Thêm, sửa, xóa nhân viên</p>
                </a>
                <a href="{{ route('admin.services.index') }}"
                    class="bg-white rounded-lg shadow p-6 text-center hover:bg-gray-50 transition">
                    <h2 class="text-xl font-semibold text-gray-800">Quản lý dịch vụ bài viết</h2>
                    <p class="text-gray-600 mt-2">Thêm, sửa, xóa dịch vụ bài viết</p>
                </a>
            </div>
        </div>
    </main>
@endsection
