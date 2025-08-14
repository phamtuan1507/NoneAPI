{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Dashboard')

{{-- Đặt file css cho page --}}
@section('file', 'dashboard')


{{-- Đặt class cho body --}}
@section('page', 'dashboard')
@section('content')
    <main class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center">Bảng Điều Khiển Quản Trị</h1>
        <p class="text-center mt-4">Chào mừng {{ auth()->user()->name }}! Quản lý người dùng tại đây.</p>
    </main>
@endsection
