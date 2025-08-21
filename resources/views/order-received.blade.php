{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Xác nhận đơn hàng')

{{-- Đặt file css cho page --}}
@section('file', 'order-received')


{{-- Đặt class cho body --}}
@section('page', 'order-received')
@section('content')
    <main>
        <div
            class="bg-[url(/public/images/breadcumb.jpg)] pb-[0.1px] overflow-hidden relative bg-[#EFF1F5] bg-[length:100%_auto] bg-top bg-no-repeat bg-cover">
            <div class="relative z-[3] container mx-auto px-4 md:px-6 lg:px-8">
                <div class="p-[200px_0_200px_0]">
                    <h1 class="text-[#121f38] text-[60px] uppercase m-[-0.22em_0_-0.22em_0]">
                        Chi tiết đơn hàng
                    </h1>
                    <nav class="">
                        <a href="/" class="text-[14px] text-[#555555] hover:text-[#a05c3c]">
                            Trang chủ
                        </a>
                        <span class="mx-1">&#8250;</span>
                        <span class="text-[14px] text-[#121f38]"> Chi tiết đơn hàng </span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 pt-[120px] pb-[90px]">
            <!-- Order Confirmation -->
            @if ($order)
                <div class="mb-4 text-gray-600">
                    Cảm ơn. Đơn đặt hàng của bạn đã được nhận.
                </div>
                <ul class="mb-4 text-gray-600 list-disc list-inside">
                    <li>Mã đơn hàng: {{ $order->order_number }}</li>
                    <li>Ngày: {{ $order->created_at->format('d/m/Y H:i') }}</li>
                    <li>Email: {{ $order->billing_email }}</li>
                    <li>Tổng: {{ number_format($order->total_amount) }}đ</li>
                    <li>Phương thức thanh toán: {{ $order->payment_method }}</li>
                </ul>
                @if ($order->payment_method === 'Thanh toán khi nhận hàng')
                    <p class="mb-4 text-sm text-gray-600">
                        Thanh toán bằng tiền mặt khi nhận hàng.
                    </p>
                @endif

                <!-- Order Details -->
                <h2 class="mb-4 text-2xl font-bold">Chi tiết đặt hàng</h2>
                <table class="w-full text-left border-collapse border border-[#e7e5e5]">
                    <thead>
                        <tr>
                            <th class="p-2">Sản phẩm</th>
                            <th class="p-2 text-right">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-b">
                                <td class="p-2">{{ $item->product->name }} x {{ $item->quantity }}</td>
                                <td class="p-2 text-right">{{ number_format($item->price * $item->quantity) }}đ</td>
                            </tr>
                        @endforeach
                        <tr class="border-b">
                            <td class="p-2">Tổng:</td>
                            <td class="p-2 text-right">{{ number_format($order->total_amount) }}đ</td>
                        </tr>
                        @if ($order->notes)
                            <tr class="border-b">
                                <td class="p-2">Ghi chú:</td>
                                <td class="p-2 text-right">{{ $order->notes }}</td>
                            </tr>
                        @endif
                        <tr class="border-b">
                            <td class="p-2">Phương thức thanh toán:</td>
                            <td class="p-2 text-right">{{ $order->payment_method }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-2">Tổng:</td>
                            <td class="p-2 text-right">{{ number_format($order->total_amount) }}đ</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Billing Address -->
                <h2 class="mt-8 mb-4 text-2xl font-bold">Địa chỉ thanh toán</h2>
                <table class="w-full text-left border-collapse border border-[#e7e5e5]">
                    <tbody>
                        <tr class="border-b">
                            <td class="p-2">{{ $order->billing_name }}</td>
                            <td class="p-2"></td>
                        </tr>
                        @if ($order->billing_company)
                            <tr class="border-b">
                                <td class="p-2">{{ $order->billing_company }}</td>
                                <td class="p-2"></td>
                            </tr>
                        @endif
                        <tr class="border-b">
                            <td class="p-2">{{ $order->billing_address1 }}</td>
                            <td class="p-2"></td>
                        </tr>
                        @if ($order->billing_address2)
                            <tr class="border-b">
                                <td class="p-2">{{ $order->billing_address2 }}</td>
                                <td class="p-2"></td>
                            </tr>
                        @endif
                        <tr class="border-b">
                            <td class="p-2">{{ $order->billing_city }}</td>
                            <td class="p-2"></td>
                        </tr>
                        @if ($order->billing_postal_code)
                            <tr class="border-b">
                                <td class="p-2">Mã bưu điện: {{ $order->billing_postal_code }}</td>
                                <td class="p-2"></td>
                            </tr>
                        @endif
                        @if ($order->billing_country)
                            <tr class="border-b">
                                <td class="p-2">Quốc gia: {{ $order->billing_country }}</td>
                                <td class="p-2"></td>
                            </tr>
                        @endif
                        <tr class="border-b">
                            <td class="p-2">{{ $order->billing_phone }}</td>
                            <td class="p-2"></td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-2">{{ $order->billing_email }}</td>
                            <td class="p-2"></td>
                        </tr>
                    </tbody>
                </table>
            @else
                <div class="mb-4 text-gray-600">
                    Không tìm thấy thông tin đơn hàng.
                </div>
            @endif
        </div>
    </main>
@endsection
