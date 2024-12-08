@extends('layouts.app')

@section('title', 'Paket Soal - Dashboard')

@section('content')
  <x-dashboard-layout active="paket soal">
    <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-y-5">
      <div class="flex-1 grid place-items-center">
        <div class="flex flex-col gap-3 w-full">
          <div class="flex gap-4 items-center">
            <i data-lucide="package" class="size-8 stroke-[1.5]"></i>

            <span class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">Mengedit paket soal</h3>
              <p class="text-gray-400">
                Perbarui paket soal di sistem anda
              </p>
            </span>
          </div>

          <x-elevated-card class="flex flex-col">
            <form action="{{ route('admin.packets.update', $packet->id) }}" method="post">
              @csrf
              @method('PUT')

              <div class="space-y-3 mb-5">
                <div class="w-full">
                  <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nama Paket Soal</label>
                  <input type="text" id="name" name="name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan nama paket soal ..." value="{{ $packet->name }}">

                  @error('name')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="code" class="block text-sm font-medium mb-2 dark:text-white">Kode Paket Soal</label>
                  <input type="text" id="code" name="code" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan kode paket soal ..." value="{{ $packet->code }}">

                  @error('code')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="group_id" class="block text-sm font-medium mb-2 dark:text-white">
                    Group Paket Soal
                  </label>

                  <select class="py-3 px-4 pe-9 w-full block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    name="group_id">
                    <option selected disabled>{{ \App\Models\Group::count() <= 0 ? 'Tidak ada group' : 'Pilih salah satu ...' }}</option>
                    @foreach (\App\Models\Group::all(['name', 'id']) as $group)
                      <option value="{{ $group->id }}" {{ $group->id === $packet->group_id ? 'selected' : '' }}>{{ ucwords($group->name) }}</option>
                    @endforeach
                  </select>

                  @error('group_id')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="subject_id" class="block text-sm font-medium mb-2 dark:text-white">
                    Mata Pelajaran Paket Soal
                  </label>

                  <select class="py-3 px-4 pe-9 w-full block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    name="subject_id">
                    <option selected disabled>{{ \App\Models\Subject::count() <= 0 ? 'Tidak ada mata pelajaran' : 'Pilih salah satu ...' }}</option>
                    @foreach (\App\Models\Subject::all(['name', 'id']) as $subject)
                      <option value="{{ $subject->id }}" {{ $subject->id === $packet->subject_id ? 'selected' : '' }}>{{ ucwords($subject->name) }}</option>
                    @endforeach
                  </select>

                  @error('subject_id')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="max-w-full">
                  <label for="desc" class="block text-sm font-medium mb-2 dark:text-white">Deskripsi Paket Soal</label>
                  <textarea id="desc" name="desc" rows="3" cols="10" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="3" placeholder="Masukkan deskripsi paket soal ...">{{ $packet->desc }}</textarea>
                </div>
              </div>

              <div class="flex items-center gap-2">
                <x-button type="submit" class="bg-primary text-white hover:rounded-none hover:shadow-lg">
                  <i data-lucide="save" class="size-5 stroke-[1.5]"></i>

                  Simpan
                </x-button>

                <x-link-button to="{{ route('admin.packets.index') }}"
                  class="border-danger hover:rounded-none hover:bg-danger hover:text-white hover:shadow-lg">
                  <i data-lucide="circle-x" class="size-5 stroke-[1.5]"></i>
                  
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