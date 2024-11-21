@extends('layouts.app')

@section('title', 'Daftar Soal - Dashboard')

@php
  $routes = [
      'edit' => 'admin.questions.edit',
      'create' => 'admin.questions.create',
  ];
@endphp

@section('content')
  <x-dashboard-layout active="daftar soal">
    <x-detail-layout title="soal" :item="$question" :routes="$routes">
      <div class="my-4 grid grid-cols-1 gap-3 lg:grid-cols-2">
        <x-card class="shadow-lg">
          <x-slot name="header">
            <div class="flex items-center gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>

              <h3 class="text-lg font-semibold">Info soal</h3>
            </div>
          </x-slot>

          <div class="space-y-3">
            @if ($question->img)
              <div class="grid place-items-center">
                <img src="{{ Storage::url($question->img) }}" alt="Gambar tidak dapat dimuatkan"
                  class="w-3/4 rounded-md border border-gray-200 object-cover shadow" />
              </div>
            @endif

            <div class="grid grid-cols-3">
              <div
                class="col-span-1 flex items-center rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Paket Soal
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {{ ucwords($question->packet->name) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div
                class="col-span-1 flex items-center rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Jenis soal
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {{ ucwords(str_replace('_', ' ', $question->type->name)) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div
                class="col-span-1 flex items-center rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Isi soal
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {!! nl2br(e(strip_tags($question->content))) !!}
              </div>
            </div>

            @if ($question->type->name === 'essay')
              <div class="grid grid-cols-3">
                <div
                  class="col-span-1 flex items-center rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                  Jawaban
                </div>
                <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                  {!! nl2br(e(strip_tags($question->rightAnswer->content))) !!}
                </div>
              </div>
            @endif
          </div>
        </x-card>

        <x-card class="shadow-lg">
          <x-slot name="header">
            <div class="flex items-center gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>

              <h3 class="text-lg font-semibold">Pilihan</h3>
            </div>
          </x-slot>

          @if ($question->type->name === 'essay')
            <div class="grid h-full place-items-center">
              <div class="flex flex-col items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>

                <span class="text-2xl font-semibold">
                  Tidak tersedia untuk soal essay
                </span>
              </div>
            </div>
          @else
            <div class="max-h-[32rem] space-y-3 overflow-y-auto px-2">
              @foreach ($question->choices as $i => $choice)
                <x-card class="shadow-md">
                  <x-slot name="header">
                    <div class="flex items-center gap-2 rounded-t-lg bg-accent px-4 py-3">
                      <h3 class="text-lg font-semibold">Pilihan {{ $i + 1 }}</h3>
                    </div>
                  </x-slot>

                  <div class="space-y-3">
                    @if (str_starts_with($choice->content, 'uploads/'))
                      <img src="{{ Storage::url($choice->content) }}" alt="Gambar tidak dapat dimuatkan"
                        class="block w-1/4 rounded-md" />
                    @elseif (str_starts_with($choice->content, '/storage/uploads'))
                      <img src="{{ $choice->content }}" alt="Gambar tidak dapat dimuatkan"
                        class="block w-1/4 rounded-md" />
                    @else
                      <p class="text-lg font-medium">
                        {{ $choice->content }}
                      </p>
                    @endif
                  </div>

                  <x-slot name="footer">
                    <div class="flex items-center gap-2 rounded-b-lg border-t border-gray-200 px-4 py-3">
                      @if ($choice->correct == 1)
                        <i class="material-symbols-outlined font-var-light text-success">check</i>
                        <span class="font-bold text-success">Benar</span>
                      @else
                        <i class="material-symbols-outlined font-var-light text-danger">cancel</i>
                        <span class="font-bold text-danger">Salah</span>
                      @endif
                    </div>
                  </x-slot>
                </x-card>
              @endforeach
            </div>
          @endif
        </x-card>
      </div>
    </x-detail-layout>
  </x-dashboard-layout>
@endsection
