<header class="flex w-full flex-wrap bg-white py-3 text-sm shadow dark:bg-neutral-800 sm:flex-nowrap sm:justify-start">
  <nav class="mx-auto w-full px-6 sm:flex sm:items-center sm:justify-between">
    <div class="flex items-center justify-between">
      <span class="flex items-center gap-3">
        <button type="button"
          class="btn side-bar-toggle border-gray-200 bg-white p-2 text-gray-800 shadow-sm hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-transparent dark:text-white dark:hover:bg-white/10">
          <i data-lucide="panel-left-open" class="size-5 stroke-[1.5] sideOpenIcon"></i>
          <i data-lucide="panel-left-close" class="size-5 stroke-[1.5] sideCloseIcon hidden"></i>
        </button>

        <x-breadcrumb></x-breadcrumb>
      </span>

      <div class="sm:hidden">
        <button type="button"
          class="hs-collapse-toggle inline-flex items-center justify-center gap-x-2 rounded-lg bg-white p-2 text-gray-800 shadow-sm hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:bg-transparent dark:text-white dark:hover:bg-white/10"
          data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation"
          aria-label="Toggle navigation">
          <i data-lucide="ellipsis-vertical" class="size-5 stroke-[1.5]"></i>
        </button>
      </div>
    </div>

    <div id="navbar-collapse-with-animation"
      class="hs-collapse hidden grow basis-full overflow-hidden transition-all duration-300 sm:block">
      <div class="mt-5 flex flex-col gap-5 sm:mt-0 sm:flex-row sm:items-center sm:justify-end sm:ps-5">
        <a class="flex items-center gap-2 rounded-md px-2 py-1 transition-all duration-150 ease-in-out hover:bg-gray-50 hover:text-gray-400 dark:hover:text-neutral-500"
          href="{{ route('home') }}">
          <i data-lucide="house" class="size-4 stroke-[1.5]"></i>

          Beranda
        </a>

        <a
          class="flex items-center gap-2 rounded-md bg-gray-50 px-2 py-1 text-gray-400 transition-all duration-150 ease-in-out dark:hover:text-neutral-500">
          <i data-lucide="layout-panel-left" class="size-4 stroke-[1.5]"></i>

          Dashboard
        </a>

        <form action="{{ route('logout') }}" method="POST">
          @csrf

          <x-button type="submit"
            class="flex items-center justify-start gap-x-2 rounded-lg px-2 py-1 w-full text-sm text-danger hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-danger dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 hover:scale-100 active:scale-100">
            <i data-lucide="log-out" class="size-4 stroke-[1.5]"></i>

            Logout
          </x-button>
        </form>
      </div>
    </div>
  </nav>
</header>
