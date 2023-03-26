@extends('Layouts.Admin')

@section('title', 'Изменение Столика')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end m-2 p-2">
            <a href="{{ route('admin.tables.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">Назад</a>
        </div>
        <div class="m-2 p-2">
            <div class="space-y-8 divide-y divide-gray-200 mt-10 w-1/2">
                <form action="{{ route('admin.tables.update', $table->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="sm:col-span-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Название</label>
                        <div class="mt-1">
                            <input type="text" id="name" name="name" class="block w-full border border-gray-400 rounded" value="{{ $table->name }}">
                            @error('name')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="guest_number" class="block text-sm font-medium text-gray-700">Колличество гостей</label>
                        <div class="mt-1">
                            <input type="number" id="guest_number" name="guest_number" class="block w-1/4 border border-gray-400 rounded" value="{{ $table->guest_number }}">
                            @error('guest_number')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="location" class="block text-sm font-medium text-gray-700">Место</label>
                        <div class="mt-1">
                            <select id="location" name="location" class="form-multiselect block w-1/4 border text-sm border-gray-400 bg-white rounded text-center p-1">
                            @foreach(App\Enums\TableLocation::cases() as $location)
                                <option value="{{ $location->value }}" @selected( $table->location->value == $location->value)>{{ $location->name }}</option>
                            @endforeach
                            </select>
                            @error('location')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="status" class="block text-sm font-medium text-gray-700">Статус</label>
                        <div class="mt-1">
                            <select id="status" name="status" class="form-multiselect block w-1/4 border text-sm border-gray-400 bg-white rounded text-center p-1">
                            @foreach(App\Enums\TableStatus::cases() as $status)
                                <option value="{{ $status->value }}" @selected($table->status->value == $status->value)>{{ $status->name }}</option>
                            @endforeach
                            </select>
                            @error('status')
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