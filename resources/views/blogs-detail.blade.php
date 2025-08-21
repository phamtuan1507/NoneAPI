{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Chi tiết tin tức')

{{-- Đặt file css cho page --}}
@section('file', 'blogs-detail')

{{-- Đặt class cho body --}}
@section('page', 'blogs-detail')
@section('content')
    <main>
        <div
            class="bg-[url(/public/images/breadcumb.jpg)] pb-[0.1px] overflow-hidden relative bg-[#EFF1F5] bg-[length:100%_auto] bg-top bg-no-repeat bg-cover">
            <div class="relative z-[3] container mx-auto px-4 md:px-6 lg:px-8">
                <div class="p-[200px_0_200px_0]">
                    <h1 class="text-[#121f38] text-[60px] uppercase m-[-0.22em_0_-0.22em_0]">
                        Chi tiết bài viết
                    </h1>
                    <nav class="">
                        <a href="/" class="text-[14px] text-[#555555] hover:text-[#a05c3c]">
                            Trang chủ
                        </a>
                        <span class="mx-1">&#8250;</span>
                        <span class="text-[14px] text-[#121f38]"> Chi tiết bài viết </span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container px-4 mx-auto sm:px-6 lg:px-8 py-8">
            <h3 class="text-[#a05c3c] mb-[18px] uppercase text-center">
                Tin tức & blog
            </h3>
            <h2 class="text-center font-bold text-[48px] text-[#121f38] mb-[30px]">
                {{ $post->title }}
            </h2>
            <div class="flex justify-center mb-[45px]">
                <img src="/shape1.png" alt="Decoration" />
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="relative group mb-[30px]">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}"
                            class="w-full transition-transform duration-300 group-hover:scale-105" />
                    </div>
                    <p class="text-[#555555] text-lg leading-relaxed mb-[30px]">
                        {{ $post->description }}
                    </p>
                    <div class="border-t border-[#a1a1a180] mt-[15px] pt-[16px]">
                        <span class="text-[#6f6c6c]">
                            Tác giả: <span class="hover:text-[#a05c3c] cursor-pointer">{{ $post->author ?? 'Admin' }}</span>
                            /
                            Thời gian: <span
                                class="hover:text-[#a05c3c] cursor-pointer">{{ \Carbon\Carbon::parse($post->created_at)->format('d Tháng m, Y') }}</span>
                        </span>
                    </div>
                    @if ($post->content)
                        <div class="mt-[30px] prose max-w-none">
                            {!! $post->content !!}
                        </div>
                    @endif
                </div>

                <!-- Sidebar (Recent Posts or Categories) -->
                <div class="lg:col-span-1">
                    <div class="relative mb-[30px]">
                        <h3
                            class="uppercase text-[22px] leading-[1em] border-b border-[#e7e5e5] border-solid pb-[21px] mb-[30px]">
                            Tin tức mới nhất
                        </h3>
                        <span class="absolute left-0 bottom-[-1px] h-[2px] w-[30px] bg-[#9a563a]"></span>
                    </div>
                    @foreach ($recentPosts as $recent)
                        <div class="flex items-center gap-3 mb-[20px] cursor-pointer"
                            onclick="window.location.href='{{ route('blog.detail', $recent->id) }}'">
                            <img src="{{ $recent->image }}" alt="{{ $recent->title }}"
                                class="w-[60px] h-[60px] object-cover transition-transform duration-300 hover:scale-105" />
                            <div>
                                <p class="text-[#121f38] hover:text-[#a05c3c]">{{ $recent->title }}</p>
                                <p class="text-[#6f6c6c] text-sm">
                                    {{ \Carbon\Carbon::parse($recent->created_at)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="relative mt-[30px]">
                        <h3
                            class="uppercase text-[22px] leading-[1em] border-b border-[#e7e5e5] border-solid pb-[21px] mb-[30px]">
                            Chuyên mục
                        </h3>
                        <span class="absolute left-0 bottom-[-1px] h-[2px] w-[30px] bg-[#9a563a]"></span>
                    </div>
                    @foreach ($categories as $category)
                        <div class="flex items-center justify-between text-[#888888] hover:text-[#9a563a] border-b border-dashed border-[#e7e5e5] py-[15px] cursor-pointer"
                            onclick="window.location.href='{{ route('blogs', ['category' => $category['name'] === 'Allgemein' ? '' : $category['name']]) }}'">
                            <span>{{ $category['name'] }}</span>
                            <span>({{ $category['no'] }})</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Comments Section (Optional) -->
            @if ($post->comments->count() > 0)
                <div class="mt-[50px]">
                    <h3 class="text-[#121f38] text-[24px] mb-[20px]">Bình luận ({{ $post->comments_count }})</h3>
                    @foreach ($post->comments as $comment)
                        <div class="border-b border-[#e7e5e5] py-[15px]">
                            <p class="text-[#555555]"><strong>{{ $comment->user->name ?? 'Ẩn danh' }}</strong> -
                                {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i') }}</p>
                            <p class="text-[#6f6c6c] ml-[20px]">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Comment Form (Optional) -->
            @auth
                <form action="{{ route('blog.comment', $post->id) }}" method="POST">
                    @csrf
                    <textarea name="content" class="w-full p-3 border border-[#e7e5e5] rounded mb-[15px]" rows="4"
                        placeholder="Nhập bình luận của bạn..." required></textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <button type="submit"
                        class="px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded overflow-hidden text-center">
                        Gửi bình luận
                    </button>
                </form>
            @else
                <p class="text-red-500">Vui lòng <a href="{{ route('login') }}" class="underline">đăng nhập</a> để gửi bình
                    luận.</p>
            @endauth
        </div>
    </main>
@endsection
