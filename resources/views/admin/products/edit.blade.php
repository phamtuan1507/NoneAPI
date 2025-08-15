{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Sửa sản phẩm')

{{-- Đặt file css cho page --}}
@section('file', 'products.edit')


{{-- Đặt class cho body --}}
@section('page', 'products.edit')
@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Sửa sản phẩm</h1>
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md">{{ $product->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Giá</label>
                    <input type="number" name="price" id="price" step="0.01" value="{{ $product->price }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh chính</label>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-16 h-16 object-cover mb-2">
                    @endif
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="additional_images" class="block text-sm font-medium text-gray-700">Hình ảnh phụ</label>
                    @foreach ($product->additionalImages as $image)
                        <img src="{{ asset('storage/' . $image->image) }}" alt="Additional Image"
                            class="w-16 h-16 object-cover inline-block mr-2">
                    @endforeach
                    <input type="file" name="additional_images[]" id="additional_images" multiple
                        class="mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">Không có</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Số lượng</label>
                    <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ $product->sku }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật</button>
            </form>
        </div>
    </main>
@endsection
