{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Dich vụ')

{{-- Đặt file css cho page --}}
@section('file', 'services')

{{-- Đặt class cho body --}}
@section('page', 'services')
@section('content')
    <main>
        <div
            class="bg-[url(/public/images/breadcumb.jpg)] pb-[0.1px] overflow-hidden relative bg-[#EFF1F5] bg-[length:100%_auto] bg-top bg-no-repeat bg-cover">
            <div class="relative z-[3] container mx-auto px-4 md:px-6 lg:px-8">
                <div class="p-[200px_0_200px_0]">
                    <h1 class="text-[#121f38] text-[60px] uppercase m-[-0.22em_0_-0.22em_0]">
                        Spa thư giãn
                    </h1>
                    <nav class="">
                        <a href="/" class="text-[14px] text-[#555555] hover:text-[#a05c3c]">
                            Trang chủ
                        </a>
                        <span class="mx-1">&#8250;</span>
                        <span class="text-[14px] text-[#121f38]"> Spa thư giãn </span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 py-10">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach ($team as $sv)
                    <a class="col-span-1" href="{{ route('services.show', $sv->id) }}">
                        <div class="relative cursor-pointer group">
                            <img src="{{ asset('storage/' . $sv->image) }}" alt=""
                                class="object-cover w-full transition-opacity duration-300 ease-in-out h-[400px]" />
                            <div
                                class="absolute inset-[13px] z-10 flex flex-col items-center justify-center p-4 text-center bg-white bg-opacity-0 transition-all duration-300 ease-in-out opacity-0 group-hover:bg-opacity-90 group-hover:opacity-100">
                                <span class="text-4xl font-bold">+</span>
                                <p class="text-lg font-semibold">{{ $sv->name }}</p>
                                <p class="text-sm text-gray-600">{{ $sv->position }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>
@endsection
