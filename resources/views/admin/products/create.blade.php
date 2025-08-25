{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Thêm sản phẩm')

{{-- Đặt file css cho page --}}
@section('file', 'products.create')

{{-- Đặt class cho body --}}
@section('page', 'products.create')
@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Thêm sản phẩm mới</h1>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md"
                        required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Giá</label>
                    <input type="number" name="price" id="price" step="0.01"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh chính</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="additional_images" class="block text-sm font-medium text-gray-700">Hình ảnh phụ (chọn nhiều
                        ảnh, tối đa 5)</label>
                    <input type="file" name="additional_images[]" id="additional_images" multiple
                        class="mt-1 block w-full" onchange="previewImages(event)" accept="image/*">
                    <div id="image-preview" class="flex gap-2 mt-2 flex-wrap"></div>
                    <small class="text-gray-500">* Nhấn vào ảnh để xóa khỏi preview.</small>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">Không có</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Số lượng</label>
                    <input type="number" name="quantity" id="quantity"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                    <input type="text" name="sku" id="sku" class="mt-1 block w-full border-gray-300 rounded-md"
                        required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu</button>
                <button onclick="location.href='{{ route('admin.products.index') }}'" type="button"
                    class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Quay lại</button>
            </form>
        </div>
    </main>
@endsection
<script>
    function previewImages(event) {
        const preview = document.getElementById('image-preview');
        const files = event.target.files;
        const maxImages = 5; // Giới hạn tối đa 5 ảnh
        let currentImages = preview.children.length;

        for (let i = 0; i < files.length && currentImages + i < maxImages; i++) {
            const file = files[i];
            if (!file.type.startsWith('image/')) continue; // Chỉ chấp nhận file ảnh

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

        // Nếu vượt quá giới hạn, thông báo
        if (files.length + currentImages > maxImages) {
            alert(`Chỉ được upload tối đa ${maxImages} ảnh. Vui lòng xóa một số ảnh trước khi thêm mới.`);
        }
    }
</script>
