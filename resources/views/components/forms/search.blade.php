@props([
  'name',
  'value',
  'placeholder',
])

<div class="block w-full h-auto p-0 m-0 relative" data-te-input-wrapper-init>
  <button class="block w-6 h-6 p-0 m-0 bg-transparent text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out absolute left-0 top-1/2 -translate-y-1/2 z-0 dark:text-white/[0.60]" type="submit" id="button-search">
    <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
      <path d="M0 0h24v24H0z" fill="none" />
      <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
    </svg>
  </button>

  <input {{ $attributes->class(["peer caret-primary block min-h-[32px] w-full border-0 bg-transparent py-1.5 pl-8 subtitle-1 text-black/[0.87] outline-none transition-none duration-0 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-white/[0.87] dark:placeholder:text-white/[0.87] [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0 disabled:opacity-60 disabled:cursor-not-allowed"]) }} type="search"  name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" aria-label="Search" aria-describedby="button-search" {{ $attributes }} />
</div>
