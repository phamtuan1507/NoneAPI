@extends('layouts.master')
@section('title', 'Thanh toán thành công')
@section('content')
    <div class="container mx-auto px-4 py-8 text-center">
        <h1 class="text-2xl font-bold">Thanh toán thành công!</h1>
        <p>Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn sẽ được xử lý sớm.</p>
        <a href="{{ route('home') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Quay về trang chủ</a>
    </div>
@endsection
