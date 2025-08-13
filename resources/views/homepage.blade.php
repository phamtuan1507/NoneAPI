{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Trang chủ')

{{-- Đặt file css cho page --}}
@section('file', 'home-page')


{{-- Đặt class cho body --}}
@section('page', 'home-page')
@section('content')
    <main class="font-bold text-[#fcdc39]">
        abc
    </main>
@endsection
