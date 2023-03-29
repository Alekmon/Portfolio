@extends('Layouts.Main')

@section('title', 'Категории')

@section('content')
<div class="container w-full px-5 py-6 mx-auto">
    <h1 class="text-center text-gray-800 text-lg">Категории</h1>
    <div class="grid lg:grid-cols-4 gap-y-6 mt-10">
    @foreach ($categories as $category)
      <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
        <img class="w-full h-48" src="{{ Storage::url($category->image) }}"
          alt="Image" />
        <div class="px-6 py-4">

          <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase"><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></h4>
          <p class="leading-normal text-gray-700">{{ $category->description }}</p>
        </div>

      </div>
    @endforeach

    </div>
  </div>
@endsection