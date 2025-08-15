{{-- Tất cả các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Sản phẩm')

{{-- Đặt file css cho page --}}
@section('file', 'products')

{{-- Đặt class cho body --}}
@section('page', 'products')
@section('content')
    <main>
        <div class="container px-4 mx-auto lg:px-8 md:px-6 pt-[120px] pb-[90px]">
            <div class="flex justify-between items-center mb-[40px]">
                <span>
                    Đang hiển thị
                    {{ ($products->currentPage() - 1) * $products->perPage() + 1 }}–{{ min($products->currentPage() * $products->perPage(), $products->total()) }}
                    trong tổng số {{ $products->total() }} kết quả
                </span>
                <div>
                    <form class="max-w-sm mx-auto" method="GET" action="{{ route('products.index') }}">
                        <select name="sort"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:none block w-full ps-[20px] py-3 pe-[30px]"
                            onchange="this.form.submit()">
                            <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Mặc định</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Giá</option>
                        </select>
                    </form>
                </div>
            </div>

            @if ($products->isEmpty())
                <div class="text-center">
                    <p>Không có sản phẩm nào!</p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 md:grid-cols-2">
                    @foreach ($products as $item)
                        <div class="relative group">
                            <div class="bg-[#f1f1f1] overflow-hidden">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                    class="object-cover w-full h-[280px] transition-transform duration-300 rounded-full group-hover:scale-105" />
                                <div
                                    class="absolute top-[10px] right-[10px] flex flex-col gap-2 items-center justify-center transition-all duration-300 bg-opacity-0 group-hover:bg-opacity-50">
                                    <a href="#"
                                        class="transition-opacity duration-300 opacity-0 cart-icon group-hover:opacity-100"
                                        onclick="event.preventDefault(); addToCart({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-10 h-10 text-[#9a563a] bg-[#fff] hover:text-[#fff] hover:bg-[#9a563a] transition-all duration-300">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('products.show', $item->id) }}"
                                        class="transition-opacity duration-300 opacity-0 cart-icon group-hover:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-10 h-10 text-[#9a563a] bg-[#fff] hover:text-[#fff] hover:bg-[#9a563a] transition-all duration-300">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-between mt-[23px]">
                                <p class="text-lg font-semibold text-center">{{ $item->name }}</p>
                                <p class="text-[#a05c3c]">{{ number_format($item->price) }}đ</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <nav aria-label="Page navigation example" class="mt-[50px]">
                    <ul class="flex items-center h-8 -space-x-px text-sm">
                        @for ($page = 1; $page <= $products->lastPage(); $page++)
                            <li>
                                <a href="{{ $products->url($page) }}"
                                    class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 {{ $products->currentPage() == $page ? 'bg-gray-200' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endfor
                        <li>
                            <a href="{{ $products->nextPageUrl() }}"
                                class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Next</span>
                                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
    </main>
@endsection
<script>
    function addToCart(productId) {
        fetch('{{ route('cart.add', ['productId' => ':id']) }}'.replace(':id', productId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    quantity: 1
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Yêu cầu không thành công: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Thêm thông báo thành công động
                    const successDiv = document.createElement('div');
                    successDiv.id = 'success-message';
                    successDiv.className =
                        'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-auto max-w-7xl relative overflow-hidden';
                    successDiv.innerHTML =
                        `<span class="block">${data.message}</span><div id="success-countdown" class="absolute bottom-0 left-0 h-1 bg-green-500 transition-all duration-500 ease-linear" style="width: 100%;"></div>`;
                    document.body.insertBefore(successDiv, document.body.firstChild);

                    // Cập nhật số lượng trong header
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.count;
                        if (data.count > 0) {
                            cartCount.style.display = 'flex';
                        } else {
                            cartCount.style.display = 'none';
                        }
                    }

                    // Ẩn thông báo sau 5 giây
                    setTimeout(() => {
                        const countdown = successDiv.querySelector('#success-countdown');
                        let width = 100;
                        const interval = setInterval(() => {
                            width -= 1;
                            countdown.style.width = `${width}%`;
                            if (width <= 0) {
                                clearInterval(interval);
                                successDiv.style.display = 'none';
                            }
                        }, 50);
                    }, 0);
                } else {
                    // Thêm thông báo lỗi động
                    const errorDiv = document.createElement('div');
                    errorDiv.id = 'error-message';
                    errorDiv.className =
                        'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-auto max-w-7xl relative overflow-hidden';
                    errorDiv.innerHTML =
                        `<ul><li>${data.message}</li></ul><div id="error-countdown" class="absolute bottom-0 left-0 h-1 bg-red-500 transition-all duration-300 ease-linear" style="width: 100%;"></div>`;
                    document.body.insertBefore(errorDiv, document.body.firstChild);

                    // Ẩn thông báo sau 3 giây
                    setTimeout(() => {
                        const countdown = errorDiv.querySelector('#error-countdown');
                        let width = 100;
                        const interval = setInterval(() => {
                            width -= 1;
                            countdown.style.width = `${width}%`;
                            if (width <= 0) {
                                clearInterval(interval);
                                errorDiv.style.display = 'none';
                            }
                        }, 30);
                    }, 0);
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng. Chi tiết: ' + error.message);
            });
    }

    // Hàm cập nhật số lượng giỏ hàng trên header
    function updateCartCount() {
        fetch('/cart/count', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    cartCount.textContent = data.count;
                    if (data.count > 0) {
                        cartCount.style.display = 'flex';
                    } else {
                        cartCount.style.display = 'none';
                    }
                }
            })
            .catch(error => console.error('Lỗi khi cập nhật số lượng:', error));
    }

    // Gọi updateCartCount khi trang tải (nếu cần)
    document.addEventListener('DOMContentLoaded', updateCartCount);
</script>
