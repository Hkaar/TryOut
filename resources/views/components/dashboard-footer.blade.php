<footer class="w-full px-4 py-4 shadow border-t-2 bg-white border-gray-200">
  <div class="flex flex-col items-center gap-3 text-center lg:text-start lg:flex-row lg:justify-between container">
    <span class="font-semibold" copyright-check>
      Copyright &#169; 2024 {{ $settings['org_name'] }}. All rights reserved.
    </span>

    <div class="flex items-center gap-2">
      <a href="https://www.instagram.com/dimensipelajar/" target="_blank" class="duration-150 ease-in-out hover:opacity-60 active:opacity-50 hover:scale-105 active:scale-95 disabled:hover:scale-100 disabled:active:scale-100 disabled:opacity-40">
        <img src="{{ Vite::asset('resources/images/instagram.svg') }}" alt="Instagram" class="size-8 block aspect-square">
        <span class="sr-only">Instagram</span>
      </a>
    </div>
  </div>
</footer>