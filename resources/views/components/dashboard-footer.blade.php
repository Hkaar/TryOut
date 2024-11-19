<footer class="w-full px-4 py-4 shadow border-t-2 bg-white border-gray-200">
  <div class="flex flex-col items-center gap-3 text-center lg:text-start lg:flex-row lg:justify-between container">
    <span class="font-semibold" copyright-check>
      Copyright &#169; 2024 {{ $settings['org_name'] }}. All rights reserved.
    </span>

    <div class="flex items-center gap-2">
      <a href="https://www.github.com/Hkaar" copyright-check target="_blank" class="duration-150 ease-in-out hover:opacity-60 active:opacity-50 hover:scale-105 active:scale-95 disabled:hover:scale-100 disabled:active:scale-100 disabled:opacity-40">
        <img src="{{ Vite::asset('resources/images/github.svg') }}" alt="Github" class="size-6 block aspect-square">
      </a>
    </div>
  </div>
</footer>