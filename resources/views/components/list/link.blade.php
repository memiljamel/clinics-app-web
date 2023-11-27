@props([
  'href',
  'routeIs' => '',
])

<li class="block w-full h-auto p-0 m-0 overflow-hidden relative">
  <a {{ $attributes->class(['flex justify-between items-center gap-4 w-full h-12 py-3 px-4 m-0 text-black/[0.60] no-underline outline-none whitespace-nowrap overflow-hidden select-none hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] dark:text-white/[0.60] dark:hover:bg-white/[0.04] dark:active:bg-white/[0.10] dark:focus:bg-white/[0.12]']) }} href="{{ $href }}" {{ $attributes }} @if (request()->routeIs($routeIs)) open @endif>
    {{ $slot }}
  </a>
</li>
