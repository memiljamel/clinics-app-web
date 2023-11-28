@props([
  'href',
])

<li class="block w-full h-auto p-0 m-0 overflow-hidden relative">
  <a {{ $attributes->class(['flex justify-between items-center gap-4 w-full h-10 py-2 px-4 m-0 body-2 text-black/[0.60] no-underline outline-none truncate select-none hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] dark:text-white/[0.60] dark:hover:bg-white/[0.04] dark:active:bg-white/[0.10] dark:focus:bg-white/[0.12]']) }} href="{{ $href }}" {{ $attributes }} data-te-dropdown-item-ref>
    {{ $slot }}
  </a>
</li>
