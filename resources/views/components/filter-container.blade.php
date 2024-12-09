<div {{ $attributes->merge(["class" => "lg:hidden hs-accordion-group"]) }}>
  <div class="hs-accordion active" id="hs-basic-with-title-and-arrow-stretched-heading-one">
    <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 border mb-2 lg:w-fit px-3 py-2 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
      Tampilkan filter
      <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m6 9 6 6 6-6"></path>
      </svg>
      <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m18 15-6-6-6 6"></path>
      </svg>
    </button>

    <div id="hs-basic-with-title-and-arrow-stretched-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
      {{ $slot }}
    </div>
  </div>
</div>

<div {{ $attributes->merge(["class" => "hidden lg:block"]) }}>
  {{ $slot }}
</div>