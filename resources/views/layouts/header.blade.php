<header class="block w-full h-auto p-0 m-0 fixed top-0 right-0 z-20 lg:pl-64 lg:left-auto">
  <nav class="flex justify-between items-center w-full h-14 p-2 m-0 bg-primary shadow-04dp lg:h-16 dark:bg-charleston-green">
    <div class="flex justify-start items-center gap-2 w-auto h-auto p-0 m-0 overflow-hidden relative">
      <div class="inline-block w-auto h-auto p-0 m-0 relative">
        <x-offcanvas.trigger data-te-toggle="tooltip" title="Open menu">
          <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
            <path d="M0 0h24v24H0z" fill="none" />
            <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
          </svg>
        </x-offcanvas.trigger>
      </div>
    </div>

    <div class="flex-1 block w-auto h-auto p-0 m-0 overflow-hidden relative">
      <div class="block w-auto h-auto p-0 m-0 relative">
        <h6 class="block w-full h-auto px-2 py-1.5 m-0 headline-6 text-white truncate">
          @yield('title')
        </h6>
      </div>
    </div>

    <div class="flex justify-start items-center gap-2 w-auto h-auto p-0 m-0 overflow-hidden relative">
      <div class="inline-block w-auto h-auto p-0 m-0 relative">
        <form class="block w-auto h-auto p-0 m-0 relative" action="{{ route('logout') }}" method="POST">
          @csrf
          @method('POST')

          <x-dropdown>
            <x-dropdown.trigger class="!w-10 !h-10 p-2 text-white hover:bg-white/[0.04] active:bg-white/[0.10] focus:bg-white/[0.12]" data-te-toggle="tooltip" title="More options">
              <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                <path d="M0 0h24v24H0z" fill="none" />
                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
              </svg>
            </x-dropdown.trigger>

            <x-dropdown.list class="min-w-[192px] !shadow-04dp">
              <x-dropdown.link class="h-12 text-base" href="">
                <x-dropdown.text>
                  {{ __('Home') }}
                </x-dropdown.text>
              </x-dropdown.link>

              <x-dropdown.link class="h-12 text-base" href="">
                <x-dropdown.text>
                  {{ __('Edit Patient') }}
                </x-dropdown.text>
              </x-dropdown.link>

              <x-dropdown.button class="h-12 text-base" type="submit">
                <x-dropdown.text>
                  {{ __('Logout') }}
                </x-dropdown.text>
              </x-dropdown.button>
            </x-dropdown.list>
          </x-dropdown>
        </form>
      </div>
    </div>
  </nav>
</header>
