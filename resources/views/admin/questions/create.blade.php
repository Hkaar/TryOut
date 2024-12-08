@extends('layouts.app')

@section('title', 'Daftar Soal - Dashboard')

@section('meta')
  <meta name="plugins" content="question-editor | image-preview">
@endsection

@section('content')
  <x-dashboard-layout active="daftar soal">
    <div class="flex flex-1 flex-col gap-3">
      <div class="flex items-center gap-4">
        <i data-lucide="layout-list" class="size-8 stroke-[1.5]"></i>

        <span class="flex flex-col gap-1">
          <h3 class="text-xl font-semibold">Tambahkan soal baru</h3>
          <p class="text-gray-400">
            Tambahkan soal baru di sistem anda
          </p>
        </span>
      </div>

      <div class="grid flex-1 grid-cols-1 gap-5 lg:grid-cols-2">
        <x-elevated-card class="flex max-h-[38rem] flex-1 flex-col">
          <form action="{{ route('admin.packets.store') }}" method="post" id="questionForm" class="flex flex-1 flex-col">
            @csrf

            <div class="mb-5 flex-1 space-y-3">
              <div class="w-full">
                <label for="img" class="sr-only">Pilih foto soal</label>
                <input type="file" name="img" id="img"
                  class="block w-full rounded-lg border border-gray-200 text-sm shadow-sm file:me-4 file:border-0 file:bg-gray-50 file:px-4 file:py-3 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:file:bg-neutral-700 dark:file:text-neutral-400"
                  preview-target="#previewFoto" preview-classes="max-w-64 object-cover">
              </div>

              <div class="max-w-full">
                <label for="content" class="mb-2 block text-sm font-medium dark:text-white">Pertanyaan Soal</label>
                <textarea id="content" name="content" rows="3" cols="10"
                  class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                  rows="3" placeholder="Masukkan pertanyaan ..." required></textarea>

                @error('content')
                  <p>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <div class="w-full">
                <label for="question_type_id" class="mb-2 block text-sm font-medium dark:text-white">
                  Jenis Soal
                </label>

                <select
                  class="block w-full rounded-lg border-gray-200 px-4 py-3 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                  name="question_type_id" required>
                  <option selected disabled>
                    {{ \App\Models\QuestionType::count() <= 0 ? 'Tidak ada jenis soal' : 'Pilih salah satu ...' }}
                  </option>
                  @foreach (\App\Models\QuestionType::all(['name', 'id']) as $type)
                    <option value="{{ $type->id }}">{{ $type->name === 'essay' ? 'Essay' : 'Pilihan Ganda' }}</option>
                  @endforeach
                </select>

                @error('question_type_id')
                  <p>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <div class="w-full">
                <label for="packet_id" class="mb-2 block text-sm font-medium dark:text-white">
                  Paket Soal
                </label>

                <select
                  class="block w-full rounded-lg border-gray-200 px-4 py-3 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                  name="packet_id" required>
                  <option selected disabled>
                    {{ \App\Models\Packet::count() <= 0 ? 'Tidak ada paket soal' : 'Pilih salah satu ...' }}</option>
                  @foreach (\App\Models\Packet::all(['name', 'id']) as $packet)
                    <option value="{{ $packet->id }}">{{ ucwords($packet->name) }}</option>
                  @endforeach
                </select>

                @error('packet_id')
                  <p>
                    {{ $message }}
                  </p>
                @enderror
              </div>
            </div>

            <div class="flex items-center justify-between gap-1">
              <div class="flex items-center gap-2">
                <x-button type="submit" class="bg-primary text-white hover:rounded-none">
                  <i data-lucide="save" class="size-5 stroke-[1.5]"></i>

                  Simpan
                </x-button>

                <x-button type="reset" class="border-danger hover:rounded-none hover:bg-danger hover:text-white">
                  <i data-lucide="trash-2" class="size-5 stroke-[1.5]"></i>

                  Hapus draft
                </x-button>
              </div>

              <x-link-button to="{{ route('admin.packets.index') }}"
                class="border-danger ps-4 hover:rounded-none hover:bg-danger hover:text-white">
                Keluar

                <i data-lucide="arrow-right" class="size-5 stroke-[1.5]"></i>
              </x-link-button>
            </div>
          </form>
        </x-elevated-card>

        <x-elevated-card class="flex max-h-[28rem] w-full flex-1 flex-col gap-4">
          <button type="button" id="addChoice"
            class="btn flex items-center gap-2 bg-secondary text-white duration-150 ease-in-out hover:opacity-95 active:scale-95 active:opacity-50 disabled:opacity-40 disabled:hover:scale-100 disabled:active:scale-100"
            disabled>
            <i data-lucide="plus" class="size-5 stroke-[1.5]"></i>
            Tambahkan pilihan jawaban
          </button>

          <div id="choices"
            class="flex px-2 max-h-full flex-col gap-2 overflow-y-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar]:w-2">
          </div>
        </x-elevated-card>

        <x-elevated-card class="grid max-h-[38rem] w-full flex-1 place-items-center gap-2" id="previewFoto">
          <div class="flex flex-col items-center justify-center gap-5">
            <img src="{{ Vite::asset('resources/images/upload.svg') }}" alt="Gambar tidak dapat dimuatkan"
              class="size-1/2">
            <span class="rounded-md bg-accent px-3 py-2 font-semibold md:text-lg lg:text-xl">Gambar akan muncul
              disini!</span>
          </div>
        </x-elevated-card>

        <x-elevated-card class="flex max-h-[24rem] w-full flex-1 flex-col gap-3">
          <h6 class="text-lg font-semibold">Daftar Pertanyaan</h6>

          <div
            class="flex max-h-full flex-col gap-2 overflow-y-auto px-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar]:w-2"
            id="questionList"></div>
        </x-elevated-card>
      </div>
    </div>
  </x-dashboard-layout>
@endsection
