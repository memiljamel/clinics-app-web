@props([
  'src',
  'alt',
])

<img {{ $attributes->class(['block w-10 h-10 p-0.5 m-0 rounded-full align-middle text-center text-transparent object-cover indent-[10000px] ring-2 ring-primary']) }} src="{{ $src }}" alt="{{ $alt }}" {{ $attributes }} />
