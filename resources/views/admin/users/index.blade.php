@extends('layouts.app')

@section('title', 'Akun - Dashboard')

@php
  $title = 'user';

  $columns = [['width' => 5, 'name' => 'ID'], 'Name', 'Email', 'Role', ['width' => 18, 'name' => 'Actions']];

  $routes = [
      'create' => route('admin.users.create'),
  ];
@endphp

@section('content')
  <x-dashboard-layout active="akun">
    <x-data-table :columns="$columns" :routes="$routes" :title="$title">
      <x-slot name="filters">
        <form action="{{ route('admin.users.index') }}" method="get" class="flex flex-col gap-2 md:flex-row">
          <div class="relative flex-1">
            <div class="relative">
              <input type="text"
                class="dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 peer block w-full rounded-lg border-gray-200 px-3 py-2 ps-11 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                name="search" placeholder="Cari sebuah pengguna" value="{{ request()->has('search') ? request()->input('search') : '' }}">
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
              <p class="dark:text-neutral-500 mt-2 text-sm text-gray-500" id="hs-input-helper-text">{{ $message }}
              </p>
            @enderror
          </div>

          <x-button type="submit" class="bg-secondary tertiary px-3 py-2 text-white hover:rounded-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-4">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>

            Terapkan
          </x-button>
        </form>
      </x-slot>

      @foreach ($users as $i => $user)
        <tr
          class="dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700 odd:bg-white even:bg-gray-100 hover:bg-gray-100">
          <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800">
            {{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}
          </td>
          <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm text-gray-800">
            {{ $user->name }}
          </td>
          <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm text-gray-800">
            {{ $user->email }}
          </td>
          <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm text-gray-800">
            {{ $user->role->name }}
          </td>
          <td class="flex gap-2 whitespace-nowrap px-6 py-4 text-end text-sm font-medium">
            <x-link-button to="{{ route('admin.users.edit', $user->id) }}"
              class="border-caution hover:bg-caution hover:text-white">
              <i data-lucide="edit" class="size-5 stroke-[1.5]"></i>
              Edit
            </x-link-button>

            <x-button type="button" class="border-danger hover:bg-danger hover:text-white"
              hxHeaders='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
              hx-delete="{{ route('admin.users.destroy', $user->id) }}" hx-target="closest tr" hx-swap="outerHTML"
              delete-confirmation>
              <i data-lucide="trash-2" class="size-5 stroke-[1.5]"></i>
              Hapus
            </x-button>

            <x-link-button to="{{ route('admin.users.show', $user->id) }}"
              class="border-info hover:bg-info hover:text-white">
              <i data-lucide="info" class="size-5 stroke-[1.5]"></i>
              Info
            </x-link-button>
          </td>
        </tr>
      @endforeach

      <x-slot name="footer">
        <div class="flex justify-between">
          <x-paginate-links :links="$users"></x-paginate-links>

          <x-paginate-counter :items="$users"></x-paginate-counter>
        </div>
      </x-slot>
    </x-data-table>
  </x-dashboard-layout>
@endsection
