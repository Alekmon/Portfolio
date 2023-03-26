@extends('Layouts.Admin')

@section('title', 'Меню')

@section('content')
<div class="py-12">
    <div>
        @if(session('message'))
            <p class="bg-green-200 w-full text-center">{{ session('message') }}</p>
        @endif
    </div>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex justify-end m-2 p-2">
        <a href="{{ route('admin.menus.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">Создать Меню</a>
    </div>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Название 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Изображение
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Описание
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Цена
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Изменить\Удалить
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-00 whitespace-nowrap dark:text-white">
                        {{ $menu->name }}
                    </th>
                    <td class="px-6 py-4">
                        <img src="{{ Storage::url($menu->image) }}" alt="image" class="w-16 h-16 rounded">
                    </td>
                    <td class="px-6 py-4">
                        {{ $menu->description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $menu->price }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex spcae-x-2">
                        <a href="{{ route('admin.menus.edit', $menu->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center">Изменить</a>\
                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" onclick="return confirm('Вы действительно хотите удалить меню: {{ $menu->name }}?')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center">Удалить</button>
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