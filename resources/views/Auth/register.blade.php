@extends('Layouts.Authentication')

@section('title', 'Регистрация')

@section('content')
    <div class="px-12 py-16 w-full">
        <h2 class="text-3xl mb-4 text-center">Регистрация</h2>
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-5">
                <input type="text" placeholder="Имя"  name="name" class="border border-gray-400 py-2 px-3 w-full content-center rounded-md">
                @error('name')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>
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
                <p>Запомнить меня <input type="checkbox" value="1" name="remember"></p>
                <button type="submit" class="w-full bg-purple-500 py-3 text-center text-white">Подтвердить</button>
            </div>
        </form>
    </div>
@endsection