@props([
  'id',
  'name',
  'label',
])

<div class="block w-full h-auto p-0 m-0 relative">
  <select id="{{ $id }}" name="{{ $name }}" {{ $attributes }} data-te-select-init>
    {{ $slot }}
  </select>

  <label for="{{ $id }}" data-te-select-label-ref>
    {{ $label }}
  </label>
</div>
