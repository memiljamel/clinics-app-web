@props([])

<aside class="block w-auto h-full p-0 m-0 !visible overflow-hidden outline-none transition-transform fixed top-0 left-0 z-[1045] -translate-x-full lg:translate-x-0 lg:z-30 [&[data-te-offcanvas-show]]:transform-none [&[data-te-offcanvas-show]]:shadow-16dp" id="offcanvas" data-te-offcanvas-init tabindex="-1">
  <div {{ $attributes->class(['block w-64 h-full bg-white border-r border-solid border-chinese-white shadow-none overflow-x-hidden overflow-y-auto dark:bg-charleston-green dark:border-dark-liver']) }} {{ $attributes }}>
    {{ $slot }}
  </div>
</aside>
