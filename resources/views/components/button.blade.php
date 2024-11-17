<button {{ $attributes->twMerge(["class" => "btn flex w-fit flex-1 justify-center duration-100 ease-in-out hover:scale-105 active:scale-95 active:opacity-75 disabled:pointer-events-none disabled:opacity-50"]) }}>
  {{ $slot }}
</button>