@extends('layouts.master')

@section('title', 'Trang cá nhân')

@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Trang cá nhân</h1>
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center space-x-4">
                    <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : 'https://via.placeholder.com/150' }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover">
                    <div>
                        <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>
                        <p class="text-gray-600">Họ: {{ auth()->user()->last_name }}</p>
                        <p class="text-gray-600">Tên: {{ auth()->user()->first_name }}</p>
                        <p class="text-gray-600">Email: {{ auth()->user()->email }}</p>
                        <p class="text-gray-600">Số điện thoại: {{ auth()->user()->phone }}</p>
                        <p class="text-gray-600">Vai trò: {{ auth()->user()->role }}</p>
                    </div>
                </div>
                <div class="mt-6 space-x-4">
                    <a href="{{ route('edit-profile') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Chỉnh sửa thông tin</a>
                    <a href="{{ route('change-password') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Đổi mật khẩu</a>
                    <a href="{{ route('change-avatar') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Đổi ảnh đại diện</a>
                </div>
            </div>
        </div>
    </main>
@endsection
