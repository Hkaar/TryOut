<div class="flex flex-col flex-1 min-w-full rounded-xl border border-gray-200 shadow-lg max-h-fit px-7 py-6">
  <div class="flex flex-col lg:flex-row lg:items-center gap-3 lg:justify-between mb-3">
    @if (isset($routes['create']))

      <x-link-button to="{{ $routes['create'] }}" class="border-success hover:bg-success hover:text-white">
        <i class="material-symbols-outlined font-var-light">add</i>

        Tambahkan {{ $title }}
      </x-link-button>
    @else
      <span class="font-semibold text-2xl">
        {{ ucwords($title) }}
      </span>
    @endif

    @if ($filters->hasActualContent())
      <x-filter-container class="lg:ms-auto">
        {{ $filters }}
      </x-filter-container>
    @endif
  </div>

  <div class="-m-1.5 overflow-x-auto">
    <div class="p-1.5 min-w-full inline-block align-middle space-y-4">
      <div class="overflow-hidden border rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
          <thead>
            <tr>
              @foreach ($columns as $col)
                @if (is_string($col))
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                    {{ $col }}
                  </th>
                @else
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500"
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
              <td class="dark:text-neutral-200 whitespace-nowrap px-6 py-4 text-sm text-gray-800">
                <div class="flex items-center gap-2">
                  Tidak ada data yang tersedia ...
                </div>
              </td>
            @endif
          </tbody>
        </table>
      </div>

      @if ($footer->hasActualContent())
        {{ $footer }}
      @endif
    </div>
  </div>
</div>