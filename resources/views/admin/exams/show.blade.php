@extends('layouts.app')

@section('title', 'Ujian - Dashboard')

@php
$routes = [
  'edit' => 'admin.exams.edit',
  'create' => 'admin.exams.create',
];
@endphp

@section('content')
  <x-dashboard-layout active="daftar ujian">
    <x-detail-layout title="ujian" :item="$exam" :routes="$routes">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 my-4">
        <x-card class="shadow-lg">
          <x-slot name="header">
            <div class="rounded-t-lg bg-accent text-white px-4 py-3 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>

              <h3 class="font-semibold text-lg">Info ujian</h3>
            </div>
          </x-slot>

          <div class="space-y-3">
            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Nama
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ ucwords($exam->name) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Durasi
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ $exam->duration }} menit
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Tanggal Mulai
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ Carbon\Carbon::parse($exam->start_date)->locale('id')->translatedFormat('l, j F Y H:i:s') }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Tanggal Tenggat
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ Carbon\Carbon::parse($exam->end_date)->locale('id')->translatedFormat('l, j F Y H:i:s') }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Deskripsi
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {!! nl2br(e($exam->desc ? strip_tags($exam->desc) : '-')) !!}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Paket Soal
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ ucwords($exam->packet->name) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Group
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ ucwords($exam->group->name) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Token
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ ucwords($exam->token ? $exam->token : '-') }}
              </div>
            </div>
          </div>
        </x-card>

        <x-card class="shadow-lg">
          <div class="grid place-items-center h-full">
            <img src="{{ Vite::asset('resources/images/add.svg') }}" alt="Gambar tidak dapat dimuatkan" class="block w-2/3 aspect-square">
          </div>
        </x-card>
      </div>
    </x-detail-layout>
  </x-dashboard-layout>
@endsection