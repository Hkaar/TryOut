@extends('layouts.app')

@section('title', 'Peserta - Dashboard')

@php
  $routes = [
      'edit' => 'admin.students.edit',
      'create' => 'admin.students.create',
  ];
@endphp

@section('content')
  <x-dashboard-layout active="peserta">
    <x-detail-layout title="peserta" :item="$student" :routes="$routes">
      <div class="my-4 grid grid-cols-1 gap-3 lg:grid-cols-2">
        <x-card class="shadow-lg">
          <x-slot name="header">
            <div class="rounded-t-lg bg-tertiary text-white px-4 py-3 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>
              
              <h3 class="font-semibold text-lg">Info peserta</h3>
            </div>
          </x-slot>

          <div class="space-y-3">
            <div class="grid grid-cols-3">
              <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Nama
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {{ ucwords($student->name) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Username
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {{ ucwords($student->username) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Email
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {{ ucwords($student->email) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Telepon
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {{ ucwords($student->phone ? $student->phone : '-') }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 flex rounded-s border border-b-gray-300 bg-gray-100 px-4 py-3 font-semibold">
                Alamat
              </div>
              <div class="col-span-2 rounded-e border border-b-gray-300 px-4 py-3">
                {!! nl2br(e($student->address ? strip_tags($student->address) : '-')) !!}
              </div>
            </div>
          </div>
        </x-card>

        <x-card class="shadow-lg order-first lg:order-last">
          <x-slot name="header">
            <div class="rounded-t-lg bg-tertiary text-white px-4 py-3 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>
              
              <h3 class="font-semibold text-lg">Foto peserta</h3>
            </div>
          </x-slot>

          <div class="grid place-items-center h-full">
            @if ($student->img)
              <img src="{{ Storage::url($student->img) }}" alt="Foto tidak dapat dimuatkan"
                class="block aspect-square rounded-full w-1/3" />
            @else
              <img src="{{ Vite::asset('resources/images/default-avatar.png') }}" alt="Gambar tidak dapat dimuatkan" class="block aspect-square rounded-full w-1/3" />
            @endif
          </div>
        </x-card>
      </div>
    </x-detail-layout>
  </x-dashboard-layout>
@endsection
