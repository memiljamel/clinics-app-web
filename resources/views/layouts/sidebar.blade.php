<x-offcanvas>
  <div class="block w-full h-14 p-2 m-0 relative lg:h-16 lg:py-3">
    <a class="inline-block w-auto max-w-full h-10 px-2 py-1.5 m-0 headline-6 text-black/[0.87] no-underline truncate dark:text-white/[0.87]" href="" id="sidebar-label">
      {{ config('app.name', 'Laravel') }}
    </a>
  </div>

  <x-list class="pr-2 border-t border-solid border-chinese-white dark:border-dark-liver">
    <x-list.link class="group rounded-r-full open:bg-primary/[0.04] open:text-primary open:hover:bg-primary/[0.04] open:active:bg-primary/[0.10] open:focus:bg-primary/[0.12] dark:open:bg-primary dark:open:text-black dark:open:hover:bg-primary dark:open:active:bg-primary dark:open:focus:bg-primary" href="" routeIs="dashboard.*">
      <x-list.icon>
        <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
          <path d="M0 0h24v24H0z" fill="none" />
          <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
        </svg>
      </x-list.icon>

      <x-list.text>
        <span class="block w-full h-auto p-0 m-0 subtitle-1 text-black/[0.87] text-left truncate dark:text-white/[0.87] group-open:text-primary dark:group-open:text-black">
          {{ __('Dashboard') }}
        </span>
      </x-list.text>
    </x-list.link>

    <x-list.link class="group rounded-r-full open:bg-primary/[0.04] open:text-primary open:hover:bg-primary/[0.04] open:active:bg-primary/[0.10] open:focus:bg-primary/[0.12] dark:open:bg-primary dark:open:text-black dark:open:hover:bg-primary dark:open:active:bg-primary dark:open:focus:bg-primary" href="" routeIs="queue.*">
      <x-list.icon>
        <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
          <g><rect fill="none" height="24" width="24" /></g>
          <g><path d="M6,2l0.01,6L10,12l-3.99,4.01L6,22h12v-6l-4-4l4-3.99V2H6z M16,16.5V20H8v-3.5l4-4L16,16.5z" /></g>
        </svg>
      </x-list.icon>

      <x-list.text>
        <span class="block w-full h-auto p-0 m-0 subtitle-1 text-black/[0.87] text-left truncate dark:text-white/[0.87] group-open:text-primary dark:group-open:text-black">
          {{ __('Waiting List') }}
        </span>
      </x-list.text>
    </x-list.link>

    <x-list.link class="group rounded-r-full open:bg-primary/[0.04] open:text-primary open:hover:bg-primary/[0.04] open:active:bg-primary/[0.10] open:focus:bg-primary/[0.12] dark:open:bg-primary dark:open:text-black dark:open:hover:bg-primary dark:open:active:bg-primary dark:open:focus:bg-primary" href="" routeIs="patients.*">
      <x-list.icon>
        <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
          <path d="M0 0h24v24H0z" fill="none" />
          <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
        </svg>
      </x-list.icon>

      <x-list.text>
        <span class="block w-full h-auto p-0 m-0 subtitle-1 text-black/[0.87] text-left truncate dark:text-white/[0.87] group-open:text-primary dark:group-open:text-black">
          {{ __('Patients') }}
        </span>
      </x-list.text>
    </x-list.link>

    <x-list.link class="group rounded-r-full open:bg-primary/[0.04] open:text-primary open:hover:bg-primary/[0.04] open:active:bg-primary/[0.10] open:focus:bg-primary/[0.12] dark:open:bg-primary dark:open:text-black dark:open:hover:bg-primary dark:open:active:bg-primary dark:open:focus:bg-primary" href="" routeIs="doctors.*">
      <x-list.icon>
        <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
          <path d="M0 0h24v24H0z" fill="none" />
          <path d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
        </svg>
      </x-list.icon>

      <x-list.text>
        <span class="block w-full h-auto p-0 m-0 subtitle-1 text-black/[0.87] text-left truncate dark:text-white/[0.87] group-open:text-primary dark:group-open:text-black">
          {{ __('Doctors') }}
        </span>
      </x-list.text>
    </x-list.link>

    <x-list.link class="group rounded-r-full open:bg-primary/[0.04] open:text-primary open:hover:bg-primary/[0.04] open:active:bg-primary/[0.10] open:focus:bg-primary/[0.12] dark:open:bg-primary dark:open:text-black dark:open:hover:bg-primary dark:open:active:bg-primary dark:open:focus:bg-primary" href="{{ route('users.index') }}" routeIs="users.*">
      <x-list.icon>
        <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
          <rect fill="none" height="24" width="24" />
          <g><path d="M12,12.75c1.63,0,3.07,0.39,4.24,0.9c1.08,0.48,1.76,1.56,1.76,2.73L18,18H6l0-1.61c0-1.18,0.68-2.26,1.76-2.73 C8.93,13.14,10.37,12.75,12,12.75z M4,13c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2s-2,0.9-2,2C2,12.1,2.9,13,4,13z M5.13,14.1 C4.76,14.04,4.39,14,4,14c-0.99,0-1.93,0.21-2.78,0.58C0.48,14.9,0,15.62,0,16.43V18l4.5,0v-1.61C4.5,15.56,4.73,14.78,5.13,14.1z M20,13c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2s-2,0.9-2,2C18,12.1,18.9,13,20,13z M24,16.43c0-0.81-0.48-1.53-1.22-1.85 C21.93,14.21,20.99,14,20,14c-0.39,0-0.76,0.04-1.13,0.1c0.4,0.68,0.63,1.46,0.63,2.29V18l4.5,0V16.43z M12,6c1.66,0,3,1.34,3,3 c0,1.66-1.34,3-3,3s-3-1.34-3-3C9,7.34,10.34,6,12,6z" /></g>
        </svg>
      </x-list.icon>

      <x-list.text>
        <span class="block w-full h-auto p-0 m-0 subtitle-1 text-black/[0.87] text-left truncate dark:text-white/[0.87] group-open:text-primary dark:group-open:text-black">
          {{ __('Users') }}
        </span>
      </x-list.text>
    </x-list.link>
  </x-list>

  <x-list class="pr-2 border-t border-solid border-chinese-white dark:border-dark-liver">
    <x-list.link class="rounded-r-full" href="" target="_blank">
      <x-list.text>
        <span class="block w-full h-auto p-0 m-0 subtitle-1 text-black/[0.87] text-left truncate dark:text-white/[0.87]">
          {{ __('Help Center') }}
        </span>
      </x-list.text>
    </x-list.link>

    <x-list.link class="rounded-r-full" href="" target="_blank">
      <x-list.text>
        <span class="block w-full h-auto p-0 m-0 subtitle-1 text-black/[0.87] text-left truncate dark:text-white/[0.87]">
          {{ __('Terms of Service') }}
        </span>
      </x-list.text>
    </x-list.link>

    <x-list.link class="rounded-r-full" href="" target="_blank">
      <x-list.text>
        <span class="block w-full h-auto p-0 m-0 subtitle-1 text-black/[0.87] text-left truncate dark:text-white/[0.87]">
          {{ __('Privacy Policy') }}
        </span>
      </x-list.text>
    </x-list.link>
  </x-list>
</x-offcanvas>
