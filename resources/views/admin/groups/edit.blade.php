@extends('layouts.app')

@section('title', 'Group - Dashboard')

@section('content')
  <x-dashboard-layout active="group">
    <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-y-5">
      <div class="flex-1 grid place-items-center">
        <div class="flex flex-col gap-3 w-full">
          <div class="flex gap-4 items-center">
            <i data-lucide="layout-grid" class="size-8 stroke-[1.5]"></i>

            <span class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">Mengedit group</h3>
              <p class="text-gray-400">
                Perbarui grup yang sudah ada di sistem anda
              </p>
            </span>
          </div>

          <div class="flex flex-col h-fit border rounded-md p-4 shadow-md">
            <form action="{{ route('admin.groups.update', $group->id) }}" method="post">
              @csrf
              @method('PUT')

              <div class="w-full mb-5">
                <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nama Group</label>
                <input type="text" id="name" name="name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                  placeholder="Masukkan nama group ..." value="{{ $group->name }}">

                @error('name')
                  <p>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <div class="flex items-center gap-2">
                <x-button type="submit" class="bg-primary text-white hover:rounded-none hover:shadow-lg">
                  <i data-lucide="save" class="size-5 stroke-[1.5]"></i>

                  Simpan
                </x-button>

                <x-link-button to="{{ route('admin.groups.index') }}"
                  class="border-danger hover:rounded-none hover:bg-danger hover:text-white hover:shadow-lg">
                  <i data-lucide="circle-x" class="size-5 stroke-[1.5]"></i>

                  Batalkan
                </x-link-button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="flex-1 grid place-items-center order-first lg:order-last">
        <img src="{{ Vite::asset('resources/images/add.svg') }}" alt="Gambar tidak dapat dimuatkan" class="block w-2/3 aspect-square">
      </div>
    </div>
  </x-dashboard-layout>
@endsection