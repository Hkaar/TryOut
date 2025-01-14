@extends('layouts.app')

@section('title', 'Akun - Dashboard')

@section('meta')
  <meta name="plugins" content="image-preview">
@endsection

@section('content')
  <x-dashboard-layout active="akun">
    <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-y-5">
      <div class="flex-1 grid place-items-center">
        <div class="flex flex-col gap-3 w-full">
          <div class="flex gap-4 items-center">
            <i data-lucide="users" class="size-8 stroke-[1.5]"></i>

            <span class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">Tambahkan akun baru</h3>
              <p class="text-gray-400">
                Tambahkan akun baru di sistem anda
              </p>
            </span>
          </div>

          <x-elevated-card class="flex flex-col">
            <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="space-y-3 mb-5">
                <div class="w-full">
                  <label for="img" class="sr-only">Pilih foto profil</label>
                  <input type="file" name="img" id="img" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                    file:bg-gray-50 file:border-0
                    file:me-4
                    file:py-3 file:px-4
                    dark:file:bg-neutral-700 dark:file:text-neutral-400"
                    preview-target="#previewFoto">
                </div>

                <div class="w-full">
                  <label for="username" class="block text-sm font-medium mb-2 dark:text-white">Username</label>
                  <input type="text" id="username" name="username" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan nama akun ..." required>

                  @error('username')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nama</label>
                  <input type="text" id="name" name="name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan nama akun ..." required>

                  @error('name')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="email" class="block text-sm font-medium mb-2 dark:text-white">Email</label>
                  <input type="email" id="email" name="email" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan email akun ..." required>

                  @error('email')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="phone" class="block text-sm font-medium mb-2 dark:text-white">Telepon</label>
                  <input type="text" id="phone" name="phone" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan nama akun ..." required>

                  @error('phone')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="max-w-full">
                  <label for="address" class="block text-sm font-medium mb-2 dark:text-white">Alamat</label>
                  <textarea id="address" name="address" rows="3" cols="10" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="3" placeholder="Masukkan alamat ..." required></textarea>
                </div>

                <div class="w-full">
                  <label for="role_id" class="block text-sm font-medium mb-2 dark:text-white">
                    Peran
                  </label>

                  <select class="py-3 px-4 pe-9 w-full block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    name="role_id" required>
                    <option selected disabled>{{ \App\Models\Role::count() <= 0 ? 'Tidak ada peran' : 'Pilih salah satu ...' }}</option>
                    @foreach (\App\Models\Role::all(['name', 'id']) as $role)
                      <option value="{{ $role->id }}">{{ ucwords($role->name) }}</option>
                    @endforeach
                  </select>

                  @error('role_id')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="password" class="block text-sm font-medium mb-2 dark:text-white">Password</label>
                  <input type="password" id="password" name="password" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan password akun ..." required>

                  @error('password')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="password_confirmation" class="block text-sm font-medium mb-2 dark:text-white">Konfirmasi password</label>
                  <input type="password" id="password_confirmation" name="password_confirmation" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan password lagi ..." required>

                  @error('password_confirmation')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>
              </div>

              <div class="flex items-center gap-2">
                <x-button type="submit" class="bg-primary text-white hover:rounded-none hover:shadow-lg">
                  <i data-lucide="save" class="size-5 stroke-[1.5]"></i>

                  Simpan
                </x-button>

                <x-link-button to="{{ route('admin.users.index') }}" class="border-danger hover:bg-danger hover:text-white hover:rounded-none hover:shadow-lg">
                  <i data-lucide="circle-x" class="size-5 stroke-[1.5]"></i>

                  Batalkan
                </x-link-button>
              </div>
            </form>
          </x-elevated-card>
        </div>
      </div>

      <div class="flex-1 grid place-items-center order-first lg:order-last">
        <div id="previewFoto" class="font-semibold grid place-items-center">
          <div class="flex items-center justify-center flex-col gap-5">
            <img src="{{ Vite::asset('resources/images/upload.svg') }}" alt="Gambar tidak dapat dimuatkan" class="size-1/2">
            <span class="md:text-lg lg:text-xl font-semibold px-3 py-2 bg-accent rounded-md">Gambar akan muncul disini!</span>
          </div>
        </div>
      </div>
    </div>
  </x-dashboard-layout>
@endsection