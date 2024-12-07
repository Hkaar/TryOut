@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
  <section class="min-h-screen bg-cover"
    style="background-image: url({{ Vite::asset('resources/images/background.png') }})">
    <x-navigation-bar active="home" />

    <div class="container-sm space-y-5 py-4">
      <x-card class="bg-secondary text-white shadow-md">
        <article class="space-y-3">
          <span class="flex items-center gap-2">
            <h1 class="text-xl font-bold md:text-2xl">Peraturan</h1>
          </span>

          <ol class="list-decimal space-y-1 ps-8 font-semibold md:text-lg">
            <li>Jika soal belum muncul silahkan refresh saat sudah jam dimulai.</li>
            <li>Untuk nilai ujian di sistem tidak dimunculkan, karena untuk nilai nanti akan dibagikan secara manual</li>
            <li>Soal ujian otomatis menghilang selesai waktu ujian berakhir. Silahkan tunggu soal ujian berikutnya sesuai
              waktu pada jadwal.</li>
          </ol>
        </article>
      </x-card>

      <x-card class="items-center shadow-md">
        <div class="mb-5 text-center">
          <h1 class="text-2xl font-bold text-secondary md:text-3xl">Sub Test</h1>
          <h4 class="text-lg font-medium text-gray-500">Sub Test yang tersedia untuk anda</h4>
        </div>

        <div class="mb-3 grid w-full grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3">
          @foreach ($exams as $exam)
            <x-card
              class="transition-all duration-200 ease-in-out hover:-translate-y-3 hover:shadow-lg hover:shadow-accent">
              <x-slot name="header">
                <div class="rounded-t-md bg-gradient-to-r from-accent to-secondary px-4 py-3 text-white">
                  <h3 class="line-clamp-1 text-xl font-bold">
                    {{ $exam->name }}
                  </h3>
                </div>
              </x-slot>

              <div class="grid h-full grid-cols-2">
                @if ($exam->examResults->isNotEmpty())
                  @php
                    $examResult = $exam->examResults->first();
                  @endphp

                  <span class="flex items-center rounded-tl-md py-1 font-bold">
                    Sisa waktu
                  </span>

                  <span class="flex items-center rounded-tr-md py-1">
                    {{ $examResult->duration > 0 ? $examResult->duration : 0 }} menit
                  </span>
                @else
                  <span class="flex items-center rounded-tl-md py-1 font-bold">
                    Waktu
                  </span>

                  <span class="flex items-center rounded-tr-md py-1">
                    {{ $exam->duration }} menit
                  </span>
                @endif

                <span class="flex items-center py-1 font-bold">
                  Mulai
                </span>

                <span class="flex items-center py-1">
                  {{ Carbon\Carbon::parse($exam->start_date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                </span>

                <span class="flex items-center rounded-bl-md py-1 font-bold">
                  Tenggat
                </span>

                <span class="flex items-center rounded-br-md py-1">
                  {{ Carbon\Carbon::parse($exam->end_date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                </span>
              </div>

              <x-slot name="footer">
                <div class="flex items-center justify-center gap-1 rounded-b-md border-t border-gray-200 px-4 py-3">
                  @if (
                      $exam->checkValid() &&
                          ($exam->checkFinished(auth()->user()->id) == 0 || $exam->checkFinished(auth()->user()->id) == null))
                    <x-link-button to="{{ route('exams.guard', $exam->id) }}"
                      class="w-10/12 border bg-gradient-to-r from-accent to-secondary text-white">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                      </svg>

                      Kerjakan
                    </x-link-button>
                  @elseif ($exam->checkFinished(auth()->user()->id) === 1)
                    <x-link-button to=""
                      class="w-10/12 border-success bg-opacity-50 text-success hover:scale-100 hover:cursor-not-allowed active:scale-100 active:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                      </svg>

                      Terselesaikan
                    </x-link-button>
                  @else
                    <x-link-button to=""
                      class="w-10/12 border-danger bg-opacity-50 text-danger hover:scale-100 hover:cursor-not-allowed active:scale-100 active:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                      </svg>

                      Tidak dapat dikerjakan
                    </x-link-button>
                  @endif
                </div>
              </x-slot>
            </x-card>
          @endforeach
        </div>

        <div class="flex w-full max-w-full items-center justify-center overflow-x-auto py-1">
          <x-paginate-links :links="$exams" />
        </div>
      </x-card>
    </div>
  </section>

  <x-footer />
@endsection
