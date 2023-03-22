@extends('Layouts.Admin')

@section('title', 'Создание Категории')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end m-2 p-2">
            <a href="{{ route('admin.reservation.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">Назад</a>
        </div>
        <div class="m-2 p-2">
            <div class="space-y-8 divide-y divide-gray-200 mt-10 w-1/2">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="sm:col-span-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Название</label>
                        <div class="mt-1">
                            <input type="text" id="name" name="name" class="block w-full border border-gray-400 rounded" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-3">
                        <label for="image" class="block text-sm font-medium text-gray-700">Изображение</label>
                        <div class="mt-1">
                            <input type="file" id="image" name="image" class="block w-full border border-gray-400 bg-white rounded">
                        </div>
                    </div>
                    <div class="sm:col-span-6 pt-5">
                        <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                        <div class="mt-1">
                            <textarea name="description" id="description" rows="3" class="shadow-sm w-full border border-gray-400 rounded">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-3">
                        <button type="submit" class="bg-indigo-300 px-4 py-2 hover:bg-indigo-500 rounded hover:text-white">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection