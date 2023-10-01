<div class="block p-0 m-0 relative">
  <button class="relative inline-block border-none rounded py-2 px-4 m-0 min-w-[64px] w-full h-9 align-middle button text-center text-white bg-primary shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] overflow-hidden outline-none cursor-pointer transition-all hover:shadow-[0_2px_4px_-1px_rgba(0,0,0,0.2),_0_4px_5px_0_rgba(0,0,0,0.14),_0_1px_10px_0_rgba(0,0,0,0.12)] focus:shadow-[0_2px_4px_-1px_rgba(0,0,0,0.2),_0_4px_5px_0_rgba(0,0,0,0.14),_0_1px_10px_0_rgba(0,0,0,0.12)] active:shadow-[0_5px_5px_-3px_rgba(0,0,0,0.2),_0_8px_10px_1px_rgba(0,0,0,0.14),_0_3px_14px_2px_rgba(0,0,0,0.12)] disabled:text-black/[0.38] disabled:bg-black/[0.12] disabled:shadow-none disabled:cursor-default dark:text-black" {{ $attributes->merge(['type' => 'button']) }} {{ $attributes }} data-te-ripple-init data-te-ripple-color="light">
    {{ $slot }}
  </button>
</div>
