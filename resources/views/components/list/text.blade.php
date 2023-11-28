@props([])

<div {{ $attributes->class(['flex-1 inline-block w-full h-auto p-0 m-0 overflow-hidden relative']) }} {{ $attributes }}>
  {{ $slot }}
</div>
