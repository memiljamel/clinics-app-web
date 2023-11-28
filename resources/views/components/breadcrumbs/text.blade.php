@props([])

<li class="inline-block w-auto h-auto p-0 m-0 relative [&+li::before]:content-['/'] [&+li::before]:mx-1 [&+li::before]:text-black/[0.60] dark:[&+li::before]:text-white/[0.60]">
  <span {{ $attributes->class(['inline-block w-auto h-auto p-0 m-0 subtitle-1 text-black/[0.60] cursor-default dark:text-white/[0.60]']) }} {{ $attributes }}>
    {{ $slot }}
  </span>
</li>
