@extends('layouts.app')

@section('title', 'Riwayat Ujian - Dashboard')

@php
  $title = 'riwayat ujian';

  $columns = [
      ['width' => 5, 'name' => 'ID'],
      'Nama Peserta',
      'Nama Ujian',
      'Waktu Mulai',
      'Waktu Selesai',
      'Status',
      ['width' => 7, 'name' => 'Actions'],
  ];

  $routes = [];
@endphp

@section('content')
  <x-dashboard-layout active="riwayat ujian">
    <x-data-table :columns="$columns" :routes="$routes" :title="$title">
      <x-slot name="filters">
        <form action="{{ route('admin.exam-history.index') }}" method="get" class="flex flex-col gap-3 md:flex-row">
          <div class="relative">
            <div class="relative">
              <input type="text"
                class="peer block w-full rounded-lg border-gray-200 px-3 py-2 ps-11 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-transparent dark:bg-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                name="search" placeholder="Cari sebuah riwayat ujian"
                value="{{ request()->has('search') ? request()->input('search') : '' }}">
              <div
                class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-4 peer-disabled:pointer-events-none peer-disabled:opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-4">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
              </div>
            </div>

            @error('search')
              <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500" id="hs-input-helper-text">{{ $message }}
              </p>
            @enderror
          </div>

          <select
            class="block w-full md:w-32 rounded-lg border-gray-200 px-3 py-2 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
            name="group">
            <option selected disabled>Pilih group</option>
            <option value="all" {{ request()->input('group') === 'all' ? 'selected' : '' }}>Semua group</option>

            @foreach ($groups as $group)
              <option value="{{ $group->id }}"
                {{ $group->id === ((int) request()->input('group')) ? 'selected' : '' }}>{{ ucfirst($group->name) }}
              </option>
            @endforeach
          </select>

          <select
            class="block w-full md:w-32 rounded-lg border-gray-200 px-3 py-2 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
            name="exam">
            <option selected disabled>Pilih ujian</option>
            <option value="all" {{ request()->input('exam') === 'all' ? 'selected' : '' }}>Semua ujian</option>

            @foreach ($exams as $exam)
              <option value="{{ $exam->id }}" {{ $exam->id === ((int) request()->input('exam')) ? 'selected' : '' }}>
                {{ ucfirst($exam->name) }}</option>
            @endforeach
          </select>

          <div class="flex items-center gap-2">
            <x-button type="submit" class="bg-secondary flex-1 px-3 py-2 text-white hover:rounded-none">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
              </svg>

              Terapkan
            </x-button>

            <x-link-button :to="route('admin.exam-history.download', request()->query())" class="bg-info flex-1 text-white hover:rounded-none active:rounded-none">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
              </svg>

              Download
            </x-link-button>
          </div>
        </form>


      </x-slot>

      @foreach ($results as $i => $result)
        <tr
          class="odd:bg-white even:bg-gray-100 hover:bg-gray-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
          <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
            {{ ($results->currentPage() - 1) * $results->perPage() + $i + 1 }}
          </td>
          <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
            {{ $result->user->name }}
          </td>
          <td class="max-w-72 px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
            {!! nl2br(e(strip_tags($result->exam->name))) !!}
          </td>
          <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
            {{ Carbon\Carbon::parse($result->start_date)->locale('id')->translatedFormat('l, j F Y H:i:s T') }}
          </td>
          <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
            {{ $result->finish_date? Carbon\Carbon::parse($result->finish_date)->locale('id')->translatedFormat('l, j F Y H:i:s T'): '-' }}
          </td>
          <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
            @if ($result->finished)
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-6 fill-success">
                <path fill-rule="evenodd"
                  d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                  clip-rule="evenodd" />
              </svg>
            @else
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-6 fill-danger">
                <path fill-rule="evenodd"
                  d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                  clip-rule="evenodd" />
              </svg>
            @endif
          </td>
          <td class="flex gap-2 whitespace-nowrap px-6 py-4 text-end text-sm font-medium">
            <x-link-button to="{{ route('admin.exam-history.show', $result->id) }}"
              class="border-info hover:bg-info hover:text-white">
              <i data-lucide="info" class="size-5 stroke-[1.5]"></i>

              Info
            </x-link-button>
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
