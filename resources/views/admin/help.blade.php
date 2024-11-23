@extends('layouts.app')

@section('title', 'Help & Info')

@section('meta')
  <meta name="plugins" content="">
@endsection

@section('content')
  <x-dashboard-layout active="help">
    <div class="grid grid-cols-1 gap-3">
      <x-card class="shadow-lg w-1/3">
        <x-slot name="header">
          <div class="flex items-center gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>

            <h3 class="text-lg font-semibold">Tentang sistem</h3>
          </div>
        </x-slot>

        <div class="space-y-3">
          <div class="flex items-center gap-3">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Gambar tidak dapat dimuatkan"
              class="size-20 rounded-full">

            <div class="flex flex-col gap-1">
              <span class="text-xl font-bold uppercase">{{ $settings['org_name'] }} System</span>
              <span class="text-sm text-gray-500">Version {{ config('app.version') }}</span>
            </div>
          </div>
        </div>
      </x-card>
    </div>
  </x-dashboard-layout>
@endsection
