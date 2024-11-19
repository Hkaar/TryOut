<header class="dark:bg-neutral-800 flex w-full flex-wrap bg-white py-3 text-sm shadow sm:flex-nowrap sm:justify-start">
  <nav class="mx-auto w-full px-6 sm:flex sm:items-center sm:justify-between">
    <div class="flex items-center justify-between">
      <span class="flex items-center gap-3">
        <button type="button"
          class="btn side-bar-toggle dark:bg-transparent dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 border-gray-200 bg-white p-2 text-gray-800 shadow-sm hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50">
          <i class="material-symbols-outlined font-var-light">menu</i>
        </button>

        <x-breadcrumb></x-breadcrumb>
      </span>

      <div class="sm:hidden">
        <button type="button"
          class="hs-collapse-toggle dark:bg-transparent dark:text-white dark:hover:bg-white/10 inline-flex items-center justify-center gap-x-2 rounded-lg bg-white p-2 text-gray-800 shadow-sm hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50"
          data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation"
          aria-label="Toggle navigation">
          <i class="material-symbols-outlined">more_vert</i>
        </button>
      </div>
    </div>

    <div id="navbar-collapse-with-animation"
      class="hs-collapse hidden grow basis-full overflow-hidden transition-all duration-300 sm:block">
      <div class="mt-5 flex flex-col gap-5 sm:mt-0 sm:flex-row sm:items-center sm:justify-end sm:ps-5">
        <a class="dark:hover:text-neutral-500 flex items-center gap-1 hover:bg-gray-50 px-2 py-1 rounded-md ease-in-out duration-150 transition-all hover:text-gray-400"
          href="{{ route('home') }}">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
          </svg>

          Beranda
        </a>

        <a class="dark:hover:text-neutral-500 flex items-center gap-1 bg-gray-50 text-gray-400 ease-in-out duration-150 transition-all px-2 py-1 rounded-md">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
          </svg>

          Dashboard
        </a>

        <a class="dark:text-red-400 dark:hover:text-neutral-500 flex items-center gap-1 text-red-600 px-2 py-1 ease-in-out duration-150 transition-all rounded-md hover:bg-gray-50 hover:text-gray-400"
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
  </nav>
</header>
