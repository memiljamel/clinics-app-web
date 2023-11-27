@props([])

<div class="block w-auto h-auto p-0 m-0 relative">
  <button {{ $attributes->class(['inline-block w-10 h-10 p-2 m-0 bg-transparent rounded-full text-white outline-none cursor-pointer align-middle transition duration-150 ease-in-out hover:bg-white/[0.04] active:bg-white/[0.10] focus:bg-white/[0.12] lg:hidden']) }} {{ $attributes->merge(['type' => 'button']) }} {{ $attributes }} data-te-offcanvas-toggle data-te-target="#offcanvas">
    {{ $slot }}
  </button>
</div>
