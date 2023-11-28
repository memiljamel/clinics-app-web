@props([])

<nav {{ $attributes->class(['block w-full h-auto p-0 m-0 list-none rounded whitespace-nowrap overflow-hidden relative']) }} {{ $attributes }}>
  <ol class="block w-full h-auto p-0 m-0 overflow-hidden">
    {{ $slot }}
  </ol>
</nav>
