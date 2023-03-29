@extends('Layouts.Admin')

@section('title', 'Изменить бронирование')

@section('content')
<div class="py-12">
    <div>
        @if(session('message'))
            <p class="bg-green-200 w-full text-center">{{ session('message') }}</p>
        @endif
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end m-2 p-2">
            <a href="{{ route('admin.reservation.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">Назад</a>
        </div>
        <div class="m-2 p-2">
            <div class="space-y-8 divide-y divide-gray-200 mt-10 w-1/2">
                <form action="{{ route('admin.reservation.update', $reservation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="sm:col-span-6">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Имя</label>
                        <div class="mt-1">
                            <input type="text" id="first_name" name="first_name" class="block w-full border border-gray-400 rounded" value="{{ $reservation->first_name }}">
                            @error('first_name')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Фамилия</label>
                        <div class="mt-1">
                            <input type="text" id="last_name" name="last_name" class="block w-full border border-gray-400 rounded" value="{{ $reservation->last_name }}">
                            @error('last_name')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="email" class="block text-sm font-medium text-gray-700">Почта</label>
                        <div class="mt-1">
                            <input type="email" id="email" name="email" class="block w-1/2 border border-gray-400 rounded" value="{{ $reservation->email }}">
                            @error('email')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="tel_number" class="block text-sm font-medium text-gray-700">Номер Телефона</label>
                        <div class="mt-1">
                            <input type="text" id="tel_number" name="tel_number" class="block w-1/2 border border-gray-400 rounded" value="{{ $reservation->tel_number }}">
                            @error('tel_number')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="res_date" class="block text-sm font-medium text-gray-700">Дата Брони</label>
                        <div class="mt-1">
                            <input type="datetime-local" id="res_date" name="res_date" class="block w-1/2 text-center border border-gray-400 rounded" value="{{ $reservation->res_date }}">
                            @error('res_date')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="table_id" class="block text-sm font-medium text-gray-700">Столик</label>
                        <div class="mt-1">
                            <select id="table_id" name="table_id" class="form-multiselect block w-1/4 border text-sm border-gray-400 bg-white rounded text-center p-1">
                                @foreach ($tables as $table)
                                    <option value="{{ $table->id }}" @selected($table->id == $reservation->table_id)>{{ $table->name }} ({{ $table->guest_number }})</option>
                                @endforeach
                            </select>
                            @error('table_id')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="guest_number" class="block text-sm font-medium text-gray-700">Колличество Гостей</label>
                        <div class="mt-1">
                            <input type="number" id="guest_number" name="guest_number" class="block w-1/4 border border-gray-400 rounded" value="{{ $reservation->guest_number }}">
                            @error('guest_number')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-3">
                        <button type="submit" class="bg-indigo-300 px-4 py-2 hover:bg-indigo-500 rounded hover:text-white">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection