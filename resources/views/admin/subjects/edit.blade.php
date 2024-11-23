@extends('layouts.app')

@section('title', 'Mata Pelajaran - Dashboard')

@section('content')
  <x-dashboard-layout active="mapel">
    <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-y-5">
      <div class="flex-1 grid place-items-center">
        <div class="flex flex-col gap-3 w-full">
          <div class="flex gap-4 items-center">
            <i class="material-symbols-outlined font-var-light font-4xl">note_stack</i>

            <span class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">Mengedit mata pelajaran</h3>
              <p class="text-gray-400">
                Perbarui mata pelajaran di sistem anda
              </p>
            </span>
          </div>

          <x-elevated-card class="flex flex-col">
            <form action="{{ route('admin.subjects.update', $subject->id) }}" method="post">
              @csrf
              @method('PUT')

              <div class="space-y-3 mb-5">
                <div class="w-full">
                  <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nama Mata Pelajaran</label>
                  <input type="text" id="name" name="name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan nama mata pelajaran ..." value="{{ $subject->name }}">

                  @error('name')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>
              </div>

              <div class="flex items-center gap-2">
                <x-button type="submit" class="bg-primary text-white hover:rounded-none hover:shadow-lg">
                  <i class="material-symbols-outlined font-var-light">save</i>

                  Simpan
                </x-button>

                <x-link-button to="{{ route('admin.subjects.index') }}"
                  class="border-danger hover:rounded-none hover:bg-danger hover:text-white hover:shadow-lg">
                  <i class="material-symbols-outlined font-var-light">cancel</i>
                  Batalkan
                </x-link-button>
              </div>
            </form>
          </x-elevated-card>
        </div>
      </div>

      <div class="flex-1 grid place-items-center order-first lg:order-last">
        <img src="{{ Vite::asset('resources/images/add.svg') }}" alt="Gambar tidak dapat dimuatkan" class="block w-2/3 aspect-square">
      </div>
    </div>
  </x-dashboard-layout>
@endsection