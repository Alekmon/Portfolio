@extends('Layouts.Admin')

@section('title', 'Изменить категорию')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end m-2 p-2">
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">Назад</a>
        </div>
        <div class="m-2 p-2">
            <div class="space-y-8 divide-y divide-gray-200 mt-10 w-1/2">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="sm:col-span-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Название</label>
                        <div class="mt-1">
                            <input type="text" id="name" name="name" class="block w-full border border-gray-400 rounded" value="{{ $category->name }}">
                            @error('name')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-3">
                        <label for="image" class="block text-sm font-medium text-gray-700">Изображение</label>
                        <div class="mt-1">
                            <input type="file" id="image" name="image" class="block w-full border border-gray-400 bg-white rounded">
                            <img src="{{ Storage::url($category->image) }}" class="w-16 h-16 rounded mt-2">
                            @error('image')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6 pt-5">
                        <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                        <div class="mt-1">
                            <textarea name="description" id="description" rows="3" class="shadow-sm w-full border border-gray-400 rounded">{{ $category->description }}</textarea>
                            @error('description')
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