@extends('layouts.app')

@section('title', 'Riwayat Ujian - Dashboard')

@section('content')
  <x-dashboard-layout active="riwayat ujian">
    <x-detail-layout title="riwayat ujian" :item="$result">
      <div class="my-4 grid grid-cols-1 gap-3 lg:grid-cols-2">
        <x-card class="shadow-lg">
          <x-slot name="header">
            <div class="flex items-center gap-2 rounded-t-lg bg-accent px-4 py-3 text-white">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>

              <h3 class="text-lg font-semibold">Info riwayat ujian</h3>
            </div>
          </x-slot>

          <div class="space-y-5">
            <div class="space-y-2">
              <div class="grid grid-cols-3">
                <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                  Nama peserta
                </div>
                <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                  {{ $result->user->name ? ucwords($result->user->name) : ucwords($result->user->username) }}
                </div>
              </div>

              <div class="grid grid-cols-3">
                <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                  Group peserta
                </div>
                <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                  {{ ucwords($result->exam->group->name) }}
                </div>
              </div>
            </div>

            <div class="space-y-2">
              <div class="grid grid-cols-3">
                <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                  Nama Ujian
                </div>
                <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                  {{ ucwords($result->exam->name) }}
                </div>
              </div>

              <div class="grid grid-cols-3">
                <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                  Durasi Ujian
                </div>
                <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                  {{ $result->exam->duration }} menit
                </div>
              </div>

              <div class="grid grid-cols-3">
                <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                  Tanggal tenggat
                </div>
                <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                  {{ Carbon\Carbon::parse($result->exam->last_date)->locale('id')->translatedFormat('l, j F Y T') }}
                </div>
              </div>
            </div>

            <div class="space-y-2">
              <div class="grid grid-cols-3">
                <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                  Sisa Durasi
                </div>
                <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                  {{ $result->duration }} menit
                </div>
              </div>

              <div class="grid grid-cols-3">
                <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                  Mulai dikerjakan
                </div>
                <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                  {{ Carbon\Carbon::parse($result->start_date)->locale('id')->translatedFormat('l, j F Y H:i:s T') }}
                </div>
              </div>

              <div class="grid grid-cols-3">
                <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                  Terakhir dikerjakan
                </div>
                <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                  {{ Carbon\Carbon::parse($result->last_date)->locale('id')->translatedFormat('l, j F Y H:i:s T') }}
                </div>
              </div>

              <div class="grid grid-cols-3">
                <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                  Tanggal submit
                </div>
                <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                  {{ $result->finish_date? Carbon\Carbon::parse($result->finish_date)->locale('id')->translatedFormat('l, j F Y H:i:s T'): '-' }}
                </div>
              </div>
            </div>
          </div>
        </x-card>

        <x-card class="shadow-lg">
          <x-slot name="header">
            <div class="flex items-center gap-2 rounded-t-lg bg-accent px-4 py-3 text-white">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>

              <h3 class="text-lg font-semibold">Data soal</h3>
            </div>
          </x-slot>

          <div class="h-[33rem] space-y-2 overflow-y-auto px-2">
            @foreach ($result->questionResults as $i => $item)
              <x-card class="shadow-md">
                <x-slot name="header">
                  <div class="flex items-center gap-2 rounded-t-lg bg-accent px-4 py-3">
                    <h3 class="text-lg font-semibold">Soal {{ $i + 1 }}</h3>
                  </div>
                </x-slot>
                <div class="space-y-3">
                  <p class="text-lg font-medium">
                    {{ $item->question->content }}
                  </p>

                  <div class="grid grid-cols-3">
                    <div class="col-span-1 flex items-center rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                      Jawaban
                    </div>
                    <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                      @if (str_starts_with($item->answer, 'uploads/'))
                        <img src="{{ Storage::url($item->answer) }}" alt="Gambar tidak dapat dimuatkan"
                          class="block w-1/4 rounded-md" />
                      @elseif (str_starts_with($item->answer, '/storage/uploads'))
                        <img src="{{ $item->answer }}" alt="Gambar tidak dapat dimuatkan"
                          class="block w-1/4 rounded-md" />
                      @else
                        {{ ucwords($item->answer ? $item->answer : '-') }}
                      @endif
                    </div>
                  </div>
                </div>

                <x-slot name="footer">
                  <div class="flex items-center gap-2 rounded-b-lg border-t border-gray-200 px-4 py-3">
                    @if ($item->correct == 1)
                      <i class="material-symbols-outlined font-var-light">check</i>
                      <span class="font-bold">Benar</span>
                    @elseif ($item->correct == 0 && $item->not_sure == 0 && $item->answer && $item->answer != '')
                      <i class="material-symbols-outlined font-var-light">cancel</i>
                      <span class="font-bold">Salah</span>
                    @elseif ($item->not_sure == 1)
                      <i class="material-symbols-outlined font-var-light">circle</i>
                      <span class="font-bold">Ragu</span>
                    @else
                      <i class="material-symbols-outlined font-var-light">circle</i>
                      <span class="font-bold">Belum dijawab</span>
                    @endif
                  </div>
                </x-slot>
              </x-card>
            @endforeach
          </div>
        </x-card>
      </div>
    </x-detail-layout>
  </x-dashboard-layout>
@endsection
