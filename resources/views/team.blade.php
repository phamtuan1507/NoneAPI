{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Chuyên gia')

{{-- Đặt file css cho page --}}
@section('file', 'team')

{{-- Đặt class cho body --}}
@section('page', 'team')
@section('content')
    <main>
        <div
            class="bg-[url(/public/images/breadcumb.jpg)] pb-[0.1px] overflow-hidden relative bg-[#EFF1F5] bg-[length:100%_auto] bg-top bg-no-repeat bg-cover">
            <div class="relative z-[3] container mx-auto px-4 md:px-6 lg:px-8">
                <div class="p-[200px_0_200px_0]">
                    <h1 class="text-[#121f38] text-[60px] uppercase m-[-0.22em_0_-0.22em_0]">
                        Chuyên gia
                    </h1>
                    <nav class="">
                        <a href="/" class="text-[14px] text-[#555555] hover:text-[#a05c3c]">
                            Trang chủ
                        </a>
                        <span class="mx-1">&#8250;</span>
                        <span class="text-[14px] text-[#121f38]"> Chuyên gia </span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container px-4 py-5 mx-auto sm:px-6 lg:px-8">
            <h3 class="text-[#a05c3c] mb-[18px] uppercase text-center">
                Chuyên gia làm đẹp
            </h3>
            <h2 class="text-center font-bold text-[48px] text-[#121f38]">
                Đội ngũ chuyên nghiệp
            </h2>
            <div class="flex justify-center">
                <img src="/shape1.png" alt="" />
            </div>
            <di class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[30px] mt-[30px]">
                @foreach ($team as $item)
                    <a href="{{ route('team.show', $item->id) }}">
                        <div
                            class="bg-[#e5d4ce] rounded-[9999px] overflow-hidden m-[7px] relative outline-1 outline-[#a05c3c] hover:outline-[#ffffff] outline-offset-[5px] transition-colors duration-300 group cursor-pointer">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                class="object-cover w-full h-full rounded-full" />
                            <span
                                class="absolute top-0 left-0 w-0 h-1/2 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:w-full group-focus:w-full"></span>
                            <span
                                class="absolute bottom-0 right-0 w-0 h-1/2 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:w-full group-focus:w-full"></span>
                        </div>
                        <p class="text-center text-[26px] mt-[30px] mb-[6px] hover:text-[#a05c3c] cursor-pointer">
                            {{ $item->name }}
                        </p>
                        <p class="text-center text-[#9a563a] uppercase m-0 text-[14px]">
                            {{ $item->position }}
                        </p>
                    </a>
                @endforeach
        </div>
        </div>
    </main>
@endsection
