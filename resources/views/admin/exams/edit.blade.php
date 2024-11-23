@extends('layouts.app')

@section('title', 'Ujian - Dashboard')

@section('content')
  <x-dashboard-layout active="daftar ujian">
    <div class="flex-1 grid grid-cols-1 lg:grid-cols-2">
      <div class="grid flex-1 place-items-center">
        <div class="flex w-full flex-col gap-3">
          <div class="flex items-center gap-4">
            <i class="material-symbols-outlined font-var-light font-4xl">event_note</i>

            <span class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">Mengedit ujian</h3>
              <p class="text-gray-400">
                Perbarui ujian di sistem anda
              </p>
            </span>
          </div>

          <x-elevated-card class="flex flex-col">
            <form action="{{ route('admin.exams.update', $exam->id) }}" method="post">
              @csrf
              @method('PUT')

              <input type="hidden" name="timezone" value="UTC">

              <div class="mb-5 space-y-3">
                <div class="w-full">
                  <label for="name" class="dark:text-white mb-2 block text-sm font-medium">Nama Ujian</label>
                  <input type="text" id="name" name="name"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    placeholder="Masukkan nama ujian ..." value="{{ $exam->name }}">

                  @error('name')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="durasi" class="dark:text-white mb-2 block text-sm font-medium">Durasi Ujian</label>
                  <div
                    class="dark:bg-neutral-900 dark:border-neutral-700 rounded-lg border border-gray-200 bg-white px-3 py-2"
                    data-hs-input-number='{ "min": 1 }'>
                    <div class="flex w-full items-center justify-between gap-x-5">
                      <div class="grow">
                        <input
                          class="dark:text-white w-full border-0 bg-transparent p-0 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                          style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field"
                          value="{{ $exam->duration }}" data-hs-input-number-input="" name="duration">
                      </div>

                      <div class="flex items-center justify-end gap-x-1.5">
                        <button type="button"
                          class="size-6 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 inline-flex items-center justify-center gap-x-2 rounded-full border border-gray-200 bg-white text-sm font-medium text-gray-800 shadow-sm hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                          tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                          <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                          </svg>
                        </button>
                        <button type="button"
                          class="size-6 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 inline-flex items-center justify-center gap-x-2 rounded-full border border-gray-200 bg-white text-sm font-medium text-gray-800 shadow-sm hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                          tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                          <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>

                  @error('duration')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="group_id" class="dark:text-white mb-2 block text-sm font-medium">
                    Group
                  </label>

                  <select
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    name="group_id">
                    <option selected disabled>
                      {{ \App\Models\Group::count() <= 0 ? 'Tidak ada group' : 'Pilih salah satu ...' }}</option>
                    @foreach (\App\Models\Group::all(['name', 'id']) as $group)
                      <option value="{{ $group->id }}" {{ $group->id === $exam->group_id ? 'selected' : '' }}>
                        {{ ucwords($group->name) }}</option>
                    @endforeach
                  </select>

                  @error('group_id')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="packet_id" class="dark:text-white mb-2 block text-sm font-medium">
                    Paket Soal
                  </label>

                  <select
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    name="packet_id">
                    <option selected disabled>
                      {{ \App\Models\Packet::count() <= 0 ? 'Tidak ada packet soal' : 'Pilih salah satu ...' }}</option>
                    @foreach (\App\Models\Packet::all(['name', 'id']) as $packet)
                      <option value="{{ $packet->id }}" {{ $group->id === $exam->group_id ? 'selected' : '' }}>
                        {{ ucwords($packet->name) }}</option>
                    @endforeach
                  </select>

                  @error('packet_id')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="start_date" class="dark:text-white mb-2 block text-sm font-medium">Tanggal Mulai
                    Ujian</label>
                  <input type="datetime-local" id="start_date" name="start_date"
                    value="{{ isset($exam->start_date) ? \Carbon\Carbon::parse($exam->start_date)->format('Y-m-d\TH:i') : '' }}"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    placeholder="Masukkan tanggal mulai pengerjaan ujian ..." timezone-change>

                  @error('start_date')
                    <p>{{ $message }}</p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="end_date" class="dark:text-white mb-2 block text-sm font-medium">Tanggal Berakhir
                    Ujian</label>
                  <input type="datetime-local" id="end_date" name="end_date"
                    value="{{ isset($exam->end_date) ? \Carbon\Carbon::parse($exam->end_date)->format('Y-m-d\TH:i') : '' }}"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    placeholder="Masukkan tanggal berakhir pengerjaan ujian ..." timezone-change>

                  @error('end_date')
                    <p>{{ $message }}</p>
                  @enderror
                </div>


                <div class="flex items-center gap-4">
                  <div class="flex">
                    <input type="checkbox"
                      class="dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 mt-0.5 shrink-0 rounded border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                      id="token" name="token" {{ $exam->token ? 'checked' : '' }}>
                    <label for="token" class="dark:text-neutral-400 ms-3 text-sm text-gray-500">Gunakan token</label>
                  </div>

                  <div class="flex">
                    <input type="checkbox"
                      class="dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 mt-0.5 shrink-0 rounded border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                      id="public_results" name="public_results" {{ $exam->public_results ? 'checked' : '' }}>
                    <label for="public_results" class="dark:text-neutral-400 ms-3 text-sm text-gray-500">Tunjukkan
                      Hasil</label>
                  </div>

                  <div class="flex">
                    <input type="checkbox"
                      class="dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 mt-0.5 shrink-0 rounded border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                      id="auto_grade" name="auto_grade" {{ $exam->auto_grade ? 'checked' : '' }}>
                    <label for="auto_grade" class="dark:text-neutral-400 ms-3 text-sm text-gray-500">Otomatis
                      Nilai</label>
                  </div>
                </div>

                <div class="max-w-full">
                  <label for="desc" class="dark:text-white mb-2 block text-sm font-medium">Deskripsi Ujian</label>
                  <textarea id="desc" name="desc" rows="3" cols="10"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    rows="3" placeholder="Masukkan deskripsi ujian ...">{{ $exam->desc }}</textarea>
                </div>
              </div>

              <div class="flex items-center gap-2">
                <x-button type="submit" class="bg-primary text-white hover:rounded-none hover:shadow-lg">
                  <i class="material-symbols-outlined font-var-light">save</i>

                  Simpan
                </x-button>

                <x-link-button to="{{ route('admin.exams.index') }}"
                  class="border-danger hover:rounded-none hover:bg-danger hover:text-white hover:shadow-lg">
                  <i class="material-symbols-outlined font-var-light">cancel</i>
                  Batalkan
                </x-link-button>
              </div>
            </form>
          </x-elevated-card>
        </div>
      </div>

      <div class="grid flex-1 place-items-center order-first lg:order-last">
        <img src="{{ Vite::asset('resources/images/add.svg') }}" alt="Gambar tidak dapat dimuatkan"
          class="block aspect-square w-2/3">
      </div>
    </div>
  </x-dashboard-layout>
@endsection
