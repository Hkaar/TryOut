@extends('layouts.app')

@section('title', 'Login')

@section('content')
  <div class="min-h-screen bg-cover" style="background-image: url({{ Vite::asset('resources/images/background.png') }})">
    <div class="grid min-h-screen place-items-center bg-white bg-opacity-20 drop-shadow-sm backdrop-blur-sm">
      <div class="container">
        <div class="flex h-full flex-col items-center gap-6">
          <form action="{{ route('login.post') }}" method="post"
            class="relative flex flex-col items-center gap-6 rounded-3xl border border-gray-200 bg-white px-6 pb-9 pt-12 text-center shadow-lg md:w-1/2 lg:w-1/3">
            @csrf

            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Gambar tidak dapat dimuatkan"
              class="absolute -top-10 left-1/2 size-20 -translate-x-1/2 rounded-full">

            <div class="mt-1 flex flex-col items-center gap-1 text-center">
              <h3 class="text-3xl font-black uppercase tracking-wide text-primary sm:text-4xl">
                Try Out
              </h3>

              <span class="font-medium text-gray-500">Masukkan detail akun!</span>
            </div>

            <div class="flex w-full flex-1 flex-col gap-3">
              <div class="relative flex-1">
                <input type="text" name="username"
                  class="form-control peer border-gray-200 ps-11 shadow-sm focus:border-none focus:bg-white focus:text-black focus:shadow-dp-sm focus:shadow-accent focus:ring-0"
                  placeholder="Username" autocomplete="username" value="{{ old('username') }}">

                <div class="form-control-icon stroke-gray-400 peer-disabled:pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    class="size-4 stroke-inherit">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                  </svg>
                </div>
              </div>

              @error('username')
                <p class="flex items-center gap-x-1.5 text-start text-sm text-danger" id="hs-input-helper-text">
                  <i data-lucide="circle-alert" class="size-4 stroke-[1.5]"></i> {{ $message }}
                </p>
              @enderror

              <div class="w-full">
                <div class="relative">
                  <input id="password" type="password"
                    class="form-control peer block w-full rounded-lg border-gray-200 px-4 py-3 ps-11 text-sm shadow-sm focus:border-none focus:bg-white focus:text-black focus:shadow-dp-sm focus:shadow-accent focus:ring-0 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    autocomplete="current-password" placeholder="Password" name="password" required>

                  <button type="button"
                    data-hs-toggle-password='{
                      "target": "#password"
                    }'
                    class="absolute end-0 top-0 rounded-e-md p-3.5">
                    <svg class="size-3.5 flex-shrink-0 text-gray-400 dark:text-neutral-600" width="24" height="24"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round">
                      <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                      <path class="hs-password-active:hidden"
                        d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                      <path class="hs-password-active:hidden"
                        d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                      <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22">
                      </line>
                      <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z">
                      </path>
                      <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                    </svg>
                  </button>

                  <div class="form-control-icon stroke-gray-400 peer-disabled:pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      class="size-4 stroke-inherit">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                    </svg>
                  </div>
                </div>
              </div>

              @error('password')
                <p class="flex items-center gap-x-1.5 text-sm text-danger" id="hs-input-helper-text">
                  <i data-lucide="circle-alert" class="size-4 stroke-[1.5]"></i> {{ $message }}
                </p>
              @enderror
            </div>

            <button type="submit"
              class="btn flex w-32 flex-1 justify-center bg-accent text-white duration-100 ease-in-out hover:scale-105 hover:bg-accent active:scale-95 active:opacity-75 disabled:pointer-events-none disabled:opacity-50">
              Masuk
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
