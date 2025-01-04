@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
  <main class="min-h-screen space-y-9 bg-cover"
    style="background-image: url({{ Vite::asset('resources/images/background.png') }})">
    <x-navigation-bar active="home" class="shadow-[0_10px_100px_0_rgba(158,179,132,.75)]" />

    <div class="container min-h-screen space-y-9 md:w-[98%] xl:w-10/12">
      <x-card class="rounded-[20px] border-none bg-secondary text-white shadow-[0_0_100px_0_rgba(158,179,132,.5)]">
        <article class="space-y-3">
          <span class="flex items-center gap-2">
            <h1 class="text-xl font-bold md:text-2xl">Peraturan</h1>
          </span>

          <ol class="list-decimal space-y-1 ps-8 font-semibold md:text-lg">
            <li>Jika soal belum muncul silahkan refresh saat sudah jam dimulai.</li>
            <li>Untuk nilai ujian di sistem tidak dimunculkan, karena untuk nilai nanti akan dibagikan secara manual.</li>
            <li>
              Soal ujian otomatis menghilang selesai waktu ujian berakhir. Silahkan tunggu soal ujian berikutnya sesuai
              waktu pada jadwal.
            </li>
          </ol>
        </article>
      </x-card>

      <x-card
        class="items-center rounded-[20px] border-none px-6 py-3 shadow-[0_0_100px_0_rgba(158,179,132,.55)] md:px-8">
        <div class="mb-8 text-center">
          <h1 class="text-3xl font-bold text-secondary md:text-5xl">Sub Test</h1>
          <h4 class="text-lg font-medium text-gray-500">Sub Test yang tersedia untuk anda</h4>
        </div>

        @if (count($exams) < 1)
          <div class="flex w-full items-center justify-center">
            <span
              class="inline-flex items-center gap-x-1.5 rounded-lg bg-info px-3 py-1.5 text-sm font-medium text-white">
              <i data-lucide="circle-alert" class="stroke-[1.5]"></i>
              Tidak ada test yang tersedia saat ini
            </span>
          </div>
        @endif

        <div class="mb-8 grid w-full grid-cols-1 gap-x-14 gap-y-10 md:grid-cols-2 xl:grid-cols-3 xl:gap-x-20 xl:gap-y-14">
          @foreach ($exams as $exam)
            <x-card
              class="rounded-[20px] border-none shadow-[0_0_35px_0_rgba(0,0,0,.25)] transition-all duration-200 ease-in-out hover:-translate-y-3">
              <x-slot name="header">
                <div class="rounded-t-[20px] bg-gradient-to-r from-accent to-secondary px-6 py-5 text-white">
                  <h3 class="line-clamp-3 text-xl font-bold">
                    {{ $exam->name }}
                  </h3>
                </div>
              </x-slot>

              <div class="grid h-full grid-cols-2 px-2">
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
                <div class="flex items-center justify-center gap-1 rounded-b-md px-4 pb-5">
                  @if (
                      $exam->checkValid() &&
                          ($exam->checkFinished(auth()->user()->id) == 0 || $exam->checkFinished(auth()->user()->id) == null))
                    <x-link-button to="{{ route('exams.guard', $exam->id) }}"
                      class="w-10/12 border bg-gradient-to-r from-accent to-secondary text-white">
                      <i data-lucide="edit" class="size-6 stroke-[1.5]"></i>

                      Mulai ujian
                    </x-link-button>
                  @elseif ($exam->checkFinished(auth()->user()->id) === 1)
                    <x-link-button to="#"
                      class="w-10/12 bg-opacity-50 bg-gradient-to-r from-accent to-secondary text-white hover:scale-100 hover:cursor-not-allowed active:scale-100 active:opacity-100">
                      <i data-lucide="circle-check" class="size-6 stroke-[1.5]"></i>

                      Terselesaikan
                    </x-link-button>
                  @else
                    <x-link-button to="#"
                      class="w-10/12 border-danger bg-opacity-50 text-danger hover:scale-100 hover:cursor-not-allowed active:scale-100 active:opacity-100">
                      <i data-lucide="circle-alert" class="size-6 stroke-[1.5]"></i>

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

    <x-footer />
  </main>
@endsection
