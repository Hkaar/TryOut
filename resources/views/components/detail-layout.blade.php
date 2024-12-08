<div class="flex w-full flex-col">
  <div class="mb-3 flex items-center gap-3">
    <x-link-button to="{{ url()->previous() }}" class="bg-primary text-white hover:rounded-none">
      <i data-lucide="arrow-left" class="size-5 stroke-[1.5]"></i>
      Balik
    </x-link-button>

    <h1 class="text-3xl font-bold">Tentang {{ ucfirst($title) }}</h1>
  </div>

  <div class="flex items-center justify-between gap-3">
    <div class="hidden items-center gap-2 lg:flex">
      <div class="flex items-center gap-2 rounded-md border border-gray-200 shadow">
        <span class="fw-medium rounded-l-md bg-secondary p-3 text-white">
          Dibuat pada
        </span>

        <span class="p-3">
          {{ Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, j F Y') }}
        </span>
      </div>

      <div class="flex items-center gap-2 rounded-md border border-gray-200 shadow">
        <span class="fw-medium rounded-l-md bg-secondary p-3 text-white">
          Terakhir diperbarui
        </span>

        <span class="p-3">
          {{ Carbon\Carbon::parse($item->updated_at)->locale('id')->translatedFormat('l, j F Y') }}
        </span>
      </div>
    </div>

    @if (isset($routes))
      <div class="flex items-center gap-2">
        @if (isset($routes['edit']))
          <x-link-button to="{{ route($routes['edit'], $item->id) }}"
            class="border-caution hover:rounded-none hover:bg-caution hover:text-white">
            <i data-lucide="edit" class="size-5 stroke-[1.5]"></i>
            <span class="md:hidden lg:block xl:hidden">
              Edit
            </span>
            <span class="hidden md:block lg:hidden xl:block">Edit {{ strtolower($title) }}</span>
          </x-link-button>
        @endif

        @if (isset($routes['create']))
          <x-link-button to="{{ route($routes['create'], $item->id) }}"
            class="border-success hover:rounded-none hover:bg-success hover:text-white">
            <i data-lucide="plus" class="size-5 stroke-[1.5]"></i>
            <span class="md:hidden lg:block xl:hidden">
              Tambahkan
            </span>
            <span class="hidden md:block lg:hidden xl:block">Tambahkan {{ strtolower($title) }}</span>
          </x-link-button>
        @endif
      </div>
    @endif
  </div>
</div>

{{ $slot }}
