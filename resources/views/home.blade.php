@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
  <x-dashboard-layout active="home" :enableAdmin=false class="gap-6">
    <section id="hero" class="min-h-screen flex-1 rounded-lg shadow mb-6 bg-white bg-opacity-20 backdrop-blur-lg drop-shadow-lg">
      <div class="container grid place-items-center h-full">
        <div class="flex flex-col items-center flex-1 gap-10">
          <h1 class="text-3xl md:text-7xl lg:text-9xl font-bold text-center">
            Selamat datang <span class="text-2xl md:text-6xl lg:text-8xl font-bold text-gray-400 line-clamp-1">{{ ucwords(auth()->user()->name) }}</span>
          </h1>

          <a href="#latest" class="btn bg-info text-white w-fit p-3 flex items-center gap-2 duration-150 ease-in-out hover:text-black hover:border-info hover:bg-transparent hover:scale-110 active:opacity-50 active:scale-95 disabled:hover:scale-100 disabled:active:scale-100 disabled:opacity-40">
            <i class="material-symbols-outlined font-var-light">arrow_downward</i>
            Lihat Ujian
          </a>
        </div>
      </div>
    </section>
  </x-dashboard-layout>
@endsection