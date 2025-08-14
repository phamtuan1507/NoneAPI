{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Trang chủ')

{{-- Đặt file css cho page --}}
@section('file', 'home-page')


{{-- Đặt class cho body --}}
@section('page', 'home-page')
@section('content')
    <main>
        <section class="banner">
            <div class="container py-0 py-md-4 my-0 my-md-2">
                <div class="banner__list owl-carousel owl-theme">
                    <!-- Slide 1 -->
                    <div class="relative">
                        <img src="{{ asset('images/banner1.jpg') }}" class="object-cover w-full h-[400px] md:h-[500px]"
                            alt="Banner 1" />
                        <div class="absolute top-0 left-0 z-10 flex flex-col justify-center h-full pl-16 md:pl-32">
                            <div class="text-lg md:text-xl font-medium mb-2 text-[#1a2233]">
                                Spa & Beauty Center
                            </div>
                            <h2 class="text-3xl md:text-5xl font-bold text-[#1a2233] mb-4 leading-tight">
                                Chăm sóc toàn diện cơ thể
                            </h2>
                            <p class="max-w-lg text-base md:text-lg text-[#1a2233] mb-6">
                                Với sự kết hợp hoàn hảo giữa yêu thương và chăm sóc, chúng tôi cam kết mang đến cho bạn trải
                                nghiệm spa vượt trội tại thành phố của bạn.
                            </p>
                            <div>
                                <button
                                    class="relative z-[1] flex items-center pe-[10px] pb-[10px] pt-[10px] ps-[25px] text-sm font-bold uppercase tracking-wider text-[#a05c3c] hover:text-[#fff] bg-[#ffffff] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                                    Đặt lịch ngay
                                    <span class="bg-[#a05c3c] p-[10px] ms-[15px]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            strokeWidth="1.5" stroke="currentColor" class="size-6 text-[#fff]">
                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </span>
                                    <span
                                        class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                                    <span
                                        class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 (Example) - Add more slides as needed -->
                    <div class="relative">
                        <img src="{{ asset('images/banner2.jpg') }}" class="object-cover w-full h-[400px] md:h-[500px]"
                            alt="Banner 2" />
                        <div class="absolute top-0 left-0 z-10 flex flex-col justify-center h-full pl-16 md:pl-32">
                            <div class="text-lg md:text-xl font-medium mb-2 text-[#1a2233]">
                                Wellness Retreat
                            </div>
                            <h2 class="text-3xl md:text-5xl font-bold text-[#1a2233] mb-4 leading-tight">
                                Tái tạo năng lượng
                            </h2>
                            <p class="max-w-lg text-base md:text-lg text-[#1a2233] mb-6">
                                Khám phá không gian thư giãn và tái tạo năng lượng với các liệu trình độc đáo.
                            </p>
                            <div>
                                <button
                                    class="relative z-[1] flex items-center pe-[10px] pb-[10px] pt-[10px] ps-[25px] text-sm font-bold uppercase tracking-wider text-[#a05c3c] hover:text-[#fff] bg-[#ffffff] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                                    Đặt lịch ngay
                                    <span class="bg-[#a05c3c] p-[10px] ms-[15px]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            strokeWidth="1.5" stroke="currentColor" class="size-6 text-[#fff]">
                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </span>
                                    <span
                                        class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                                    <span
                                        class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container mx-auto px-4 pt-[80px] bg-gradient-to-b from-[#fcf2ee] to-transparent sm:px-6 lg:px-8">
            <h3 class="text-[#a05c3c] mb-[18px] uppercase text-center">
                Chăm sóc da mặt
            </h3>
            <h2 class="text-center font-bold text-[48px] text-[#121f38]">
                Điều trị da mặt & toàn thân
            </h2>
            <div class="flex justify-center">
                <img src="{{ asset('images/shape1.png') }}" alt="" />
            </div>
            <section class="pt-[45px]">
                <div class="facial__care owl-carousel owl-theme">
                    <div
                        class=" bg-white z-1 hover:bg-[#a05c3c] hover:text-[#ffffff] text-center shadow-[1.5px_2.598px_14.88px_1.12px_rgba(54, 72, 89, 0.05)] py-6 px-4 transition-colors duration-300 border border-solid border-[rgba(154,86,58,0.25)] outline-1 outline-[#a05c3c] hover:outline-[#ffffff] outline-offset-[-9px] mb-[30px]">
                        <div
                            class="w-24 h-24 mx-auto flex items-center justify-center rounded-full border border-dashed border-[#a05c3c] hover:border-[#ffffff] p-4 animate-spin-slow bg-[#fde7da] bg-cover bg-center mb-4">
                            <img src="{{ asset('images/fe1.png') }}" alt=""
                                class="object-cover w-full h-full rounded-full" />
                        </div>
                        <div class="flex justify-center gap-1 text-[#a05c3c] z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="{1.5}"
                                stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="{1.5}"
                                stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="{1.5}"
                                stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="{1.5}"
                                stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>
                        <p class="text-lg font-semibold">
                            Điều trị ánh sáng LED hiện đại
                        </p>
                        <p class="mb-4">
                            Sử dụng ánh sáng LED tiên tiến để kích thích sản xuất collagen, làm mờ nếp nhăn, giảm
                            mụn và làm sáng da.
                        </p>
                    </div>
                    <div
                        class=" bg-white z-1 hover:bg-[#a05c3c] hover:text-[#ffffff] text-center shadow-[1.5px_2.598px_14.88px_1.12px_rgba(54, 72, 89, 0.05)] py-6 px-4 transition-colors duration-300 border border-solid border-[rgba(154,86,58,0.25)] outline-1 outline-[#a05c3c] hover:outline-[#ffffff] outline-offset-[-9px] mb-[30px]">
                        <div
                            class="w-24 h-24 mx-auto flex items-center justify-center rounded-full border border-dashed border-[#a05c3c] hover:border-[#ffffff] p-4 animate-spin-slow bg-[#fde7da] bg-cover bg-center mb-4">
                            <img src="{{ asset('images/fe2.png') }}" alt=""
                                class="object-cover w-full h-full rounded-full" />
                        </div>
                        <div class="flex justify-center gap-1 text-[#a05c3c] z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="{1.5}"
                                stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                strokeWidth="{1.5}" stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                strokeWidth="{1.5}" stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                strokeWidth="{1.5}" stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>
                        <p class="text-lg font-semibold">
                            Điều trị ánh sáng LED hiện đại
                        </p>
                        <p class="mb-4">
                            Sử dụng ánh sáng LED tiên tiến để kích thích sản xuất collagen, làm mờ nếp nhăn, giảm
                            mụn và làm sáng da.
                        </p>
                    </div>
                    <div
                        class=" bg-white z-1 hover:bg-[#a05c3c] hover:text-[#ffffff] text-center shadow-[1.5px_2.598px_14.88px_1.12px_rgba(54, 72, 89, 0.05)] py-6 px-4 transition-colors duration-300 border border-solid border-[rgba(154,86,58,0.25)] outline-1 outline-[#a05c3c] hover:outline-[#ffffff] outline-offset-[-9px] mb-[30px]">
                        <div
                            class="w-24 h-24 mx-auto flex items-center justify-center rounded-full border border-dashed border-[#a05c3c] hover:border-[#ffffff] p-4 animate-spin-slow bg-[#fde7da] bg-cover bg-center mb-4">
                            <img src="{{ asset('images/fe.png') }}" alt=""
                                class="object-cover w-full h-full rounded-full" />
                        </div>
                        <div class="flex justify-center gap-1 text-[#a05c3c] z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                strokeWidth="{1.5}" stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                strokeWidth="{1.5}" stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                strokeWidth="{1.5}" stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                strokeWidth="{1.5}" stroke="currentColor" class="w-[14px]">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>
                        <p class="text-lg font-semibold">
                            Điều trị ánh sáng LED hiện đại
                        </p>
                        <p class="mb-4">
                            Sử dụng ánh sáng LED tiên tiến để kích thích sản xuất collagen, làm mờ nếp nhăn, giảm
                            mụn và làm sáng da.
                        </p>
                    </div>
                </div>
            </section>
        </section>
        <section>
            <div class="m-[0_20px_0_-32px] relative">
                <div class="relative flex items-center justify-center w-30 h-30 bg-[#8b5e3c] rounded-full">
                    <svg class="w-32 h-32" viewBox="0 0 128 128">
                        <!-- Vòng nền đứng yên -->
                        <circle cx="64" cy="64" r="48" fill="#8b5e3c" />

                        <!-- Mũi tên giữa đứng yên -->
                        <path class="w-10 h-10"
                            d="M52 44 L50.59 45.41 L68.17 60 H44 v4 h24.17 l-17.58 14.59 L52 84 l20-20z" fill="white"
                            transform="translate(-2,-4)" />

                        <!-- Nhóm chữ xoay bằng JS -->
                        <g id="rotating-text">
                            <path id="circlePath" d="M64,64 m-46,0 a 46,46 0 1,1 92,0 a 46,46 0 1,1 -92,0" fill="none"
                                stroke="none" />
                            <text>
                                <textPath href="#circlePath" class="text-white text-xs font-semibold fill-current">
                                    makeup last all day • makeup last all day •
                                </textPath>
                            </text>
                        </g>
                    </svg>
                </div>
            </div>
        </section>
    </main>
@endsection
