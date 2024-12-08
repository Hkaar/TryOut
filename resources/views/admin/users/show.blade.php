@extends('layouts.app')

@section('title', 'Akun - Dashboard')

@php
  $routes = [
      'edit' => 'admin.users.edit',
      'create' => 'admin.users.create',
  ];
@endphp

@section('content')
  <x-dashboard-layout active="akun">
    <x-detail-layout title="akun" :item="$user" :routes="$routes">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 my-4">
        <x-card class="shadow-lg">
          <x-slot name="header">
            <div class="rounded-t-lg bg-accent text-white px-4 py-3 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>

              <h3 class="font-semibold text-lg">Info akun</h3>
            </div>
          </x-slot>

          <div class="space-y-3">
            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Nama
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ ucwords($user->name) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Username
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ ucwords($user->username) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Email
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ ucwords($user->email) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Peran
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ ucwords($user->role->name) }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Telepon
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {{ ucwords($user->phone ? $user->phone : '-') }}
              </div>
            </div>

            <div class="grid grid-cols-3">
              <div class="col-span-1 border rounded-s border-b-gray-300 px-4 py-3 flex bg-gray-100 font-semibold">
                Alamat
              </div>
              <div class="col-span-2 border rounded-e border-b-gray-300 px-4 py-3">
                {!! nl2br(e($user->address ? strip_tags($user->address) : '-')) !!}
              </div>
            </div>
          </div>
        </x-card>

        <x-card class="shadow-lg">
          <x-slot name="header">
            <div class="rounded-t-lg bg-accent text-white px-4 py-3 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>

              <h3 class="font-semibold text-lg">Foto akun</h3>
            </div>
          </x-slot>

          <div class="grid place-items-center h-full">
            @if ($user->img)
              <img src="{{ Storage::url($user->img) }}" alt="Foto tidak dapat dimuatkan"
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
