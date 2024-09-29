@extends('layouts.app')

@section('title', 'Ujian - Dashboard')

@section('content')
  <x-dashboard-layout active="daftar ujian">
    <div class="flex-1 flex">
      <div class="flex-1 grid place-items-center">
        <div class="flex flex-col gap-3 w-full">
          <div class="flex gap-4 items-center">
            <i class="material-symbols-outlined font-var-light font-4xl">event_note</i>
            
            <span class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">Tambahkan ujian baru</h3>
              <p class="text-gray-400">
                Tambahkan ujian baru di sistem anda
              </p>
            </span>
          </div>

          <x-elevated-card class="flex flex-col">
            <form action="{{ route('admin.exams.store') }}" method="post">
              @csrf

              <div class="space-y-3 mb-5">
                <div class="w-full">
                  <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nama Ujian</label>
                  <input type="text" id="name" name="name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                    placeholder="Masukkan nama ujian ..." required>
                  
                  @error('name')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="durasi" class="block text-sm font-medium mb-2 dark:text-white">Durasi Ujian</label>
                  <div class="py-2 px-3 bg-white border border-gray-200 rounded-lg dark:bg-neutral-900 dark:border-neutral-700" data-hs-input-number='{ "min": 1 }'>
                    <div class="w-full flex justify-between items-center gap-x-5">
                      <div class="grow">
                        <input class="w-full p-0 bg-transparent border-0 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white" style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field" value="1" data-hs-input-number-input=""
                          name="duration">
                      </div>
                      
                      <div class="flex justify-end items-center gap-x-1.5">
                        <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                          </svg>
                        </button>
                        <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                  <label for="group_id" class="block text-sm font-medium mb-2 dark:text-white">
                    Group
                  </label>

                  <select class="py-3 px-4 pe-9 w-full block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    name="group_id" required>
                    <option selected disabled>{{ \App\Models\Group::count() <= 0 ? 'Tidak ada group' : 'Pilih salah satu ...' }}</option>
                    @foreach (\App\Models\Group::all(['name', 'id']) as $group)
                      <option value="{{ $group->id }}">{{ ucwords($group->name) }}</option>
                    @endforeach
                  </select>

                  @error('group_id')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="packet_id" class="block text-sm font-medium mb-2 dark:text-white">
                    Paket Soal
                  </label>

                  <select class="py-3 px-4 pe-9 w-full block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    name="packet_id" required>
                    <option selected disabled>{{ \App\Models\Packet::count() <= 0 ? 'Tidak ada packet soal' : 'Pilih salah satu ...' }}</option>
                    @foreach (\App\Models\Packet::all(['name', 'id']) as $packet)
                      <option value="{{ $packet->id }}">{{ ucwords($packet->name) }}</option>
                    @endforeach
                  </select>

                  @error('packet_id')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="start_date" class="block text-sm font-medium mb-2 dark:text-white">Tanggal Mulai Ujian</label>
                  <input type="datetime-local" id="start_date" name="start_date" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                    placeholder="Masukkan tanggal mulai pengerjaan ujian ..." required>
                  
                  @error('start_date')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="end_date" class="block text-sm font-medium mb-2 dark:text-white">Tanggal Berakhir Ujian</label>
                  <input type="datetime-local" id="end_date" name="end_date" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                    placeholder="Masukkan tanggal berakhir pengerjaan ujian ..." required>
                  
                  @error('end_date')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="flex items-center gap-4">
                  <div class="flex">
                    <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="token"
                      name="token">
                    <label for="token" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Gunakan token</label>
                  </div>

                  <div class="flex">
                    <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="show_results"
                      name="show_results">
                    <label for="show_results" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Tunjukkan Hasil</label>
                  </div>
                </div>

                <div class="max-w-full">
                  <label for="desc" class="block text-sm font-medium mb-2 dark:text-white">Deskripsi Ujian</label>
                  <textarea id="desc" name="desc" rows="3" cols="10" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="3" placeholder="Masukkan deskripsi ujian ..."></textarea>
                </div>
              </div>

              <div class="flex items-center gap-1">
                <button type="submit" class="btn bg-primary text-white">
                  Simpan
                </button>

                <a href="{{ route('admin.exams.index') }}" class="btn bg-danger text-white">
                  Batalkan
                </a>
              </div>
            </form>
          </x-elevated-card>
        </div>
      </div>

      <div class="flex-1 grid place-items-center">
        <img src="{{ Vite::asset('resources/images/add.svg') }}" alt="Gambar tidak dapat dimuatkan" class="block w-2/3 aspect-square">
      </div>
    </div>
  </x-dashboard-layout>
@endsection