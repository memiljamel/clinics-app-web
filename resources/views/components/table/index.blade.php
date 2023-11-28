@props([])

<table {{ $attributes->class(['table table-auto w-full h-auto p-0 m-0 border-collapse border-spacing-0 relative']) }} {{ $attributes }}>
  {{ $slot }}
</table>
