@props([])

<div class="hidden invisible w-auto max-w-[344px] h-auto px-4 py-2 mx-auto bg-dark-charcoal border-none  rounded-full shadow-md overflow-hidden animate-toast fixed bottom-8 left-1/2 -translate-x-1/2 z-[9999] data-[te-toast-show]:block data-[te-toast-show]:visible data-[te-toast-hide]:hidden data-[te-toast-hide]:invisible dark:bg-lotion" role="alert" {{ $attributes }} aria-live="assertive" aria-atomic="true" data-te-position="bottom-center" data-te-offset="32" data-te-delay="2800" data-te-container="toast" data-te-toast-init data-te-toast-show>
  <span class="block w-full h-auto p-0 m-0 body-2 text-center text-white truncate dark:text-black">
    {{ $slot }}
  </span>
</div>
