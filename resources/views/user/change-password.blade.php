@extends('layouts.master')

@section('title', 'Đổi mật khẩu')

@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Đổi mật khẩu</h1>
            <form action="{{ route('change-password') }}" method="POST" class="max-w-md">
                @csrf
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-medium text-gray-700">Mật khẩu mới</label>
                    <input type="password" name="new_password" id="new_password" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu mới</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cập nhật mật khẩu</button>
                <a href="{{ route('profile') }}" class="ml-4 text-gray-600 hover:text-gray-800">Quay lại</a>
            </form>
        </div>
    </main>
@endsection
