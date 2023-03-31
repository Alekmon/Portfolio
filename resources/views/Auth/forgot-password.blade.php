@extends('Layouts.Authentication')

@section('title', 'Восстоновление Пароля')

@section('content')
    <div class="px-12 py-16 w-full">
        <h2 class="text-3xl mb-4 text-center">Изменить Пароль</h2>
        <form action="{{ route('user.submitForgetPassword') }}" method="POST">
            @csrf
            <div class="mb-5">
                <input type="email" placeholder="Почта" name="email" class="border border-gray-400 py-2 px-3 w-full rounded-md">
                @error('email')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <button type="submit" class="w-full bg-purple-500 py-3 text-center text-white">Подтвердить</button>
            </div>
        </form>
    </div>
@endsection