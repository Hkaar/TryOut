<div class="flex max-h-fit min-w-full flex-1 flex-col rounded-xl border border-gray-200 px-7 py-6 shadow-lg">
  <div class="mb-3 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
    @if (isset($routes['create']))
      <x-link-button to="{{ $routes['create'] }}" class="border-success px-3 py-2 hover:bg-success hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>

        Tambahkan {{ $title }}
      </x-link-button>
    @else
      <span class="text-2xl font-semibold">
        {{ ucwords($title) }}
      </span>
    @endif

    @if ($filters->hasActualContent())
      <x-filter-container class="lg:ms-auto">
        {{ $filters }}
      </x-filter-container>
    @endif
  </div>

  <div class="mb-3 overflow-x-auto">
    <div class="inline-block min-w-full space-y-4 p-1.5 align-middle">
      <div class="overflow-hidden rounded-lg border">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
          <thead>
            <tr>
              @foreach ($columns as $col)
                @if (is_string($col))
                  <th scope="col"
                    class="px-6 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                    {{ $col }}
                  </th>
                @else
                  <th scope="col"
                    class="px-6 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500"
                    width="{{ isset($col['width']) ? $col['width'] . '%' : '' }}">
                    {{ $col['name'] }}
                  </th>
                @endif
              @endforeach
            </tr>
          </thead>

          <tbody>
            @if ($slot->hasActualContent())
              {{ $slot }}
            @else
              <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                <div class="flex items-center gap-2">
                  Tidak ada data yang tersedia ...
                </div>
              </td>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @if ($footer->hasActualContent())
    {{ $footer }}
  @endif
</div>
