<!-- resources/views/admin/products/edit.blade.php -->
@extends('layouts.master')

@section('title', 'Sửa sản phẩm')

@section('file', 'admin.products.edit')

@section('page', 'admin.products.edit')

@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Sửa sản phẩm: {{ $product->name }}</h1>
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Giá</label>
                    <input type="number" name="price" id="price" step="0.01"
                        value="{{ old('price', $product->price) }}" class="mt-1 block w-full border-gray-300 rounded-md"
                        required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh chính</label>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Main Image"
                            class="w-16 h-16 object-cover inline-block mr-2 mb-2">
                    @endif
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="additional_images" class="block text-sm font-medium text-gray-700">Hình ảnh phụ</label>
                    <!-- Hiển thị ảnh hiện tại với checkbox để chọn xóa -->
                    <div class="flex gap-2 mb-2 flex-wrap">
                        @foreach ($product->additionalImages as $image)
                            <div class="relative">
                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"
                                    class="absolute top-1 left-1 z-10">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Additional Image"
                                    class="w-16 h-16 object-cover border rounded">
                            </div>
                        @endforeach
                    </div>
                    <!-- Upload ảnh mới -->
                    <input type="file" name="additional_images[]" id="additional_images" multiple
                        class="mt-1 block w-full" onchange="previewNewImages(event)" accept="image/*">
                    <div id="new-image-preview" class="flex gap-2 mt-2 flex-wrap"></div>
                    <small class="text-gray-500">* Chọn checkbox để xóa ảnh cũ. Nhấn vào ảnh preview để xóa khỏi danh sách
                        upload. Tối đa 5 ảnh mới.</small>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">Không có</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Số lượng</label>
                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật</button>
                <button onclick="location.href='{{ route('admin.products.index') }}'" type="button"
                    class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Quay lại</button>
            </form>
        </div>
    </main>
@endsection

<script>
    function previewNewImages(event) {
        const preview = document.getElementById('new-image-preview');
        const files = event.target.files;
        const maxImages = 5; // Giới hạn tối đa 5 ảnh mới
        let currentImages = preview.children.length;

        for (let i = 0; i < files.length && currentImages + i < maxImages; i++) {
            const file = files[i];
            if (!file.type.startsWith('image/')) continue;

            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-16 h-16 object-cover border rounded';
                imgContainer.appendChild(img);

                const removeBtn = document.createElement('button');
                removeBtn.className =
                    'absolute top-0 right-0 bg-red-500 text-white w-4 h-4 rounded-full text-xs flex items-center justify-center -mt-2 -mr-2';
                removeBtn.innerHTML = '×';
                removeBtn.onclick = function() {
                    imgContainer.remove();
                };
                imgContainer.appendChild(removeBtn);

                preview.appendChild(imgContainer);
            };
            reader.readAsDataURL(file);
        }

        if (files.length + currentImages > maxImages) {
            alert(`Chỉ được upload tối đa ${maxImages} ảnh mới. Vui lòng xóa một số ảnh preview trước khi thêm mới.`);
        }
    }
</script>
