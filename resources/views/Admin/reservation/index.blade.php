@extends('Layouts.Admin')

@section('title', 'Бронирование')

@section('content')
<div class="py-12">
    <div>
        @if(session('message'))
            <p class="bg-green-200 w-full text-center">{{ session('message') }}</p>
        @endif
    </div>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex justify-end m-2 p-2">
        <a href="{{ route('admin.reservation.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">Создать Бронь</a>
    </div>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Имя 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Фамилия 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Почта
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Номер Телефона
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Дата Брони
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Столик
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Колличество Гостей
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Изменить\Удалить
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-00 whitespace-nowrap dark:text-white">
                        {{ $reservation->id }}
                    </th>
                    <th scope="row" class="px-6 py-4">
                        {{ $reservation->first_name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $reservation->last_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->tel_number }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->res_date }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->table->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->guest_number }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex spcae-x-2">
                        <a href="{{ route('admin.reservation.edit', $reservation->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center">Изменить</a>\
                        <form action="{{ route('admin.reservation.destroy', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" onclick="return confirm('Вы действительно хотите удалить бронь №{{ $reservation->id }}?')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center">Удалить</button>
                        </form>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection