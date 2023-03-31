@extends('Layouts.Authentication')

@section('title', 'Изменить Пароль')

@section('content')
    <div class="px-12 py-16 w-full">
        @if (session('message'))
            <p class="bg-green-200 w-full text-center mb-6">{{ session('message') }}</p>
        @endif
        <h2 class="text-3xl mb-4 text-center">Введите ваш новый пароль</h2>
        <form action="" method="POST">
            @csrf
            <div class="mb-5">
                <input type="email" placeholder="Почта" name="email" class="border border-gray-400 py-2 px-3 w-full rounded-md">
                @error('email')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <input type="password" placeholder="Пароль" name="password" class="border border-gray-400 py-2 px-3 w-full rounded-md">
                @error('password')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <input type="password" placeholder="Родтвердите пароль" name="password_confirmation" class="border border-gray-400 py-2 px-3 w-full rounded-md">
            </div>
            <div class="mb-5">
                <button type="submit" class="w-full bg-purple-500 py-3 text-center text-white">Подтвердить</button>
            </div>
        </form>
    </div>
@endsection