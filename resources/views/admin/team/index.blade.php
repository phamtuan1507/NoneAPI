{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Quản lý nhân viên')

{{-- Đặt file css cho page --}}
@section('file', 'team.index')


{{-- Đặt class cho body --}}
@section('page', 'team.index')
@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Quản lý nhân viên</h1>
            <a href="{{ route('admin.team.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Thêm nhân viên mới</a>
            <a href="{{ route('admin.dashboard') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Quay lại trang dashboard</a>
            <table class="w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4">Tên</th>
                        <th class="py-2 px-4">Chức vụ</th>
                        <th class="py-2 px-4">Số điện thoại</th>
                        <th class="py-2 px-4">Email</th>
                        <th class="py-2 px-4">Hình ảnh</th>
                        <th class="py-2 px-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $product)
                        <tr>
                            <td class="border px-4 py-2">{{ $product->name }}</td>
                            <td class="border px-4 py-2">{{ $product->position }}</td>
                            <td class="border px-4 py-2">{{ $product->phone }}</td>
                            <td class="border px-4 py-2">{{ $product->email }}</td>
                            <td class="border px-4 py-2">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-16 h-16 object-cover">
                                @else
                                    Không có
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                {{-- <a href="{{ route('admin.staff-skill.create', $product->id) }}" class="text-green-500 hover:underline">Thêm kỹ năng</a> --}}
                                <a href="{{ route('admin.staff-skill.create', $product->id) }}">Thêm kỹ năng</a>
                                <a href="{{ route('admin.team.edit', $product->id) }}" class="text-blue-500">Sửa</a>
                                <form action="{{ route('admin.team.destroy', $product->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $staffs->links() }}
        </div>
    </main>
@endsection
