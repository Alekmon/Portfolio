@extends('Layouts.Admin')

@section('title', 'Изменить меню')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end m-2 p-2">
            <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">Назад</a>
        </div>
        <div class="m-2 p-2">
            <div class="space-y-8 divide-y divide-gray-200 mt-10 w-1/2">
                <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="sm:col-span-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Название</label>
                        <div class="mt-1">
                            <input type="text" id="name" name="name" class="block w-full text-sm border border-gray-400 rounded" value="{{ $menu->name }}">
                            @error('name')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-3">
                        <label for="image" class="block text-sm font-medium text-gray-700">Изображение</label>
                        <div class="mt-1">
                            <input type="file" id="image" name="image" class="block w-full border border-gray-400 bg-white rounded">
                            <img src="{{ Storage::url($menu->image) }}" class="w-16 h-16 rounded mt-2">
                            @error('image')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6 pt-5">
                        <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                        <div class="mt-1">
                            <textarea name="description" id="description" rows="3" class="shadow-sm w-full text-sm border border-gray-400 rounded">{{ $menu->description }}</textarea>
                            @error('description')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-3">
                        <label for="categories" class="block text-sm font-medium text-gray-700">Категория</label>
                        <div class="mt-1">
                            <select id="categories" name="categories[]" class="form-multiselect block w-1/4 border text-sm border-gray-400 bg-white rounded text-center p-1" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($menu->categories->contains($category))>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-3">
                        <label for="price" class="block text-sm font-medium text-gray-700">Цена</label>
                        <div class="mt-1">
                            <input type="number" min="0.00" max="10000.00" step="0.01" id="price" name="price" value="{{ $menu->price }}" class="block w-1/4 border text-sm border-gray-400 bg-white rounded">
                            @error('price')
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