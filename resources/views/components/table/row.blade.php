@props([])

<tr {{ $attributes->class(['table-row text-inherit align-middle outline-none relative']) }} {{ $attributes }}>
  {{ $slot }}
</tr>
