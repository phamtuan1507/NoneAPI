@extends('layouts.master')

@section('title', 'Hồ Sơ')

@section('page', 'profile')

@section('content')
    <main class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center">Hồ Sơ Người Dùng</h1>
        <div class="max-w-md mx-auto mt-4 bg-white p-6 rounded shadow-lg">
            <p><strong>Tên:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            @if ($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" alt="Avatar" class="w-32 h-32 rounded-full mx-auto mt-4">
            @endif
        </div>
    </main>
@endsection
