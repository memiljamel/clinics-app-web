@props([
  'variant' => 'contained' // text|contained|outlined
])

<div class="block w-auto h-auto p-0 m-0 relative">
  <button {{ $attributes->class(['inline-block min-w-[64px] w-auto h-9 p-2 m-0 rounded button text-black/[0.87] text-center align-middle truncate outline-none cursor-pointer relative disabled:opacity-70 disabled:cursor-not-allowed', 'p-2 bg-transparent text-primary shadow-none hover:bg-primary/[0.04] active:bg-primary/[0.10] focus:bg-primary/[0.12] disabled:hover:bg-transparent disabled:active:bg-transparent disabled:focus:bg-transparent' => $variant === 'text', 'px-4 py-2 border-none text-white bg-primary shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] transition-all hover:shadow-[0_2px_4px_-1px_rgba(0,0,0,0.2),_0_4px_5px_0_rgba(0,0,0,0.14),_0_1px_10px_0_rgba(0,0,0,0.12)] focus:shadow-[0_2px_4px_-1px_rgba(0,0,0,0.2),_0_4px_5px_0_rgba(0,0,0,0.14),_0_1px_10px_0_rgba(0,0,0,0.12)] active:shadow-[0_5px_5px_-3px_rgba(0,0,0,0.2),_0_8px_10px_1px_rgba(0,0,0,0.14),_0_3px_14px_2px_rgba(0,0,0,0.12)] disabled:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)]' => $variant === 'contained', 'px-4 py-2 bg-transparent border border-solid border-primary text-primary hover:bg-primary/[0.04] active:bg-primary/[0.10] focus:bg-primary/[0.12] disabled:hover:bg-transparent disabled:active:bg-transparent disabled:focus:bg-transparent' => $variant === 'outlined']) }} {{ $attributes->merge(['type' => 'button']) }} {{ $attributes }}>
    {{ $slot }}
  </button>
</div>
