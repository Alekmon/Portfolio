@extends('Layouts.Authentication')

@section('title', 'Войти')

@section('content')
    <div class="px-12 py-16 w-full">
    @if (session('message'))
        <p class="bg-green-200 w-full text-center mb-6">{{ session('message') }}</p>
    @endif
        <h2 class="text-3xl mb-4 text-center">Логин</h2>
        <form action="{{ route('user.logUser') }}" method="POST">
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
                <p class="mb-2">Запомнить меня <input type="checkbox" value="1" name="remember"></p>  
                <button type="submit" class="w-full bg-purple-500 py-3 text-center text-white">Войти</button>
                <p class="mt-2"><a href="{{ route('user.showForgetPassword') }}" class="flex ">Забыли пароль?</a></p>
            </div>
        </form>
    </div>
@endsection