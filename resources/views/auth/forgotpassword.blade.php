@extends('layouts.master')

@section('title', 'Quên Mật Khẩu')

@section('page', 'forgot-password')

@section('content')
    <main class="flex items-center justify-center min-h-screen bg-gray-100">
        <form action="#" method="POST" class="bg-white p-6 rounded shadow-lg w-full max-w-md space-y-4">
            @csrf
            <h2 class="text-2xl font-bold text-center">Quên Mật Khẩu</h2>
            <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" required>
            <button class="w-full relative z-[1] inline-block px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                Gửi Liên Kết Đặt Lại
                <span class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                <span class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
            </button>
            <p class="text-center text-sm">
                <a href="{{ route('login') }}" class="text-blue-500">Quay lại đăng nhập</a>
            </p>
        </form>
    </main>
@endsection
