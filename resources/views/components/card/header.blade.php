@props([])

<div class="block w-full h-auto p-0 m-0 overflow-hidden">
  <div {{ $attributes->class(['flex justify-between items-center w-full h-16 p-2 m-0 relative']) }} {{ $attributes }}>
    {{ $slot }}
  </div>
</div>
