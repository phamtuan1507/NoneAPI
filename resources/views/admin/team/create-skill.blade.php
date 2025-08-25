@extends('layouts.master')

@section('title', 'Thêm kỹ năng cho nhân viên')

@section('file', 'admin.team.create-skill')

@section('page', 'admin.team.create-skill')

@section('content')
    <main>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Thêm kỹ năng cho {{ $staff->name }}</h1>
            <a href="{{ route('admin.team.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Quay
                lại trang Quản lý nhân viên</a>

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <strong>Lỗi:</strong> {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.staff-skill.store', $staff->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="skill_name" class="block text-sm font-medium text-gray-700">Tên kỹ năng</label>
                    <input type="text" name="skill_name" id="skill_name" value="{{ old('skill_name') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="percentage" class="block text-sm font-medium text-gray-700">Phần trăm (0-100)</label>
                    <input type="number" name="percentage" id="percentage" value="{{ old('percentage') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md" required min="0" max="100">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu kỹ năng</button>
                <button onclick="location.href='{{ route('admin.team.show', $staff->id) }}'" type="button"
                    class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Quay lại</button>
            </form>
        </div>
    </main>
@endsection
