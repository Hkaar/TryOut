@extends('layouts.app')

@section('title', 'Paket Soal - Dashboard')

@php
  $routes = [
      'edit' => 'admin.packets.edit',
      'create' => 'admin.packets.create',
  ];
@endphp

@section('content')
  <x-dashboard-layout active="paket Soal">
    <x-detail-layout title="Paket Soal" :item="$packet" :routes="$routes">
      <div class="my-4 grid grid-cols-1 gap-3 lg:grid-cols-2">
        <x-card class="shadow-lg">
          <x-slot name="header">
            <div class="flex items-center gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>

              <h3 class="text-lg font-semibold">Info paket soal</h3>
            </div>
          </x-slot>

          <div class="space-y-3">
            <div class="grid grid-cols-3">
              <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Nama paket soal
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {{ ucwords($packet->name) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Kode paket soal
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {{ ucwords($packet->code) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Group peserta
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {{ ucwords($packet->group->name) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Mata Pelajaran
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {{ ucwords($packet->subject->name) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Deskripsi
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {!! nl2br(e(strip_tags($packet->desc))) !!}
              </div>
            </div>
          </div>
        </x-card>

        <x-card class="shadow-lg">
          <x-slot name="header">
            <div class="flex items-center gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>

              <h3 class="text-lg font-semibold">Daftar soal</h3>
            </div>
          </x-slot>

          <div class="max-h-[32rem] space-y-3 overflow-y-auto px-2">
            @foreach ($packet->questions as $i => $question)
              <x-card class="shadow-md">
                <x-slot name="header">
                  <div class="flex items-center justify-between gap-2 rounded-t-lg bg-accent px-4 py-3">
                    <h3 class="text-lg font-semibold">Soal {{ $i + 1 }}</h3>

                    <x-link-button to="{{ route('admin.questions.show', $question->id) }}" class="hover:bg-info hover:text-white">
                      <i class="material-symbols-outlined font-var-light">info</i>
                    </x-link-button>
                  </div>
                </x-slot>

                <div class="space-y-2">
                  @if ($question->img)
                    <img src="{{ Storage::url($question->img) }}" alt="Gambar tidak dapat dimuatkan"
                      class="block w-1/4 rounded-md" />
                  @endif

                  <p class="font-medium text-lg">
                    {{ ucfirst($question->content) }}
                  </p>
                </div>

                <x-slot name="footer">
                  <div class="flex items-center gap-2 rounded-b-lg border-t border-gray-200 px-4 py-3">
                    @if ($question->type->name === 'essay')
                      <i class="material-symbols-outlined font-var-light">view_headline</i>
                      <span class="font-bold">Essay</span>
                    @else
                      <i class="material-symbols-outlined font-var-light">list</i>
                      <span class="font-bold">Pilihan Ganda</span>
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
