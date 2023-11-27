@props([])

<div {{ $attributes->class(['block w-auto h-auto p-0 m-0 relative']) }} {{ $attributes }} data-te-dropdown-ref>
  {{ $slot }}
</div>
