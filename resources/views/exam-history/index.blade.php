@extends('layouts.app')

@section('title', 'Riwayat Ujian - Dashboard')

@php
  $title = 'riwayat ujian';

  $columns = [
    ['width' => 5, 'name' => 'ID'],
    'Nama Ujian',
    'Waktu Mulai',
    'Waktu Selesai',
    ['width' => 18, 'name' => 'Actions']
  ];

  $routes = [];
@endphp

@section('content')
  <x-dashboard-layout active="riwayat ujian" :enableAdmin=false>
    <x-data-table :columns="$columns" :routes="$routes" :title="$title">
      <x-slot name="filters">
        <form action="{{ route('exam-history.index') }}" method="get" class="flex flex-col gap-2 md:flex-row">
          <div class="relative flex-1">
            <input type="search" name="search" class="form-control peer ps-11 shadow-sm" placeholder="Cari riwayat ...">

            <div class="form-control-icon peer-disabled:pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
              </svg>
            </div>

            @error('search')
              <p class="dark:text-neutral-500 mt-2 text-sm text-gray-500" id="hs-input-helper-text">{{ $message }}
              </p>
            @enderror
          </div>

          <button type="submit" class="btn border-primary text-tertiary">
            Terapkan
          </button>
        </form>
      </x-slot>

      @foreach ($results as $i => $result)
        <tr
          class="dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700 odd:bg-white even:bg-gray-100 hover:bg-gray-100">
          <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800">
            {{ $i + 1 }}
          </td>
          <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm text-gray-800">
            {{ $result->exam->name }}
          </td>
          <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm text-gray-800">
            {{ $result->start_date }}
          </td>
          <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm text-gray-800">
            {{ $result->end_date }}
          </td>
          <td class="whitespace-nowrap flex gap-2 px-6 py-4 text-end text-sm font-medium">
            <a href="{{ route('exam-history.show', $result->id) }}" class="btn bg-info text-white flex items-center gap-2">
              <i class="material-symbols-outlined font-var-light">info</i>
              Info
            </a>
          </td>
        </tr>
      @endforeach

      <x-slot name="footer">
        <div class="flex justify-between">
          <x-paginate-links :links="$results"></x-paginate-links>

          <x-paginate-counter :items="$results"></x-paginate-counter>
        </div>
      </x-slot>
    </x-data-table>
  </x-dashboard-layout>
@endsection
