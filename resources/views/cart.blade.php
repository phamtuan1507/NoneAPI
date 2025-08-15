{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Giỏ hàng')

{{-- Đặt file css cho page --}}
@section('file', 'cart')


{{-- Đặt class cho body --}}
@section('page', 'cart')
@section('content')
    <main>
        <div class="container px-4 mx-auto lg:px-8 md:px-6 pt-[120px] pb-[90px]">
            <!-- When cart is empty -->
            @if ($cartItems->isEmpty())
                <div class="text-center">
                    <h2 class="text-[30px] font-bold text-[#121f38] mb-4">
                        Giỏ hàng của bạn đang trống
                    </h2>
                    <p class="mb-6 text-gray-600">Hãy thêm sản phẩm để tiếp tục mua sắm!</p>
                    <a href="{{ route('products.index') }}"
                        class="relative inline-block px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                        TIẾP TỤC MUA HÀNG
                        <span
                            class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                        <span
                            class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                    </a>
                </div>
            @else
                <!-- Cart Table -->
                <table class="w-full text-left border border-[#e7e5e5]">
                    <thead>
                        <tr class="text-white bg-amber-700">
                            <th class="p-2">Hình ảnh</th>
                            <th class="p-2">Tên sản phẩm</th>
                            <th class="p-2">Đơn giá</th>
                            <th class="p-2">Số lượng</th>
                            <th class="p-2">Tổng</th>
                            <th class="p-2">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $index => $item)
                            <tr class="border-b border-[#e7e5e5]">
                                <td class="p-2">
                                    <img src="{{ asset('storage/' . ($item->product->image ?? 'https://via.placeholder.com/64')) }}"
                                        alt="Product" class="object-cover w-16 h-16 p-4 border border-[#e7e5e5]">
                                </td>
                                <td class="p-2 font-bold text-[#9a563a] hover:text-[#131e35] cursor-pointer">
                                    <a
                                        href="{{ route('products.show', $item->product->id) }}">{{ $item->product->name }}</a>
                                </td>
                                <td class="p-2">{{ number_format($item->product->price) }}đ</td>
                                <td class="p-2">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                        class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button"
                                            onclick="this.form.querySelector('input[name=action]').value='decrease'; this.form.submit();"
                                            class="flex items-center justify-center w-10 h-10 border border-[#e7e5e5] bg-transparent hover:bg-[#9a563a] hover:text-white duration-300 cursor-pointer">-</button>
                                        <input type="hidden" name="action" value="">
                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                            class="w-16 h-10 text-center border" max="{{ $item->product->quantity }}"
                                            min="1" onchange="this.form.submit()">
                                        <button type="button"
                                            onclick="this.form.querySelector('input[name=action]').value='increase'; this.form.submit();"
                                            class="flex items-center justify-center w-10 h-10 border border-[#e7e5e5] bg-transparent hover:bg-[#9a563a] hover:text-white duration-300 cursor-pointer">+</button>
                                    </form>
                                </td>
                                <td class="p-2">{{ number_format($item->product->price * $item->quantity) }}đ</td>
                                <td class="p-2">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Actions and Total -->
                <div class="flex flex-col gap-4 md:flex-row border border-[#e7e5e5] mb-[45px] pb-[15px]">
                    <div class="w-full md:w-1/2"></div>
                    <div class="w-full text-right md:w-1/2">
                        <div class="me-[20px]">
                            <a href="{{ route('products.index') }}"
                                class="relative mt-[24px] z-[1] inline-block px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                                TIẾP TỤC MUA HÀNG
                                <span
                                    class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                                <span
                                    class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Summary -->
                <div class="grid grid-cols-1 border md:grid-cols-2">
                    <div></div>
                    <div class="me-[10px]">
                        <div>
                            <p class="text-[30px] font-bold text-[#121f38]">Tổng giỏ hàng</p>
                            <table class="w-full border rounded-lg shadow">
                                <thead>
                                    <tr>
                                        <th class="p-2 text-xl font-semibold text-left text-gray-800">
                                            Tổng giỏ hàng
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border">
                                        <td class="p-2 bg-gray-100 w-[45%]">Tổng phụ</td>
                                        <td class="p-2 font-semibold">{{ number_format($total) }}đ</td>
                                    </tr>
                                    <tr class="border">
                                        <td class="p-2 bg-gray-100 w-[45%]">Tổng đơn hàng</td>
                                        <td class="p-2 font-semibold">{{ number_format($total) }}đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('checkout.index') }}"
                            class="relative mt-[24px] z-[1] inline-block px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                            TIẾN HÀNH THANH TOÁN
                            <span
                                class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                            <span
                                class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
        @if (session('success'))
            <div id="success-message"
                class="fixed top-4 left-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 max-w-xs relative overflow-hidden z-50"
                role="alert">
                <span class="block">{{ session('success') }}</span>
                <div id="success-countdown"
                    class="absolute bottom-0 left-0 h-1 bg-green-500 transition-all duration-500 ease-linear"
                    style="width: 100%;"></div>
            </div>
        @endif
    </main>
@endsection
<script>
    // Auto-dismiss success message after 5 seconds
    setTimeout(() => {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            const countdown = document.getElementById('success-countdown');
            let width = 100;
            const interval = setInterval(() => {
                width -= 1;
                countdown.style.width = `${width}%`;
                if (width <= 0) {
                    clearInterval(interval);
                    successMessage.style.display = 'none';
                }
            }, 50);
        }
    }, 0);
</script>
