{{-- Tất cả các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Checkout')

{{-- Đặt file css cho page --}}
@section('file', 'checkout')

{{-- Đặt class cho body --}}
@section('page', 'checkout')
@section('content')
    <main>
        <div class="container px-4 mx-auto lg:px-8 md:px-6 pt-[120px] pb-[90px]">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <h2 class="font-normal text-[30px] text-[#121f38]">
                        Chi tiết thanh toán
                    </h2>
                    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <!-- Họ và Tên -->
                        <div class="flex flex-col gap-4 md:flex-row">
                            <div class="w-full md:w-1/2">
                                <input type="text" name="ho" value="{{ old('ho', auth()->user()->last_name ?? '') }}"
                                    placeholder="Họ" class="w-full p-2 border border-[#e7e5e5] rounded" required>
                                @error('ho')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2">
                                <input type="text" name="ten"
                                    value="{{ old('ten', auth()->user()->first_name ?? '') }}" placeholder="Tên"
                                    class="w-full p-2 border border-[#e7e5e5] rounded" required>
                                @error('ten')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Tên công ty (nếu có) -->
                        <div>
                            <input type="text" name="tenCongTy" value="{{ old('tenCongTy') }}"
                                placeholder="Tên công ty (nếu có)" class="w-full p-2 border border-[#e7e5e5] rounded">
                            @error('tenCongTy')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Số điện thoại -->
                        <div>
                            <input type="tel" name="soDienThoai"
                                value="{{ old('soDienThoai', auth()->user()->phone ?? '') }}" placeholder="Số điện thoại"
                                class="w-full p-2 border border-[#e7e5e5] rounded" required>
                            @error('soDienThoai')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Địa chỉ email -->
                        <div>
                            <input type="email" name="diaChiEmail"
                                value="{{ old('diaChiEmail', auth()->user()->email ?? '') }}" placeholder="Địa chỉ email"
                                class="w-full p-2 border border-[#e7e5e5] rounded" required>
                            @error('diaChiEmail')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Quốc gia -->
                        <div>
                            <select name="quocGia"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:none block w-full ps-[20px] py-3 pe-[30px]"
                                required>
                                <option value="Vietnam" {{ old('quocGia', 'Vietnam') === 'Vietnam' ? 'selected' : '' }}>
                                    Việt Nam</option>
                                <option value="US" {{ old('quocGia') === 'US' ? 'selected' : '' }}>United States
                                </option>
                                <option value="CA" {{ old('quocGia') === 'CA' ? 'selected' : '' }}>Canada</option>
                                <option value="FR" {{ old('quocGia') === 'FR' ? 'selected' : '' }}>France</option>
                                <option value="DE" {{ old('quocGia') === 'DE' ? 'selected' : '' }}>Germany</option>
                            </select>
                            @error('quocGia')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <input type="text" name="diaChi" value="{{ old('diaChi') }}"
                                placeholder="Số nhà và tên đường" class="w-full p-2 border border-[#e7e5e5] rounded"
                                required>
                            @error('diaChi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <input type="text" name="apartment" value="{{ old('apartment') }}"
                                placeholder="Apartment, suite, unit, etc. (optional)"
                                class="w-full p-2 border border-[#e7e5e5] rounded">
                            @error('apartment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-4 md:flex-row">
                            <div class="w-full md:w-1/2">
                                <input type="text" name="tax" value="{{ old('tax') }}" placeholder="Mã bưu điện"
                                    class="w-full p-2 border border-[#e7e5e5] rounded" required>
                                @error('tax')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2">
                                <input type="text" name="taxAdress" value="{{ old('taxAdress') }}"
                                    placeholder="Thị Trấn/ Thành Phố" class="w-full p-2 border border-[#e7e5e5] rounded"
                                    required>
                                @error('taxAdress')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center mb-4">
                            <input type="checkbox" name="createAccount" {{ old('createAccount') ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-checkbox" class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                                Tạo tài khoản?
                            </label>
                        </div>
                    </form>
                </div>

                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <h2 class="font-normal text-[30px] text-[#121f38]">Thông tin thêm</h2>
                        <p>Ghi chú đặt hàng (Không bắt buộc)</p>
                        <textarea name="orderNotes" class="w-full p-2 border border-gray-300 rounded-md" rows="5"
                            placeholder="Ghi chú về đơn hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng.">{{ old('orderNotes') }}</textarea>
                        @error('orderNotes')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Cart Table -->
                <table class="w-full mt-8 text-left border-collapse">
                    <thead>
                        <tr class="text-white bg-amber-700">
                            <th class="p-2">Hình ảnh</th>
                            <th class="p-2">Tên sản phẩm</th>
                            <th class="p-2">Giá</th>
                            <th class="p-2">Số lượng</th>
                            <th class="p-2">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr class="border-b">
                                <td class="p-2">
                                    <img src="{{ asset('storage/' . ($item->product->image ?? 'https://via.placeholder.com/64')) }}"
                                        alt="Product" class="object-cover w-16 h-16">
                                </td>
                                <td class="p-2">{{ $item->product->name }}</td>
                                <td class="p-2">{{ number_format($item->product->price) }}đ</td>
                                <td class="p-2">{{ $item->quantity }}</td>
                                <td class="p-2">{{ number_format($item->product->price * $item->quantity) }}đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Summary Table -->
                <table class="w-full mt-4 border-collapse">
                    <tbody>
                        <tr class="border-b">
                            <td class="p-2">Tổng phụ</td>
                            <td class="p-2 text-right">{{ number_format($subTotal) }}đ</td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-2">Tổng</td>
                            <td class="p-2 text-right">{{ number_format($total) }}đ</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Payment Method (VNPay only) -->
                <div class="p-4">
                    <p class="text-sm text-gray-600">Thanh toán qua VNPay.</p>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="relative mt-[24px] z-[1] inline-block px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                    THANH TOÁN QUA VNPAY
                    <span
                        class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                    <span
                        class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                </button>
            </form>
        </div>
    </main>
@endsection
