@props([
  'href',
])

<li class="inline-block w-auto h-auto p-0 m-0 relative [&+li::before]:content-['/'] [&+li::before]:mx-1 [&+li::before]:text-black/[0.60] dark:[&+li::before]:text-white/[0.60]">
  <a {{ $attributes->class(['inline-block w-auto h-auto p-0 m-0 subtitle-1 text-primary no-underline outline-none cursor-pointer hover:underline focus:underline active:underline']) }} href="{{ $href }}" {{ $attributes }}>
    {{ $slot }}
  </a>
</li>
