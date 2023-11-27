@props([])

<tbody {{ $attributes->class(['table-row-group [&>tr]:border-b [&>tr]:border-solid [&>tr]:border-chinese-white [&>tr]:transition [&>tr]:ease-in-out [&>tr]:duration-300 [&>tr]:motion-reduce:transition-none hover:[&>tr]:bg-black/[0.04] dark:[&>tr]:border-dark-liver dark:hover:[&>tr]:bg-white/[0.04]']) }} {{ $attributes }}>
  {{ $slot }}
</tbody>
