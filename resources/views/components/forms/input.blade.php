@props([
  'id',
  'name',
  'value',
  'label',
])

<div class="block w-full h-auto p-0 m-0 relative" data-te-input-wrapper-init>
  <input {{ $attributes->class(["peer caret-primary block min-h-[48px] w-full border-0 bg-transparent pt-3 pb-2 subtitle-1 text-black/[0.87] outline-none transition-none duration-0 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-white/[0.87] dark:placeholder:text-white/[0.87] [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0 group-data-[te-validation-state='invalid']:!caret-error disabled:opacity-60 disabled:cursor-not-allowed", '!pr-11' => $attributes->get('type') === 'password', '!caret-error' => $errors->has($name)]) }} {{ $attributes->merge(['type' => 'text']) }} id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes }} />

  <label @class(["pointer-events-none absolute top-0 left-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-3 leading-[1.6] text-black/[0.60] transition-all duration-200 ease-out peer-focus:-translate-y-[1.25rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.25rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-white/[0.60] dark:peer-focus:text-primary group-data-[te-validation-state='invalid']:!text-error group-data-[te-validation-state='invalid']:peer-focus:!text-error peer-disabled:opacity-60 peer-disabled:cursor-not-allowed", '!text-error peer-focus:!text-error dark:!text-error dark:peer-focus:!text-error' => $errors->has($name)]) for="{{ $id }}">
    {{ $label }}
  </label>

  @if ($attributes->get('type') === 'password')
    <button class="block w-9 h-9 p-1.5 m-0 text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out absolute right-0 top-1/2 -translate-y-1/2 z-0 hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] dark:text-white/[0.60] dark:hover:bg-white/[0.04] dark:active:bg-white/[0.10] dark:focus:bg-white/[0.12]" type="button" data-te-container="toggle-password">
      <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
        <path d="M0 0h24v24H0z" fill="none" />
        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
      </svg>
    </button>
  @endif
</div>
