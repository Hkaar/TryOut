@extends('layouts.app')

@section('title', 'Group - Dashboard')

@php
  $title = 'group';

  $columns = [['width' => 5, 'name' => 'ID'], 'Nama', ['width' => 18, 'name' => 'Actions']];

  $routes = [
      'create' => route('admin.groups.create'),
  ];
@endphp

@section('content')
  <x-dashboard-layout active="group">
    <x-data-table :columns="$columns" :routes="$routes" :title="$title">
      <x-slot name="filters">
        <form action="{{ route('admin.students.index') }}" method="get" class="flex flex-col gap-2 md:flex-row">
          <div class="relative flex-1">
            <div class="relative">
              <input type="text"
                class="dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 peer block w-full rounded-lg border-gray-200 px-3 py-2 ps-11 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                name="search"
                placeholder="Cari sebuah group" value="{{ request()->has('search') ? request()->input('search') : '' }}">
              <div
                class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-4 peer-disabled:pointer-events-none peer-disabled:opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
              </div>
            </div>

            @error('search')
              <p class="dark:text-neutral-500 mt-2 text-sm text-gray-500" id="hs-input-helper-text">{{ $message }}
              </p>
            @enderror
          </div>

          <x-button type="submit" class="bg-secondary px-3 py-2 hover:rounded-none text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-4">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>

            Terapkan
          </x-button>
        </form>
      </x-slot>

      @foreach ($groups as $i => $group)
        <tr
          class="dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700 odd:bg-white even:bg-gray-100 hover:bg-gray-100">
          <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800">
            {{ ($groups->currentPage() - 1) * $groups->perPage() + $i + 1 }}
          </td>
          <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm text-gray-800">
            {{ $group->name }}
          </td>
          <td class="flex gap-2 whitespace-nowrap px-6 py-4 text-end text-sm font-medium">
            <x-link-button to="{{ route('admin.groups.edit', $group->id) }}"
              class="border-caution hover:bg-caution hover:text-white">
              <i data-lucide="edit" class="size-5 stroke-[1.5]"></i>
              Edit
            </x-link-button>

            <x-button type="button" class="border-danger hover:bg-danger hover:text-white" hx-confirm="group"
              hxHeaders='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
              hx-delete="{{ route('admin.groups.destroy', $group->id) }}" hx-target="closest tr" hx-swap="outerHTML"
              delete-confirmation>
              <i data-lucide="trash-2" class="size-5 stroke-[1.5]"></i>
              Hapus
            </x-button>
          </td>
        </tr>
      @endforeach

      <x-slot name="footer">
        <div class="flex justify-between">
          <x-paginate-links :links="$groups"></x-paginate-links>

          <x-paginate-counter :items="$groups"></x-paginate-counter>
        </div>
      </x-slot>
    </x-data-table>
  </x-dashboard-layout>
@endsection
