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
      <div class="flex gap-6 my-4">
        <x-elevated-card class="flex-1 space-y-3">
          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Nama
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($student->name) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Username
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($student->username) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Email
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($student->email) }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Telepon
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {{ ucwords($student->phone ? $student->phone : '-') }}
            </div>
          </div>

          <div class="grid grid-cols-3">
            <div class="col-span-1 border rounded-s border-b-gray-300 p-2 flex bg-gray-100 font-semibold">
              Alamat
            </div>
            <div class="col-span-2 border rounded-e border-b-gray-300 p-2">
              {!! nl2br(e($student->address ? strip_tags($student->address) : '-')) !!}
            </div>
          </div>
        </x-elevated-card>

        <x-elevated-card class="flex-1 grid place-items-center">
          @if ($student->img)
            <img src="{{ Storage::url($student->img) }}" alt="Foto tidak dapat dimuatkan" class="block w-2/3 aspect-square">
          @else
            <span>Tidak tersedia foto</span>
          @endif
        </x-elevated-card>
      </div>
    </x-detail-layout>
  </x-dashboard-layout>
@endsection