@extends('layouts.app')

@section('title', 'Pengaturan - Dashboard')

@section('meta')
  <meta name="plugins" content="image-preview">
@endsection

@section('content')
  <x-dashboard-layout active="pengaturan">
    <div class="flex-1 flex">
      <div class="flex-1 grid place-items-center">
        <div class="flex flex-col gap-3 w-full">
          <div class="flex gap-4 items-center">
            <i class="material-symbols-outlined font-var-light font-4xl">settings</i>

            <span class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">Pengaturan Aplikasi</h3>
              <p class="text-gray-400">
                Atur pengaturan yang ada di sistem anda
              </p>
            </span>
          </div>

          <div class="flex flex-col h-fit border rounded p-4">
            <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="space-y-3 mb-5">
                <div class="w-full">
                  <label for="org_img" class="sr-only">Pilih foto profil</label>
                  <input type="file" name="org_img" id="org_img" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                    file:bg-gray-50 file:border-0
                    file:me-4
                    file:py-3 file:px-4
                    dark:file:bg-neutral-700 dark:file:text-neutral-400"
                    preview-target="#previewFoto">
                </div>

                <div class="w-full">
                  <label for="org_name" class="block text-sm font-medium mb-2 dark:text-white">Nama Organisasi</label>
                  <input type="text" id="org_name" name="org_name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Masukkan nama organisasi ..."
                    value="{{ $settings['org_name'] }}">

                  @error('org_name')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="org_slug" class="block text-sm font-medium mb-2 dark:text-white">Slug Organisasi</label>
                  <input type="text" id="org_slug" name="org_slug" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Masukkan slug organisasi ..."
                    value="{{ $settings['org_slug'] }}">

                  @error('org_slug')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="org_slogan" class="block text-sm font-medium mb-2 dark:text-white">Slogan Organisasi</label>
                  <input type="text" id="org_slogan" name="org_slogan" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Masukkan slogan organisasi ..."
                    value="{{ $settings['org_slogan'] }}">

                  @error('org_slogan')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="max-w-full">
                  <label for="org_desc" class="block text-sm font-medium mb-2 dark:text-white">Deskripsi Organisasi</label>
                  <textarea id="org_desc" name="org_desc" rows="3" cols="10" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="3" placeholder="Masukkan deskripsi organisasi ...">{{ $settings['org_desc'] }}</textarea>

                  @error('org_desc')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>
              </div>

              <div class="flex items-center gap-1">
                <x-button type="submit" class="bg-primary text-white hover:rounded-none hover:shadow-lg">
                  <i class="material-symbols-outlined font-var-light">save</i>

                  Simpan
                </x-button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="flex-1 flex">
        <div id="previewFoto" class="grid place-items-center flex-1">
          @if (isset($settings['org_img']))
            <img src="{{ Storage::url($settings['org_img']) }}" alt="Gambar tidak dapat dimuatkan" class="block w-2/3 aspect-square">
          @else
            <img src="{{ Vite::asset('resources/images/monitor.svg') }}" alt="Gambar tidak dapat dimuatkan" class="block w-2/3 aspect-square">
          @endif
        </div>
      </div>
    </div>
  </x-dashboard-layout>
@endsection