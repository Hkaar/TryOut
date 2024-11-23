<header {{ $attributes->twMerge(["class" => "dark:bg-neutral-800 sticky top-0 z-40 mx-auto flex w-full flex-wrap border border-gray-200 bg-white py-3 text-sm shadow-md sm:flex-nowrap sm:justify-start md:top-2 md:w-[98%] xl:w-10/12 max-w-[85rem] md:rounded-full"]) }}>
  <nav class="mx-auto flex w-full max-w-[85rem] items-center justify-between px-4">
    <div class="bg-gray flex flex-1 items-center justify-between">
      <a href="{{ route('/') }}">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Gambar tidak dapat dimuatkan"
          class="size-12 rounded-full">
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
            class="hs-dropdown-toggle dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 inline-flex items-center gap-x-2 rounded-lg bg-transparent text-sm font-medium text-gray-800 shadow-sm focus:outline-none disabled:pointer-events-none disabled:opacity-50"
            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            <img
              src="{{ auth()->user()->profile_photo ? Storage::url(auth()->user()->profile_photo) : Vite::asset('resources/images/default-avatar.png') }}"
              alt="Gambar tidak dapat dimuatkan" class="size-10 aspect-square rounded-full object-cover">

            <svg class="size-4 hs-dropdown-open:rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>

          <div
            class="hs-dropdown-menu duration min-w-60 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 z-10 mt-2 hidden w-56 rounded-lg bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100"
            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
            <span class="mb-2 flex items-center gap-2 px-3 py-2 text-lg">
              <a href="{{ route('/') }}" class="line-clamp-1">{{ auth()->user()->username }}</a>

              <span class="rounded-xl bg-accent px-2 py-1 text-sm font-bold text-white">
                {{ ucfirst(auth()->user()->role->name) }}
              </span>
            </span>

            <hr />

            <div class="mt-2 space-y-1">
              <a class="dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm focus:outline-none {{ isset($active) && $active === 'home' ? 'bg-gray-100 text-neutral-400' : 'hover:bg-gray-100 focus:bg-gray-100 text-gray-800' }}"
                href="{{ isset($active) && $active === 'home' ? '' : route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-4">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>

                Beranda
              </a>

              @if (auth()->user()->checkRole('admin'))
                <a class="dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                  href="{{ route('admin.home') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                  </svg>
                  Dashboard
                </a>
              @endif

              <hr />

              <a class="dark:text-danger dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-danger hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                href="{{ route('logout') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-4">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
                Logout
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
