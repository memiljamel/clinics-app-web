@props([
  'id',
  'name',
  'value',
  'label',
  'checked' => false,
])

<div class="inline-block w-auto min-h-[1.5rem] h-auto p-0 m-0 relative">
  <input {{ $attributes->class(["peer relative float-left mt-0.5 mr-1 ml-0 h-5 w-5 appearance-none rounded-full border-2 border-solid border-black/[0.60] outline-none before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_theme(colors.primary)] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:border-white/[0.60] dark:checked:border-primary dark:checked:after:border-black dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_theme(colors.primary)] disabled:opacity-75 disabled:cursor-not-allowed", 'checked:!border-error checked:after:!border-error checked:after:!bg-error checked:focus:!border-error checked:focus:before:!shadow-[0px_0px_0px_13px_theme(colors.error)] dark:checked:!border-error dark:checked:focus:before:!shadow-[0px_0px_0px_13px_theme(colors.error)' => $errors->has($name)]) }} type="radio" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" @checked($checked) {{ $attributes }} />

  <label class=" inline-block pl-1.5 mt-px subtitle-1 !text-black/[0.87] hover:cursor-pointer dark:!text-white/[0.87] peer-disabled:opacity-75 peer-disabled:cursor-not-allowed" for="{{ $id }}">
    {{ $label }}
  </label>
</div>
