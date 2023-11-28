@props([
  'color' => 'default', // default|success|warning|error
])

<span {{ $attributes->class(['inline-block w-auto max-w-full h-6 px-2.5 m-0 body-2 font-medium rounded-full align-middle text-xs leading-6 select-none truncate relative', 'bg-black/[0.08] text-black/[0.87] dark:bg-white/[0.08] dark:text-white/[0.87]' => $color === 'default', 'bg-green-100 text-green-600' => $color === 'success', 'bg-amber-100 text-amber-600' => $color === 'warning', 'bg-red-100 text-error' => $color === 'error']) }} {{ $attributes }}>
  {{ $slot }}
</span>
