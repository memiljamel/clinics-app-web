@props([])

<ul {{ $attributes->class(['hidden min-w-[128px] w-auto max-w-[280px] h-auto py-2 m-0 list-none rounded bg-white shadow-08dp absolute top-full right-0 z-10 [&[data-te-dropdown-show]]:block dark:bg-charleston-green']) }} {{ $attributes }} data-te-dropdown-menu-ref>
  {{ $slot }}
</ul>
