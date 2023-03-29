@extends('Layouts.Main')

@section('title', 'Бронирование')

@section('content')
<div class="container w-full px-5 py-6 mx-auto">
    <div class="flex items-center min-h-screen bg-gray-50">
        <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
            <div class="flex flex-col md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img class="object-cover w-full h-full"
                        src="{{asset('img/green-tea.jpeg')}}" alt="img" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h3 class="mb-4 text-xl font-bold text-blue-600">Бронирование</h3>

                        <div class="w-full bg-gray-200 rounded-full">
                            <div
                                class="w-100 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                                Шаг2</div>
                        </div>

                        <form action="{{ route('reservation.storeTwo') }}" method="POST">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="table_id" class="block text-sm font-medium text-gray-700">Столик</label>
                                <div class="mt-1">
                                    <select id="table_id" name="table_id" class="form-multiselect block w-full border text-sm border-gray-400 bg-white rounded text-center p-1">
                                        @foreach ($tables as $table)
                                            <option value="{{ $table->id }}">{{ $table->name }} ({{ $table->guest_number }})</option>
                                        @endforeach
                                    </select>
                                    @error('table_id')
                                        <p class="text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            <div class="mt-6 p-4 flex justify-between">
                                <a href="{{ route('reservation.one') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Назад</a>
                                <button type="submit"
                                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Зарезервировать</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection