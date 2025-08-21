{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Tin tức')

{{-- Đặt file css cho page --}}
@section('file', 'blogs')

{{-- Đặt class cho body --}}
@section('page', 'blogs')
@section('content')
    <main>
        <div
            class="bg-[url(/public/images/breadcumb.jpg)] pb-[0.1px] overflow-hidden relative bg-[#EFF1F5] bg-[length:100%_auto] bg-top bg-no-repeat bg-cover">
            <div class="relative z-[3] container mx-auto px-4 md:px-6 lg:px-8">
                <div class="p-[200px_0_200px_0]">
                    <h1 class="text-[#121f38] text-[60px] uppercase m-[-0.22em_0_-0.22em_0]">
                        Bài viết
                    </h1>
                    <nav class="">
                        <a href="/" class="text-[14px] text-[#555555] hover:text-[#a05c3c]">
                            Trang chủ
                        </a>
                        <span class="mx-1">&#8250;</span>
                        <span class="text-[14px] text-[#121f38]"> Bài viết </span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 py-16 container mx-auto px-4 ">
            @foreach ($blogs as $item)
                <div class="relative group">
                    <a class="w-full h-200" href="{{ route('blog.detail', $item->id) }}">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                            class="w-full h-75 transition-transform duration-300 cursor-pointer group-hover:scale-105" />
                    </a>
                    <p class="text-[#121f38] hover:text-[#a05c3c] cursor-pointer mb-[15px] mt-[22px]">
                        {{ $item->title }}
                    </p>
                    <p class="font-semibold text-lg text-[#555555] mb-[18px]">
                        {{ $item->description }}
                    </p>
                    {{-- <div class="border-t border-[#a1a1a180] mt-[15px] pt-[16px]">
                        <span>
                            <span class="text-[#6f6c6c] hover:text-[#a05c3c] cursor-pointer">{{ $item->author }}</span> /
                            <span class="text-[#6f6c6c] hover:text-[#a05c3c] cursor-pointer">{{ $item->createTime }}</span>
                        </span>
                    </div> --}}
                </div>
            @endforeach
        </div>
    </main>
@endsection
