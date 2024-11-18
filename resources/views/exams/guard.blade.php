@extends('layouts.app')

@section('title', 'Confirmation')

@section('content')
  <div class="min-h-screen flex bg-cover" style="background-image: url({{ Vite::asset('resources/images/background.png') }})">
    <div class="flex-1 container grid place-items-center">
      <form action="{{ route('exams.check', $exam->id) }}" method="POST" class="relative flex flex-col items-center gap-6 rounded-3xl border border-gray-200 bg-white px-6 pb-9 pt-12 text-center shadow-lg md:w-1/2 lg:w-1/3">
        @csrf

        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Gambar tidak dapat dimuatkan"
        class="size-20 absolute -top-10 left-1/2 -translate-x-1/2 rounded-full">

        <div class="mt-1 flex flex-col items-center gap-2 text-center">
          <h3 class="text-3xl font-black uppercase tracking-wide text-primary sm:text-4xl">
            {{ $settings['org_name'] }}
          </h3>

          <span class="font-medium text-gray-500">Apakah anda yakin untuk mengerjakan ujian ini?</span>
        </div>

        <div class="flex flex-col gap-5 items-center w-10/12">
          @if ($exam->token)
            <div class="w-full space-y-3">
              <div class="relative">
                <input type="text" class="peer py-3 px-4 ps-11 block w-full border border-gray-400 rounded-lg text-sm shadow-sm focus:shadow focus:ring-accent focus:border-accent focus:shadow-primary disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                  placeholder="Masukkan token..." name="token">

                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none stroke-gray-500">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-4 stroke-inherit">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                  </svg>
                </div>
              </div>
            </div>
          @endif

          <div class="flex items-center gap-2 w-full">
            <x-link-button to="{{ route('home') }}" class="flex-1 bg-danger text-white hover:border-danger hover:bg-transparent hover:text-danger">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>

              Keluar
            </x-link-button>

            <x-button type="submit" class="flex-1 bg-success text-white hover:border-success hover:bg-transparent hover:text-success">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
              </svg>

              Masuk
            </x-button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection