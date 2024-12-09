@extends('layouts.app')

@section('title', 'Akun - Dashboard')

@section('meta')
  <meta name="plugins" content="image-preview">
@endsection

@section('content')
  <x-dashboard-layout active="akun">
    <div class="grid flex-1 grid-cols-1 gap-y-5 lg:grid-cols-2">
      <div class="grid flex-1 place-items-center">
        <div class="flex w-full flex-col gap-3">
          <div class="flex items-center gap-4">
            <i data-lucide="users" class="size-8 stroke-[1.5]"></i>

            <span class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">Mengedit akun</h3>
              <p class="text-gray-400">
                Perbarui akun di sistem anda
              </p>
            </span>
          </div>

          <x-elevated-card class="flex flex-col">
            <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="mb-5 space-y-3">
                <div class="w-full">
                  <label for="img" class="sr-only">Pilih foto profil</label>
                  <input type="file" name="img" id="img"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:file:bg-neutral-700 dark:file:text-neutral-400 block w-full rounded-lg border border-gray-200 text-sm shadow-sm file:me-4 file:border-0 file:bg-gray-50 file:px-4 file:py-3 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    preview-target="#previewFoto">
                </div>

                <div class="w-full">
                  <label for="username" class="dark:text-white mb-2 block text-sm font-medium">Username</label>
                  <input type="text" id="username" name="username"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    placeholder="Masukkan username akun ..." value="{{ $user->username }}">

                  @error('username')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="name" class="dark:text-white mb-2 block text-sm font-medium">Nama</label>
                  <input type="text" id="name" name="name"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    value="{{ $user->name }}" placeholder="Masukkan nama pengguna ...">

                  @error('name')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="email" class="dark:text-white mb-2 block text-sm font-medium">Email</label>
                  <input type="email" id="email" name="email"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    placeholder="Masukkan email akun ..." value="{{ $user->email }}">

                  @error('email')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="phone" class="dark:text-white mb-2 block text-sm font-medium">Telepon</label>
                  <input type="text" id="phone" name="phone"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    placeholder="Masukkan nomer hp ..." value="{{ $user->phone ? $user->phone : '' }}">

                  @error('phone')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="max-w-full">
                  <label for="address" class="dark:text-white mb-2 block text-sm font-medium">Alamat</label>
                  <textarea id="address" name="address" rows="3" cols="10"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    rows="3" placeholder="Masukkan alamat ...">{{ $user->address ? $user->address : '' }}</textarea>
                </div>

                <div class="w-full">
                  <label for="role_id" class="dark:text-white mb-2 block text-sm font-medium">
                    Peran
                  </label>

                  <select
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    name="role_id">
                    <option selected disabled>
                      {{ \App\Models\Role::count() <= 0 ? 'Tidak ada peran' : 'Pilih salah satu ...' }}</option>
                    @foreach (\App\Models\Role::all(['name', 'id']) as $role)
                      <option value="{{ $role->id }}" {{ $role->id === $user->role_id ? 'selected' : '' }}>
                        {{ ucwords($role->name) }}</option>
                    @endforeach
                  </select>

                  @error('role_id')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="password" class="dark:text-white mb-2 block text-sm font-medium">Password</label>
                  <input type="password" id="password" name="password"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    placeholder="Masukkan password akun ...">

                  @error('password')
                    <p>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <div class="w-full">
                  <label for="password_confirmation" class="dark:text-white mb-2 block text-sm font-medium">Konfirmasi
                    password</label>
                  <input type="password" id="password_confirmation" name="password_confirmation"
                    class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                    placeholder="Masukkan password ...">

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

                <x-link-button to="{{ route('admin.users.index') }}"
                  class="border-danger hover:rounded-none hover:bg-danger hover:text-white hover:shadow-lg">
                  <i data-lucide="circle-x" class="size-5 stroke-[1.5]"></i>

                  Batalkan
                </x-link-button>
              </div>
            </form>
          </x-elevated-card>
        </div>
      </div>

      <div class="grid flex-1 place-items-center order-first lg:order-last">
        <div id="previewFoto" class="grid place-items-center font-semibold">
          @if ($user->img)
            <img src="{{ Storage::url($user->img) }}" alt="Foto tidak dapat dimuatkan"
              class="block aspect-square w-2/3 rounded-full">
          @else
            <div class="flex flex-col items-center justify-center gap-5">
              <img src="{{ Vite::asset('resources/images/upload.svg') }}" alt="Gambar tidak dapat dimuatkan"
                class="size-1/2">
              <span class="rounded-md bg-accent px-3 py-2 font-semibold md:text-lg lg:text-xl">Gambar akan muncul
                disini!</span>
            </div>
          @endif
        </div>
      </div>
    </div>
  </x-dashboard-layout>
@endsection
