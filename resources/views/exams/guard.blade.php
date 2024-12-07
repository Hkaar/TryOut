@extends('layouts.app')

@section('title', 'Confirmation')

@section('meta')
  <meta name="plugins" content="tabs">
@endsection

@section('content')
  <div class="flex min-h-screen bg-cover"
    style="background-image: url({{ Vite::asset('resources/images/background.png') }})">
    <div class="container grid flex-1 place-items-center">
      <form action="{{ route('exams.check', $exam->id) }}" method="POST"
        class="relative flex flex-col items-center rounded-3xl border border-gray-200 bg-white px-6 pb-9 pt-12 text-center shadow-lg md:w-1/2 lg:w-1/3">
        @csrf

        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Gambar tidak dapat dimuatkan"
          class="size-20 absolute -top-10 left-1/2 -translate-x-1/2 rounded-full">

        @if ($exam->token)
          <div data-panel-group="guard-panel" id="intro-panel" class="flex w-full flex-col items-center gap-5">
            <div class="mt-1 flex flex-col items-center gap-2 text-center">
              <h3 class="text-3xl font-black uppercase tracking-wide text-primary sm:text-4xl">
                {{ $settings['org_name'] }}
              </h3>

              <span class="font-medium text-gray-500">Apakah anda yakin untuk mengerjakan ujian ini?</span>
            </div>

            <div class="flex w-10/12 flex-col items-center gap-5">
              <div class="flex w-full flex-col gap-2 text-start text-primary">
                <div class="flex flex-col">
                  <span class="">Nama ujian</span>
                  <span class="text-3xl font-semibold">{{ $exam->name }}</span>
                </div>

                @if ($result)
                  <div class="flex flex-col">
                    <span class="">Sisa waktu</span>
                    <span class="text-3xl font-semibold">{{ $result->duration }} menit</span>
                  </div>
                @else
                  <div class="flex flex-col">
                    <span class="">Durasi ujian</span>
                    <span class="text-3xl font-semibold">{{ $exam->duration }} menit</span>
                  </div>
                @endif
              </div>

              <div class="flex w-full items-center gap-2">
                <x-link-button to="{{ route('home') }}"
                  class="flex-1 bg-danger text-white hover:rounded-none hover:border-danger hover:bg-transparent hover:text-danger">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
                  Batalkan
                </x-link-button>

                <x-button type="button" data-tab="guard-panel" data-tab-target="#token-panel"
                  class="flex-1 bg-success text-white hover:rounded-none hover:border-success hover:bg-transparent hover:text-success">
                  Berikutnya
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                  </svg>
                </x-button>
              </div>
            </div>
          </div>

          <div data-panel-group="guard-panel" id="token-panel" class="flex w-full flex-col items-center gap-5">
            <div class="mt-1 flex flex-col items-center gap-2 text-center">
              <h3 class="text-3xl font-black uppercase tracking-wide text-primary sm:text-4xl">
                {{ $settings['org_name'] }}
              </h3>

              <span class="font-medium text-gray-500">Masukkan token ujian!</span>
            </div>

            <div class="flex w-10/12 flex-col items-center gap-5">
              <div class="w-full space-y-3">
                <div class="relative">
                  <input type="text"
                    class="peer block w-full rounded-lg border border-gray-400 px-4 py-3 ps-11 text-sm shadow-sm focus:border-accent focus:shadow focus:shadow-primary focus:ring-accent disabled:pointer-events-none disabled:opacity-50 dark:border-transparent dark:bg-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan token..." name="token">

                  <div
                    class="pointer-events-none absolute inset-y-0 start-0 flex items-center stroke-gray-500 ps-4 peer-disabled:pointer-events-none peer-disabled:opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      class="size-4 stroke-inherit">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                    </svg>
                  </div>
                </div>
              </div>

              <div class="flex w-full items-center gap-2">
                <x-button type="button" data-tab="guard-panel" data-tab-target="#intro-panel"
                  class="active flex-1 bg-danger text-white hover:rounded-none hover:border-danger hover:bg-transparent hover:text-danger">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                  </svg>
                  Sebelumnya
                </x-button>

                <x-button type="submit"
                  class="flex-1 bg-success text-white hover:rounded-none hover:border-success hover:bg-transparent hover:text-success">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                  </svg>
                  Kerjakan
                </x-button>
              </div>
            </div>
          </div>
        @else
          <div class="flex w-full flex-col items-center gap-5">
            <div class="mt-1 flex flex-col items-center gap-2 text-center">
              <h3 class="text-3xl font-black uppercase tracking-wide text-primary sm:text-4xl">
                {{ $settings['org_name'] }}
              </h3>

              <span class="font-medium text-gray-500">Apakah anda yakin untuk mengerjakan ujian ini?</span>
            </div>

            <div class="flex w-10/12 flex-col items-center gap-5">
              <div class="flex w-full flex-col gap-2 text-start text-primary">
                <div class="flex flex-col">
                  <span class="">Nama ujian</span>
                  <span class="text-3xl font-semibold">{{ $exam->name }}</span>
                </div>

                @if ($result)
                  <div class="flex flex-col">
                    <span class="">Sisa waktu</span>
                    <span class="text-3xl font-semibold">{{ $result->duration }} menit</span>
                  </div>
                @else
                  <div class="flex flex-col">
                    <span class="">Durasi ujian</span>
                    <span class="text-3xl font-semibold">{{ $exam->duration }} menit</span>
                  </div>
                @endif
              </div>

              <div class="flex w-full items-center gap-2">
                <x-link-button to="{{ route('home') }}"
                  class="flex-1 bg-danger text-white hover:rounded-none hover:border-danger hover:bg-transparent hover:text-danger">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>

                  Batalkan
                </x-link-button>

                <x-button type="submit"
                  class="flex-1 bg-success text-white hover:rounded-none hover:border-success hover:bg-transparent hover:text-success">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                  </svg>

                  Kerjakan
                </x-button>
              </div>
            </div>
          </div>
        @endif
      </form>
    </div>
  </div>
@endsection
