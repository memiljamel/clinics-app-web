@props([])

<ul {{ $attributes->class(['block w-full py-2 m-0 list-none shadow-none relative']) }} {{ $attributes }}>
  {{ $slot }}
</ul>
