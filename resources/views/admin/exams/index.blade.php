@extends('layouts.app')

@section('title', 'Ujian - Dashboard')

@section('meta')
  <meta name="plugins" content="timezone">
@endsection

@php
  $title = 'ujian';

  $columns = [
      ['width' => 5, 'name' => 'ID'],
      'Nama',
      'Paket Soal',
      'Durasi',
      'Waktu Mulai',
      'Waktu Tenggat',
      'Token',
      ['width' => 18, 'name' => 'Actions'],
  ];

  $routes = [
      'create' => route('admin.exams.create'),
  ];
@endphp

@section('content')
  <x-dashboard-layout active="daftar ujian">
    <x-data-table :columns="$columns" :routes="$routes" :title="$title">
      <x-slot name="filters">
        <form action="{{ route('admin.exams.index') }}" method="get" class="flex flex-col gap-2 md:flex-row">
          <div class="relative flex-1">
            <div class="relative">
              <input type="text"
                class="peer block w-full rounded-lg border-gray-200 px-3 py-2 ps-11 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-transparent dark:bg-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                name="search" placeholder="Cari sebuah ujian"
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

          <x-button type="submit" class="bg-secondary px-3 py-2 text-white hover:rounded-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-4">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>

            Terapkan
          </x-button>
        </form>
      </x-slot>

      @foreach ($exams as $i => $exam)
        <tr
          class="odd:bg-white even:bg-gray-100 hover:bg-gray-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
          <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
            {{ ($exams->currentPage() - 1) * $exams->perPage() + $i + 1 }}
          </td>
          <td class="max-w-72 px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
            {!! nl2br(e(strip_tags($exam->name))) !!}
          </td>
          <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
            {{ $exam->packet->name }}
          </td>
          <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
            {{ $exam->duration }} menit
          </td>
          <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200" timezone-change>
            {{ $exam->start_date }}
          </td>
          <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200" timezone-change>
            {{ $exam->end_date }}
          </td>
          <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
            {{ $exam->token ? $exam->token : '-' }}
          </td>
          <td class="flex gap-2 whitespace-nowrap px-6 py-4 text-end text-sm font-medium">
            <x-link-button to="{{ route('admin.exams.edit', $exam->id) }}"
              class="border-caution hover:bg-caution hover:text-white">
              <i class="material-symbols-outlined font-var-light">edit</i>
              Edit
            </x-link-button>

            <x-button type="button" class="border-danger hover:bg-danger hover:text-white" hx-confirm="ujian"
              hxHeaders='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
              hx-delete="{{ route('admin.exams.destroy', $exam->id) }}" hx-target="closest tr" hx-swap="outerHTML"
              delete-confirmation>
              <i class="material-symbols-outlined font-var-light">delete</i>
              Hapus
            </x-button>

            <x-link-button to="{{ route('admin.exams.show', $exam->id) }}"
              class="border-info hover:bg-info hover:text-white">
              <i class="material-symbols-outlined font-var-light">info</i>
              Info
            </x-link-button>
          </td>
        </tr>
      @endforeach

      <x-slot name="footer">
        <div class="flex justify-between">
          <x-paginate-links :links="$exams"></x-paginate-links>

          <x-paginate-counter :items="$exams"></x-paginate-counter>
        </div>
      </x-slot>
    </x-data-table>
  </x-dashboard-layout>
@endsection
