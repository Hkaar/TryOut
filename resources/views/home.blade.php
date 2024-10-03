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

    <section id="latest" class="px-4 py-6 flex-1">
      <div class="container">
        <div class="flex flex-col gap-1 mb-4">
          <h3 class="text-3xl md:text-5xl font-bold">
            Ujian Terbaru
          </h3>
  
          <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <span class="text-tertiary">
              Ujian try out terbaru
            </span>
  
            <div class="md:flex items-center gap-1 hidden">
              <button type="button" class="btn bg-gray-300" id="latestPrev">
                <i class="material-symbols-outlined font-var-light">chevron_left</i>
                Sebelumnya
              </button>
  
              <button type="button" class="btn bg-gray-300" id="latestNext">
                Selanjutnya
                <i class="material-symbols-outlined font-var-light">chevron_right</i>
              </button>
            </div>
          </div>
        </div>
  
        <div class="swiper" id="latestSlider">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 1</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 2</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 3</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 4</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 5</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 6</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 7</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 9</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 10</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
          </div>

          <div class="swiper-pagination" id="latestSliderPagination"></div>
        </div>
      </div>
    </section>

    <section id="active" class="px-4 py-6 flex-1">
      <div class="container">
        <div class="flex flex-col gap-1 mb-4">
          <h3 class="text-3xl md:text-5xl font-bold">
            Kerjakan Lagi!
          </h3>
  
          <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <span class="text-tertiary">
              Ujian yang sebelumnya belum selesai
            </span>
  
            <div class="md:flex items-center gap-1 hidden">
              <button type="button" class="btn bg-gray-300" id="activePrev">
                <i class="material-symbols-outlined font-var-light">chevron_left</i>
                Sebelumnya
              </button>
  
              <button type="button" class="btn bg-gray-300" id="activeNext">
                Selanjutnya
                <i class="material-symbols-outlined font-var-light">chevron_right</i>
              </button>
            </div>
          </div>
        </div>
  
        <div class="swiper" id="activeSlider">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 1</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 2</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 3</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 4</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 5</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 6</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 7</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 9</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
            <div class="swiper-slide">
              <a class="flex flex-col gap-2 items-center justify-center size-72 aspect-square shadow-md border-2 border-tertiary rounded hover:bg-gray-100 active:opacity-30 active:bg-gray-300 active:scale-95 duration-150 ease-linear">
                <h6 class="text-2xl font-semibold">Ujian 10</h6>
                <span class="text-gray-400">Bahasa Indonesia</span>
              </a>
            </div>
          </div>

          <div class="swiper-pagination" id="activeSliderPagination"></div>
        </div>
      </div>
    </section>
  </x-dashboard-layout>
@endsection