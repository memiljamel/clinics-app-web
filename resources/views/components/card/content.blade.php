@props([])

<div {{ $attributes->class(['block w-full h-auto p-4 m-0 overflow-hidden']) }} {{ $attributes }}>
  {{ $slot }}
</div>
