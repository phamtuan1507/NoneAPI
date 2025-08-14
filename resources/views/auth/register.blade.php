@extends('layouts.master')

@section('title', 'Đăng ký')

@section('file', 'register')

@section('page', 'register')

@section('content')
    <main>
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-lg w-full max-w-md space-y-4">
                @csrf
                <h2 class="text-2xl font-bold text-center">Đăng ký</h2>
                <div>
                    <input type="text" name="name" placeholder="Tên người dùng" value="{{ old('name') }}" class="w-full p-2 border rounded @error('name') border-red-500 @enderror" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
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
                <div>
                    <input type="file" name="image" class="w-full p-2 border rounded @error('image') border-red-500 @enderror" accept="image/*">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button class="w-full relative z-[1] inline-block px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                    Đăng ký
                    <span class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                    <span class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                </button>
                <p class="text-center text-sm">
                    Đã có tài khoản? <a href="{{ route('login') }}" class="text-blue-500">Đăng nhập</a>
                </p>
            </form>
        </div>
    </main>
@endsection
