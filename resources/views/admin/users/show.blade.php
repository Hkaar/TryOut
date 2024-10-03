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
      <div class="flex gap-6 my-4">
        <x-elevated-card class="flex-1 space-y-3">
          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Nama
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($user->name) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Username
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($user->username) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Email
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($user->email) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Peran
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($user->role->name) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Telepon
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($user->phone ? $user->phone : '-') }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Alamat
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {!! nl2br(e($user->address ? strip_tags($user->address) : '-')) !!}
            </div>
          </div>
        </x-elevated-card>

        <x-elevated-card class="flex-1 grid place-items-center">
          @if ($user->img)
            <img src="{{ Storage::url($user->img) }}" alt="Foto tidak dapat dimuatkan" class="block w-2/3 aspect-square">
          @else
            <span>Tidak tersedia foto</span>
          @endif
        </x-elevated-card>
      </div>
    </x-detail-layout>
  </x-dashboard-layout>
@endsection
