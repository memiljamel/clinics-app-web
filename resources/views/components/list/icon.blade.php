@props([])

<div {{ $attributes->class(['inline-block w-auto h-auto p-0 m-0 relative']) }} {{ $attributes }}>
  {{ $slot }}
</div>
