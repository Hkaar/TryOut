<div class="flex flex-col w-full">
  <div class="flex items-center gap-3 mb-3">
    <a href="{{ url()->previous() }}" class="btn bg-primary text-white duration-150 hover:scale-105 active:scale-95 ease-in-out hover:opacity-95 active:opacity-50">
      <i class="material-symbols-outlined font-var-light">arrow_back</i>
      Balik
    </a>

    <h1 class="text-xl">Tentang {{ ucfirst($title) }}</h1>
  </div>

  <div class="flex gap-3 items-center justify-between mb-3">
    <div class="items-center gap-2 hidden lg:flex">
      <div class="flex items-center gap-2 shadow rounded">
        <span class="fw-medium bg-secondary p-3 text-white rounded-l">
          Dibuat pada
        </span>

        <span class="p-3">
          {{ $item->created_at }}
        </span>
      </div>

      <div class="flex items-center gap-2 shadow rounded">
        <span class="fw-medium bg-secondary text-white p-3 rounded-l">
          Terakhir diperbarui
        </span>

        <span class="p-3">
          {{ $item->updated_at }}
        </span>
      </div>
    </div>

    <div class="flex items-center gap-2">
      <a href="{{ isset($routes['edit']) ? route($routes['edit'], $item->id) : '#' }}" class="btn bg-caution text-white duration-150 hover:scale-105 active:scale-95 ease-in-out hover:opacity-95 active:opacity-50">
        <span class="flex gap-1 items-center">
          <i class="material-symbols-outlined font-var-light">edit</i>
          Edit <span class="hidden md:block lg:hidden xl:block">{{ strtolower($title) }}</span>
        </span>
      </a>

      <a href="{{ isset($routes['create']) ? route($routes['create'], $item->id) : '#' }}" class="btn bg-success text-white duration-150 hover:scale-105 active:scale-95 ease-in-out hover:opacity-95 active:opacity-50">
        <span class="flex gap-1 items-center">
          <i class="material-symbols-outlined font-var-light">add</i>
          Tambahkan <span class="hidden md:block lg:hidden xl:block">{{ strtolower($title) }}</span>
        </span>
      </a>
    </div>
  </div>
</div>

{{ $slot }}