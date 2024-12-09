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
          <div class="flex items-center gap-3 rounded-t-lg bg-secondary px-4 py-3 text-white">
            <i data-lucide="calendar-range" class="size-6 stroke-[1.5]"></i>

            <h3 class="text-lg font-semibold">
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
          <div class="flex items-center gap-2 rounded-t-lg bg-secondary px-4 py-3 text-white">
            <i data-lucide="users" class="size-6 stroke-[1.5]"></i>

            <h3 class="text-lg font-semibold">
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

      <x-card class="order-first shadow-md md:col-span-2 lg:order-none lg:col-span-1 xl:col-span-2">
        <x-slot name="header">
          <div class="flex items-center gap-2 rounded-t-lg bg-secondary px-4 py-3 text-white">
            <i data-lucide="user" class="size-6 stroke-[1.5]"></i>

            <h3 class="text-lg font-semibold">
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

          <div class="hidden content-center justify-end sm:grid lg:hidden xl:grid">
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
            <span class="text-[13px] text-gray-600 dark:text-neutral-400">
              Pengerjaan
            </span>
          </div>
          <div class="inline-flex items-center">
            <span class="size-2.5 me-2 inline-block rounded-sm bg-purple-600"></span>
            <span class="text-[13px] text-gray-600 dark:text-neutral-400">
              Penyelesaian
            </span>
          </div>
        </div>

        <div id="examParticipationChart"></div>
      </x-card>

      <x-card class="shadow-md md:col-span-2 lg:col-span-1">
        <x-slot name="header">
          <div class="flex items-center gap-2 rounded-t-lg bg-secondary px-4 py-3 text-white">
            <i data-lucide="chart-no-axes-combined" class="size-6 stroke-[1.5]"></i>

            <h3 class="text-lg font-semibold">
              Status ujian
            </h3>
          </div>
        </x-slot>

        <div class="grid h-full grid-cols-1 gap-5">
          <article class="flex flex-col items-center gap-2 rounded-md bg-gray-50 px-4 py-3 text-center">
            <h6 class="text-6xl font-bold">
              {{ $weekTotalWorks }}
            </h6>

            <span class="text-gray-500">
              Peserta yang mengerjakan ujian minggu ini
            </span>
          </article>

          <article class="flex flex-col items-center gap-2 rounded-md bg-gray-50 px-4 py-3 text-center">
            <h6 class="text-6xl font-bold">
              {{ $weekTotalFinishes }}
            </h6>
            <span class="text-gray-500">
              Peserta yang menyelesaikan ujian minggu ini
            </span>
          </article>
        </div>
      </x-card>

      <x-card class="shadow-md md:col-span-2 lg:col-span-3 xl:col-span-2">
        <x-slot name="header">
          <div class="flex items-center gap-2 rounded-t-lg bg-secondary px-4 py-3 text-white">
            <i data-lucide="info" class="size-6 stroke-[1.5]"></i>

            <h3 class="text-lg font-semibold">
              Pengerjaan terbaru
            </h3>
          </div>
        </x-slot>

        <div
          class="h-[32rem] space-y-3 overflow-y-auto px-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar]:w-2">
          @foreach ($latestWorks as $item)
            <x-card>
              <x-slot name="header">
                <div class="flex items-center gap-2 rounded-t-lg bg-accent px-3 py-2 text-white">
                  <i data-lucide="calendar-range" class="size-6 stroke-[1.5]"></i>

                  <span class="font-semibold">
                    {{ $item->exam->name }}
                  </span>
                </div>
              </x-slot>

              <span class="font-medium">
                Dikerjakan oleh {{ ucfirst($item->user->name ? $item->user->name : $item->user->username) }}
              </span>

              <x-slot name="footer">
                <div class="flex items-center gap-2 rounded-b-lg border-t border-gray-200 px-4 py-3">
                  <span class="text-gray-500">
                    Waktu mulai :
                    {{ Carbon\Carbon::parse($item->start_date)->locale('id')->translatedFormat('l, j F Y H:i:s') }}
                  </span>
                </div>
              </x-slot>
            </x-card>
          @endforeach
        </div>
      </x-card>

      <x-card class="shadow-md md:col-span-2 lg:col-span-3 xl:col-span-2">
        <x-slot name="header">
          <div class="flex items-center gap-2 rounded-t-lg bg-secondary px-4 py-3 text-white">
            <i data-lucide="info" class="size-6 stroke-[1.5]"></i>

            <h3 class="text-lg font-semibold">
              Penyelesaian terbaru
            </h3>
          </div>
        </x-slot>

        <div
          class="h-[32rem] space-y-3 overflow-y-auto px-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar]:w-2">
          @foreach ($latestFinishes as $item)
            <x-card>
              <x-slot name="header">
                <div class="flex items-center gap-2 rounded-t-lg bg-accent px-3 py-2 text-white">
                  <i data-lucide="calendar-range" class="size-6 stroke-[1.5]"></i>

                  <span class="font-semibold">
                    {{ $item->exam->name }}
                  </span>
                </div>
              </x-slot>

              <span class="font-medium">
                Dikerjakan oleh {{ ucfirst($item->user->name ? $item->user->name : $item->user->username) }}
              </span>

              <x-slot name="footer">
                <div class="flex items-center gap-2 rounded-b-lg border-t border-gray-200 px-4 py-3">
                  <span class="text-gray-500">
                    Waktu selesai :
                    {{ $item->finish_date? Carbon\Carbon::parse($item->finish_date)->locale('id')->translatedFormat('l, j F Y H:i:s'): Carbon\Carbon::parse($item->last_date)->locale('id')->translatedFormat('l, j F Y H:i:s') }}
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
