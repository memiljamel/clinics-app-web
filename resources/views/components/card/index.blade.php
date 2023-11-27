@props([])

<div {{ $attributes->class(['block w-full h-auto p-0 m-0 bg-white rounded text-black/[0.87] shadow-01dp overflow-hidden dark:bg-charleston-green']) }} {{ $attributes }}>
  {{ $slot }}
</div>
