@extends('layouts.app')

@section('title', 'Beranda - Dashboard')

@section('meta')
  <meta name="plugins" content="admin-charts-home">
@endsection

@section('content')
  <x-dashboard-layout active="home">
    <main class="grid w-full grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
      <x-card class="shadow-md">
        <x-slot name="header">
          <div class="flex items-center gap-3 rounded-t-lg bg-tertiary px-4 py-3 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>

            <h3 class="text-xl font-semibold">
              Jumlah ujian
            </h3>
          </div>
        </x-slot>

        <div class="grid place-items-center">
          <h4 class="text-5xl font-bold">
            {{ App\Models\Exam::count() }}
          </h4>
        </div>
      </x-card>

      <x-card class="shadow-md">
        <x-slot name="header">
          <div class="flex items-center gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>

            <h3 class="text-xl font-semibold">
              Jumlah peserta
            </h3>
          </div>
        </x-slot>

        <div class="grid place-items-center">
          <h4 class="text-5xl font-bold">
            {{ App\Models\User::StrictByRole('student')->count() }}
          </h4>
        </div>
      </x-card>

      <x-card class="shadow-md md:col-span-2 order-first lg:col-span-1 lg:order-none xl:col-span-2">
        <x-slot name="header">
          <div class="flex items-center gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>

            <h3 class="text-xl font-semibold">
              Informasi akun
            </h3>
          </div>
        </x-slot>

        <div class="grid grid-cols-2">
          <div class="flex items-center gap-3">
            @if (auth()->check() && auth()->user()->img)
              <img src="{{ Storage::url(auth()->user()->img) }}" alt="Gambar tidak dapat dimuatkan"
                class="size-12 aspect-square rounded-full object-cover">
            @else
              <img src="{{ Vite::asset('resources/images/default-avatar.png') }}" alt="Gambar tidak dapat dimuatkan"
                class="size-12 rounded-full">
            @endif

            <div class="flex flex-col gap-1">
              <span class="text-xl font-semibold">
                {{ isset(auth()->user()->name) ? auth()->user()->name : auth()->user()->username }}
              </span>

              <span class="text-gray-500">
                {{ auth()->user()->email }}
              </span>
            </div>
          </div>

          <div class="content-center justify-end hidden sm:grid lg:hidden xl:grid">
            <span class="rounded-md bg-primary px-3 py-2 text-sm font-bold text-white">
              {{ ucfirst(auth()->user()->role->name) }}
            </span>
          </div>
        </div>
      </x-card>

      <x-card class="shadow-md md:col-span-2 lg:col-span-2 xl:col-span-3">
        <div class="mb-3 flex items-center justify-center gap-x-4 sm:mb-6 sm:justify-end">
          <div class="inline-flex items-center">
            <span class="size-2.5 me-2 inline-block rounded-sm bg-blue-600"></span>
            <span class="dark:text-neutral-400 text-[13px] text-gray-600">
              Pengerjaan
            </span>
          </div>
          <div class="inline-flex items-center">
            <span class="size-2.5 me-2 inline-block rounded-sm bg-purple-600"></span>
            <span class="dark:text-neutral-400 text-[13px] text-gray-600">
              Penyelesaian
            </span>
          </div>
        </div>

        <div id="examParticipationChart"></div>
      </x-card>

      <x-card class="shadow-md md:col-span-2 lg:col-span-1">
        <x-slot name="header">
          <div class="flex items-center gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>

            <h3 class="text-xl font-semibold">
              Status ujian
            </h3>
          </div>
        </x-slot>

        <div class="grid grid-cols-1 gap-5 h-full">
          <article class="flex flex-col items-center gap-2 text-center bg-gray-50 px-4 py-3 rounded-md">
            <h6 class="text-6xl font-bold">
              {{ App\Models\ExamResult::whereDate('start_date', '>=', now()->startOfWeek())->whereDate('start_date', '<=', now()->endOfWeek())->count() }}
            </h6>

            <span class="text-gray-500">
              Peserta yang mengerjakan ujian minggu ini
            </span>
          </article>

          <article class="flex flex-col items-center gap-2 text-center bg-gray-50 px-4 py-3 rounded-md">
            <h6 class="text-6xl font-bold">
              {{ App\Models\ExamResult::whereDate('start_date', '>=', now()->startOfWeek())->whereDate('start_date', '<=', now()->endOfWeek())->where('finished', '=', 1)->count() }}
            </h6>
            <span class="text-gray-500">
              Peserta yang menyelesaikan ujian minggu ini
            </span>
          </article>
        </div>
      </x-card>

      <x-card class="shadow-md md:col-span-2 lg:col-span-3 xl:col-span-2">
        <x-slot name="header">
          <div class="flex items-center gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>

            <h3 class="text-xl font-semibold">
              Pengerjaan terbaru
            </h3>
          </div>
        </x-slot>

        <div class="space-y-3 h-[32rem] overflow-y-auto px-2">
          @foreach (App\Models\ExamResult::limit(10)->latest()->get() as $item)
            <x-card>
              <x-slot name="header">
                <div class="flex items-center gap-2 rounded-t-lg bg-accent px-3 py-2 text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                  </svg>

                  <h3 class="text-xl font-semibold">
                    {{ $item->exam->name }}
                  </h3>
                </div>
              </x-slot>

              <span class="font-medium">
                Dikerjakan oleh {{ ucfirst($item->user->name ? $item->user->name : $item->user->username) }}
              </span>

              <x-slot name="footer">
                <div class="flex items-center gap-2 rounded-b-lg border-t border-gray-200 px-4 py-3">
                  <span class="text-gray-500">
                    Waktu mulai : {{ Carbon\Carbon::parse($item->start_date)->locale('id')->translatedFormat('l, j F Y H:i:s') }}
                  </span>
                </div>
              </x-slot>
            </x-card>
          @endforeach
        </div>
      </x-card>

      <x-card class="shadow-md md:col-span-2 lg:col-span-3 xl:col-span-2">
        <x-slot name="header">
          <div class="flex items-center gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>

            <h3 class="text-xl font-semibold">
              Penyelesaian terbaru
            </h3>
          </div>
        </x-slot>

        <div class="space-y-3 h-[32rem] overflow-y-auto px-2">
          @foreach (App\Models\ExamResult::where('finished', '=', 1)->limit(10)->latest()->get() as $item)
            <x-card>
              <x-slot name="header">
                <div class="flex items-center gap-2 rounded-t-lg bg-accent px-3 py-2 text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                  </svg>

                  <h3 class="text-xl font-semibold">
                    {{ $item->exam->name }}
                  </h3>
                </div>
              </x-slot>

              <span class="font-medium">
                Dikerjakan oleh {{ ucfirst($item->user->name ? $item->user->name : $item->user->username) }}
              </span>

              <x-slot name="footer">
                <div class="flex items-center gap-2 rounded-b-lg border-t border-gray-200 px-4 py-3">
                  <span class="text-gray-500">
                    Waktu selesai : {{ $item->finish_date ? Carbon\Carbon::parse($item->finish_date)->locale('id')->translatedFormat('l, j F Y H:i:s') : Carbon\Carbon::parse($item->last_date)->locale('id')->translatedFormat('l, j F Y H:i:s') }}
                  </span>
                </div>
              </x-slot>
            </x-card>
          @endforeach
        </div>
      </x-card>
    </main>
  </x-dashboard-layout>
@endsection
