@props([
  'align' => 'left', // left|center|right
])

<td {{ $attributes->class(['table-cell w-auto h-[52px] px-4 m-0 body-2 text-black/[0.87] truncate dark:text-white/[0.87]', 'text-left' => $align === 'left', 'text-center' => $align === 'center', 'text-right' => $align === 'right']) }} {{ $attributes }}>
  {{ $slot }}
</td>
