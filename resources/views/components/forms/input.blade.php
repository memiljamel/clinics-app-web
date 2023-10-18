@props([
  'id',
  'name',
  'label',
  'value',
])

<div class="block p-0 m-0 relative">
  <div class="block w-full min-w-[280px] h-11 p-0 mb-2 relative">
    <input {{ $attributes->class(['peer caret-primary w-full h-full bg-transparent text-black/[0.87] font-roboto font-normal outline outline-0 focus:outline-0 disabled:border-0 transition-all border-b placeholder-shown:border-black/[0.12] text-base tracking-normal pt-4 pb-1.5 border-black/[0.12] focus:border-primary dark:text-white dark:disabled:placeholder-shown:boder-white/[0.12] dark:border-white/[0.12]', '!caret-errors focus:!border-errors' => $errors->get($name)]) }} {{ $attributes->merge(['type' => 'text']) }} id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" placeholder="" {{ $attributes }} />
    <label {{ $attributes->class(['flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-black/[0.38] leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-black/[0.38] transition-all -top-1.5 peer-placeholder-shown:text-sm text-xs peer-focus:text-xs after:content[""] after:block after:w-full after:absolute after:-bottom-1.5 left-0 after:border-b-2 after:scale-x-0 peer-focus:after:scale-x-100 after:transition-transform after:duration-300 peer-placeholder-shown:leading-[4.25] text-black/[0.38] peer-focus:text-primary after:border-primary peer-focus:after:border-primary dark:peer-placeholder-shown:text-white/[0.38] dark:peer-disabled:peer-placeholder-shown:text-white/[0.38] dark:text-white/[0.38] dark:peer-focus:text-primary', 'peer-focus:!text-errors after:!border-errors peer-focus:after:!border-errors' => $errors->get($name)]) }} for="{{ $id }}">
      {{ $label }}
    </label>

    @if ($attributes->get('type') === 'password')
      <button class="block w-10 h-10 p-2 m-0 text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out absolute right-0 top-1/2 -translate-y-1/2 hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] dark:text-white/[0.60] dark:hover:bg-white/[0.04] dark:active:bg-white/[0.10] dark:focus:bg-white/[0.12]" type="button" data-te-container="toggle-password">
        <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
          <path d="M0 0h24v24H0z" fill="none" />
          <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
        </svg>
      </button>
    @endif
  </div>

  @error($name)
    <div class="block w-full h-auto p-0 mb-2 relative">
      <span class="block p-0 m-0 text-xs tracking-normal text-errors break-words">
        {{ $message }}
      </span>
    </div>
  @enderror
</div>
