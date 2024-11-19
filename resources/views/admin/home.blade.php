@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
  <x-dashboard-layout active="home">
    <main class="grid grid-cols-1 md:grid-cols-2 gap-3 lg:grid-cols-3 xl:grid-cols-4 w-full">
      <x-card class="shadow">
        Stat
      </x-card>

      <x-card class="shadow">
        Stat
      </x-card>

      <x-card class="shadow">
        Stat
      </x-card>

      <x-card class="shadow">
        Stat
      </x-card>

      <x-card class="col-span-3 shadow">
        Latest data
      </x-card>

      <x-card class="shadow">
        Legend
      </x-card>

      <x-card class="col-span-2 shadow">
        More data
      </x-card>

      <x-card class="col-span-2 shadow">
        More data
      </x-card>
    </main>
  </x-dashboard-layout>
@endsection