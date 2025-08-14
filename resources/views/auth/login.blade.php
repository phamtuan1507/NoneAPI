@extends('layouts.master')

@section('title', 'Đăng nhập')

@section('file', 'login')

@section('page', 'login')

@section('content')
    <main>
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <form action="{{ route('login') }}" method="POST" class="bg-white p-6 rounded shadow-lg w-full max-w-md space-y-4">
                @csrf
                <h2 class="text-2xl font-bold text-center">Đăng nhập</h2>
                <div>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full p-2 border rounded @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="password" name="password" placeholder="Mật khẩu" class="w-full p-2 border rounded @error('password') border-red-500 @enderror" required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button class="w-full relative z-[1] inline-block px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                    Đăng nhập
                    <span class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                    <span class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                </button>
                <div class="flex justify-between text-sm">
                    <a href="{{ route('forgot.password') }}" class="text-blue-500">Quên mật khẩu?</a>
                    <a href="{{ route('register') }}" class="text-blue-500">Đăng ký</a>
                </div>
            </form>
        </div>
    </main>
@endsection
