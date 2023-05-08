@extends('Layouts.Main')

@section('title', 'Категория')

@section('content')
<div class="container w-full px-5 py-6 mx-auto">
    <h1 class="text-center text-gray-800 text-lg">Категория: {{ $category->name }}</h1>
    <div class="grid lg:grid-cols-4 gap-y-6 mt-10">

    @foreach ($category->menus as $menu)
      <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
        <img class="w-full h-48" src="{{ Storage::url('public/menus/' . $menu->image) }}"
          alt="Image" />
        <div class="px-6 py-4">
          <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">{{ $menu->name }}</h4>
          <p class="leading-normal text-gray-700">{{ $menu->description }}</p>
        </div>
        <div class="flex items-center justify-between p-4">
          <button class="px-4 py-2 bg-green-600 text-green-50">Заказать</button>
          <span class="text-xl text-green-600">${{ $menu->price }}</span>
        </div>
      </div>
    @endforeach

    </div>
  </div>
@endsection