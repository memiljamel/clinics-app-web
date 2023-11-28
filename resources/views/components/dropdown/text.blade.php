@props([])

<div class="flex-1 inline-block w-full h-auto p-0 m-0 overflow-hidden relative">
  <span {{ $attributes->class(['block w-full h-auto p-0 m-0 text-black/[0.87] text-left truncate dark:text-white/[0.87]']) }} {{ $attributes }}>
    {{ $slot }}
  </span>
</div>
