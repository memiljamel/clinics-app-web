@props([])

<button {{ $attributes->class(['inline-block w-9 h-9 p-1.5 m-0 bg-transparent rounded-full text-black/[0.60] outline-none cursor-pointer align-middle transition duration-150 ease-in-out hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] dark:text-white/[0.60] dark:hover:bg-white/[0.04] dark:active:bg-white/[0.10] dark:focus:bg-white/[0.12]']) }} {{ $attributes->merge(['type' => 'button']) }} {{ $attributes }} data-te-dropdown-toggle-ref data-te-dropdown-animation="off">
  {{ $slot }}
</button>
