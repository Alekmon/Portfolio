@extends('Layouts.Admin')

@section('title', 'Главная')

@section('content')
<h1 class="text-2xl m-4 text-center">Контент</h1>
  <div>
    <ul>
      <li class="m-2 text-lg">Категории:<a href="{{ route('admin.categories.index') }}" class="ml-2 px-3 py-1 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">{{ $categories }}</a></li>
      <li class="m-2 text-lg">Меню:<a href="{{ route('admin.menus.index') }}" class="ml-2 px-3 py-1 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">{{ $menus }}</a></li>
      <li class="m-2 text-lg">Столики:<a href="{{ route('admin.tables.index') }}" class="ml-2 px-3 py-1 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">{{ $tables }}</a></li>
      <li class="m-2 text-lg">Бронь:<a href="{{ route('admin.reservation.index') }}" class="ml-2 px-3 py-1 bg-indigo-500 hover:bg-indigo-700 rounded hover:text-white">{{ $reservations }}</a></li>
    </ul>
  </div>
@endsection