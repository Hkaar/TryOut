<header
  {{ $attributes->twMerge(['class' => 'dark:bg-neutral-800 sticky top-0 z-40 mx-auto flex w-full flex-wrap border border-gray-200 bg-white py-3 text-sm shadow-md sm:flex-nowrap sm:justify-start md:top-2 md:w-[98%] xl:w-10/12 max-w-[85rem] md:rounded-full']) }}>
  <nav class="mx-auto flex w-full max-w-[85rem] items-center justify-between px-4">
    <div class="bg-gray flex flex-1 items-center justify-between">
      <a href="{{ route('/') }}">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Gambar tidak dapat dimuatkan"
          class="size-12 aspect-square rounded-full object-cover">
      </a>
    </div>

    <a class="hidden items-center gap-2 text-xl font-bold uppercase text-secondary focus:opacity-80 focus:outline-none md:flex md:text-2xl"
      href="{{ route('/') }}" aria-label="Brand">
      <span class="hidden md:block">
        {{ ucwords($settings['org_name']) }}
      </span>
    </a>

    <div id="hs-navbar-example" class="flex flex-1 overflow-hidden transition-all duration-300 sm:block"
      aria-labelledby="hs-navbar-example-collapse">
      <div class="flex w-full justify-end">
        <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
          <button id="hs-dropdown-default" type="button"
            class="hs-dropdown-toggle inline-flex items-center gap-x-2 rounded-lg bg-transparent text-sm font-medium text-gray-800 shadow-sm focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            <img
              src="{{ auth()->user()->img ? Storage::url(auth()->user()->img) : Vite::asset('resources/images/default-avatar.png') }}"
              alt="Gambar tidak dapat dimuatkan" class="size-10 aspect-square rounded-full object-cover">

            <svg class="size-4 hs-dropdown-open:rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>

          <div
            class="hs-dropdown-menu duration min-w-60 z-10 mt-2 hidden w-56 rounded-lg bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100 dark:divide-neutral-700 dark:border dark:border-neutral-700 dark:bg-neutral-800"
            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
            <span class="mb-2 flex items-center gap-2 px-3 py-2 text-lg">
              <a href="{{ route('/') }}" class="line-clamp-1">{{ auth()->user()->username }}</a>

              <span class="rounded-xl bg-accent px-2 py-1 text-sm font-bold text-white">
                {{ ucfirst(auth()->user()->role->name) }}
              </span>
            </span>

            <hr />

            <div class="mt-2 space-y-1">
              <a class="{{ isset($active) && $active === 'home' ? 'bg-gray-100 text-neutral-400' : 'hover:bg-gray-100 focus:bg-gray-100 text-gray-800' }} flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                href="{{ isset($active) && $active === 'home' ? '' : route('home') }}">
                <i data-lucide="house" class="size-4 stroke-[1.5]"></i>

                Beranda
              </a>

              @if (auth()->user()->checkRole('admin'))
                <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                  href="{{ route('admin.home') }}">
                  <i data-lucide="layout-panel-left" class="size-4 stroke-[1.5]"></i>

                  Dashboard
                </a>
              @endif

              <hr />

              <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf

                <x-button type="submit"
                  class="flex items-center justify-start gap-x-3.5 rounded-lg px-3 py-2 w-full text-sm text-danger hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-danger dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 hover:scale-100 active:scale-100">
                  <i data-lucide="log-out" class="size-4 stroke-[1.5]"></i>

                  Logout
                </x-button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
