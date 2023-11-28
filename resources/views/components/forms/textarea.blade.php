@props([
  'id',
  'name',
  'value',
  'label',
])

<div class="block w-full h-auto p-0 m-0 relative" data-te-input-wrapper-init>
  <textarea {{ $attributes->class(["peer caret-primary block min-h-[48px] w-full border-0 bg-transparent pt-3 pb-2 subtitle-1 text-black/[0.87] outline-none transition-none duration-0 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-white/[0.87] dark:placeholder:text-white/[0.87] [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0 group-data-[te-validation-state='invalid']:!caret-error disabled:opacity-60 disabled:cursor-not-allowed", '!caret-error' => $errors->has($name)]) }} id="{{ $id }}" name="{{ $name }}" rows="1" {{ $attributes }}>{{ $value }}</textarea>

  <label @class(["pointer-events-none absolute top-0 left-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-3 leading-[1.6] text-black/[0.60] transition-all duration-200 ease-out peer-focus:-translate-y-[1.25rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.25rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-white/[0.60] dark:peer-focus:text-primary group-data-[te-validation-state='invalid']:!text-error group-data-[te-validation-state='invalid']:peer-focus:!text-error peer-disabled:opacity-60 peer-disabled:cursor-not-allowed", '!text-error peer-focus:!text-error dark:!text-error dark:peer-focus:!text-error' => $errors->has($name)]) for="{{ $id }}">
    {{ $label }}
  </label>
</div>
