@extends('layouts.master')
@section('title', 'Thanh toán thất bại')
@section('content')
    <div class="container mx-auto px-4 py-8 text-center">
        <h1 class="text-2xl font-bold">Thanh toán thất bại!</h1>
        <p>Có lỗi xảy ra. Vui lòng thử lại hoặc liên hệ hỗ trợ.</p>
        <a href="{{ route('checkout') }}" class="mt-4 inline-block bg-red-500 text-white px-4 py-2 rounded">Thử lại</a>
    </div>
@endsection
