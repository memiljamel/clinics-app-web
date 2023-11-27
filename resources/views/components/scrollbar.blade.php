@props([])

<div {{ $attributes->class(['flex flex-col w-full h-full p-0 m-0 relative']) }} {{ $attributes }} data-te-perfect-scrollbar-init>
  <div class="block w-full h-full p-0 m-0">
    <div class="table min-w-full h-auto p-0 m-0">
      {{ $slot }}
    </div>
  </div>
</div>
