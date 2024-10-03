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
      <div class="flex gap-6 my-4">
        <x-elevated-card class="flex-1 space-y-3">
          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Nama
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($exam->name) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Durasi
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ $exam->duration }} menit
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Tanggal Mulai
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($exam->start_date) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Tanggal Tenggat
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ $exam->end_date }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Deskripsi
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {!! nl2br(e($exam->desc ? strip_tags($exam->desc) : '-')) !!}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Paket Soal
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($exam->packet->name) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Group
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($exam->group->name) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Token
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($exam->token ? $exam->token : '-') }}
            </div>
          </div>
        </x-elevated-card>

        <x-elevated-card class="flex-1 grid place-items-center">
          <img src="{{ Vite::asset('resources/images/add.svg') }}" alt="Gambar tidak dapat dimuatkan" class="block w-2/3 aspect-square">
        </x-elevated-card>
      </div>
    </x-detail-layout>
  </x-dashboard-layout>
@endsection