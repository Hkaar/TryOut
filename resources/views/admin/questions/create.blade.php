@extends('layouts.app')

@section('title', 'Daftar Soal - Dashboard')

@section('meta')
  <meta name="plugins" content="question-editor | image-preview">
@endsection

@section('content')
  <x-dashboard-layout active="daftar soal">
    <div class="flex flex-col flex-1 gap-3">
      <div class="flex gap-4 items-center">
        <i class="material-symbols-outlined font-var-light font-4xl">library_books</i>

        <span class="flex flex-col gap-1">
          <h3 class="text-xl font-semibold">Tambahkan soal baru</h3>
          <p class="text-gray-400">
            Tambahkan soal baru di sistem anda
          </p>
        </span>
      </div>

      <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-5">
        <x-elevated-card class="flex flex-col flex-1 max-h-[38rem]">
          <form action="{{ route('admin.packets.store') }}" method="post" id="questionForm" class="flex-1 flex flex-col">
            @csrf

            <div class="space-y-3 mb-5 flex-1">
              <div class="w-full">
                <label for="img" class="sr-only">Pilih foto soal</label>
                <input type="file" name="img" id="img" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                  file:bg-gray-50 file:border-0
                  file:me-4
                  file:py-3 file:px-4
                  dark:file:bg-neutral-700 dark:file:text-neutral-400"
                  preview-target="#previewFoto" preview-classes="max-w-64 object-cover">
              </div>

              <div class="max-w-full">
                <label for="content" class="block text-sm font-medium mb-2 dark:text-white">Pertanyaan Soal</label>
                <textarea id="content" name="content" rows="3" cols="10" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="3" placeholder="Masukkan pertanyaan ..." required></textarea>

                @error('content')
                  <p>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <div class="w-full">
                <label for="question_type_id" class="block text-sm font-medium mb-2 dark:text-white">
                  Jenis Soal
                </label>

                <select class="py-3 px-4 pe-9 w-full block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                  name="question_type_id" required>
                  <option selected disabled>{{ \App\Models\QuestionType::count() <= 0 ? 'Tidak ada jenis soal' : 'Pilih salah satu ...' }}</option>
                  @foreach (\App\Models\QuestionType::all(['name', 'id']) as $type)
                    <option value="{{ $type->id }}">{{ $type->name === "essay" ? 'Essay' : 'Pilihan Ganda' }}</option>
                  @endforeach
                </select>

                @error('question_type_id')
                  <p>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <div class="w-full">
                <label for="packet_id" class="block text-sm font-medium mb-2 dark:text-white">
                  Paket Soal
                </label>

                <select class="py-3 px-4 pe-9 w-full block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                  name="packet_id" required>
                  <option selected disabled>{{ \App\Models\Packet::count() <= 0 ? 'Tidak ada paket soal' : 'Pilih salah satu ...' }}</option>
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
              <div class="flex gap-2 items-center">
                <x-button type="submit" class="bg-primary text-white hover:rounded-none">
                  <i class="material-symbols-outlined font-var-light">save</i>
                  Simpan
                </x-button>

                <x-button type="reset" class="border-danger hover:bg-danger hover:text-white hover:rounded-none">
                  <i class="material-symbols-outlined font-var-light">delete</i>
                  Hapus draft
                </x-button>
              </div>

              <x-link-button to="{{ route('admin.packets.index') }}" class="border-danger hover:bg-danger hover:text-white hover:rounded-none ps-4">
                Keluar
                <i class="material-symbols-outlined font-var-light">arrow_right_alt</i>
              </x-link-button>
            </div>
          </form>
        </x-elevated-card>

        <x-elevated-card class="flex flex-col flex-1 w-full max-h-[38rem] gap-4">
          <button type="button" id="addChoice" class="btn bg-secondary text-white flex items-center gap-2 duration-150 ease-in-out hover:opacity-95 active:opacity-50 active:scale-95 disabled:hover:scale-100 disabled:active:scale-100 disabled:opacity-40" disabled>
            <i class="material-symbols-outlined font-var-light">add</i>
            Tambahkan pilihan jawaban
          </button>

          <div id="choices" class="flex flex-col gap-2 max-h-full overflow-y-auto"></div>
        </x-elevated-card>

        <x-elevated-card class="grid place-items-center gap-2 flex-1 w-full max-h-[38rem]" id="previewFoto">
          <div class="flex items-center justify-center flex-col gap-5">
            <img src="{{ Vite::asset('resources/images/upload.svg') }}" alt="Gambar tidak dapat dimuatkan" class="size-1/2">
            <span class="md:text-lg lg:text-xl font-semibold px-3 py-2 bg-accent rounded-md">Gambar akan muncul disini!</span>
          </div>
        </x-elevated-card>

        <x-elevated-card class="flex flex-col flex-1 gap-3 w-full max-h-[38rem]">
          <h6 class="font-semibold text-lg">Daftar Pertanyaan</h6>

          <div class="flex flex-col gap-2 max-h-52 overflow-y-auto" id="questionList"></div>
        </x-elevated-card>
      </div>
    </div>
  </x-dashboard-layout>
@endsection