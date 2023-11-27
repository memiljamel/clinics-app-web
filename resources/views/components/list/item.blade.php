@props([])

<li class="block w-full h-auto p-0 m-0 overflow-hidden relative">
  <div {{ $attributes->class(['flex justify-between items-center gap-4 w-full h-12 py-3 px-4 m-0 text-black/[0.60] no-underline outline-none whitespace-nowrap overflow-hidden select-none']) }} {{ $attributes }}>
    {{ $slot }}
  </div>
</li>
