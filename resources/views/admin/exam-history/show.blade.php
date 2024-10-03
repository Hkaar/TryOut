@extends('layouts.app')

@section('title', 'Riwayat Ujian - Dashboard')

@php
$routes = [
];
@endphp

@section('content')
  <x-dashboard-layout active="riwayat ujian">
    <x-detail-layout title="riwayat ujian" :item="$result" :routes="$routes">
      <div class="flex gap-6 my-4">
        <x-elevated-card class="flex-1 space-y-3">
          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Nama Ujian
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($result->exam->name) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Durasi Ujian
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ $result->exam->duration }} menit
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Sisa Durasi
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ $result->duration }} menit
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Tanggal Mulai
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($result->start_date) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Tanggal Berakhir
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ $result->finish_date ? $result->finish_date : '-' }}
            </div>
          </div>
        </x-elevated-card>

        <x-elevated-card class="flex-1 grid place-items-center">
          <div class="space-y-3">
            @foreach ($result->questionResults as $i => $item)
              <div class="flex flex-col px-4 py-2 rounded-md shadow-sm border gap-2">
                <div class="flex items-center justify-between">
                  <h6 class="text-xl">Pertanyaan {{ $i+1 }}</h6>

                  @if ($item->correct == 1 && $item->not_sure == 0)
                    <i class="material-symbols-outlined font-var-light">check</i>
                  @elseif ($item->correct == 0 && $item->not_sure == 0)
                    <i class="material-symbols-outlined font-var-light">cancel</i>
                  @else
                    <i class="material-symbols-outlined font-var-light">circle</i>
                  @endif
                </div>

                <p>
                  {{ $item->question->content }}
                </p>

                <div class="grid grid-cols-3">
                  <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
                    Jawaban
                  </div>
                  <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
                    {{ ucwords($item->answer ? $item->answer : '-') }}
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </x-elevated-card>
      </div>
    </x-detail-layout>
  </x-dashboard-layout>
@endsection