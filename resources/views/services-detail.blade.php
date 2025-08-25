{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Chi tiết dịch vụ')

{{-- Đặt file css cho page --}}
@section('file', 'services-detail')

{{-- Đặt class cho body --}}
@section('page', 'services-detail')
@section('content')
    <main>
        <div
            class="bg-[url(/public/images/breadcumb.jpg)] pb-[0.1px] overflow-hidden relative bg-[#EFF1F5] bg-[length:100%_auto] bg-top bg-no-repeat bg-cover">
            <div class="relative z-[3] container mx-auto px-4 md:px-6 lg:px-8">
                <div class="p-[200px_0_200px_0]">
                    <h1 class="text-[#121f38] text-[60px] uppercase m-[-0.22em_0_-0.22em_0]">
                        Chi tiết dịch vụ
                    </h1>
                    <nav class="">
                        <a href="/" class="text-[14px] text-[#555555] hover:text-[#a05c3c]">
                            Trang chủ
                        </a>
                        <span class="mx-1">&#8250;</span>
                        <span class="text-[14px] text-[#121f38]"> Chi tiết dịch vụ </span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 py-10">
            <div>
                <div>
                    <img src="{{ asset('storage/' . $staff->image) }}" alt="{{ $staff->name }}" class="w-full" />
                </div>
                <div class="text-[#7a7a7a] text-[16px] pt-[50px]">
                    <h1 class="text-3xl font-bold text-[#121f38] mb-4">{{ $staff->name }}</h1>
                    <p class="mb-4"><strong>Danh mục:</strong> {{ $staff->position }}</p>
                    <p>{{ $staff->description }}</p>
                    <p class="mt-4">
                        {{ $staff->content }}
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
