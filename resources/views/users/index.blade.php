@extends('app')

@section('title', 'Users')

@section('content')
  <div class="flex flex-col w-full h-full p-0 m-0 relative">

    @include('layouts.header')

    @include('layouts.sidebar')

    <main class="block flex-grow flex-shrink-0 w-auto h-auto p-0 mt-14 ml-0 lg:mt-16 lg:ml-64">
      <div class="block w-full max-w-7xl h-auto p-4 mx-auto overflow-hidden xl:m-0">
        <x-breadcrumbs>
          <x-breadcrumbs.link href="">
            {{ __('Dashboard') }}
          </x-breadcrumbs.link>

          <x-breadcrumbs.text>
            {{ __('Users') }}
          </x-breadcrumbs.text>
        </x-breadcrumbs>

        @if (session()->has('message'))
          <x-toast>
            {{ session()->get('message') }}
          </x-toast>
        @endif

        <x-card class="mt-4">
          <x-card.header class="flex-wrap gap-2 min-h-[64px] !h-auto my-2 break-all sm:m-0">
            <div class="flex-1 block w-auto h-auto p-0 m-0 overflow-hidden relative basis-auto order-1 sm:order-none">
              <div class="block w-full h-auto p-0 m-0 relative">
                <h6 class="block w-full h-auto px-2 py-1.5 m-0 headline-6 text-black/[0.87] truncate dark:text-white/[0.87]">
                  {{ __('All Users') }}
                </h6>
              </div>
            </div>

            <div class="block w-auto h-auto p-0 mx-2 mt-2 overflow-hidden relative basis-full order-3 sm:basis-auto sm:order-none">
              <form class="block w-auto h-auto p-0 m-0 relative" action="{{ route('users.index') }}" method="GET" autocomplete="off" autocapitalize="off">
                <div class="block w-auto h-auto p-0 m-0 relative">
                   <x-forms.search name="search" value="{{ $search }}" placeholder="Search..." autocomplete="off" spellcheck="false" autocapitalize="off" />
                </div>
              </form>
            </div>

            <div class="flex justify-start items-center gap-2 w-auto h-auto p-0 m-0 overflow-hidden relative basis-auto order-2 sm:order-none">
              <div class="inline-block w-auto h-auto p-0 m-0 relative">
                <x-icon-link href="{{ route('users.create') }}" data-te-toggle="tooltip" title="Create">
                  <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                  </svg>
                </x-icon-link>
              </div>

              <div class="inline-block w-auto h-auto p-0 m-0 relative">
                <x-dropdown>
                  <x-dropdown.trigger class="!w-10 !h-10 p-2" data-te-toggle="tooltip" title="Download">
                    <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                      <path d="M0 0h24v24H0z" fill="none" />
                      <path d="M19 12v7H5v-7H3v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7h-2zm-6 .67l2.59-2.58L17 11.5l-5 5-5-5 1.41-1.41L11 12.67V3h2z" />
                    </svg>
                  </x-dropdown.trigger>

                  <x-dropdown.list>
                    <x-dropdown.link href="">
                      <x-dropdown.text>
                        {{ __('PDF') }}
                      </x-dropdown.text>
                    </x-dropdown.link>

                    <x-dropdown.link href="">
                      <x-dropdown.text>
                        {{ __('Excel') }}
                      </x-dropdown.text>
                    </x-dropdown.link>

                    <x-dropdown.link href="">
                      <x-dropdown.text>
                        {{ __('CSV') }}
                      </x-dropdown.text>
                    </x-dropdown.link>
                  </x-dropdown.list>
                </x-dropdown>
              </div>
            </div>
          </x-card.header>

          <x-card.content class="!p-0">
            <x-scrollbar data-te-suppress-scroll-y="true">
              <x-table>
                <x-table.head>
                  <x-table.row>
                    <x-table.th align="center">
                      {{ __('#') }}
                    </x-table.th>

                    <x-table.th>
                      {{ __('Photo') }}
                    </x-table.th>

                    <x-table.th>
                      {{ __('Name') }}
                    </x-table.th>

                    <x-table.th>
                      {{ __('Email') }}
                    </x-table.th>

                    <x-table.th>
                      {{ __('Photo Number') }}
                    </x-table.th>

                    <x-table.th align="center">
                      {{ __('Role') }}
                    </x-table.th>

                    <x-table.th align="center">
                      {{ __('Status') }}
                    </x-table.th>

                    <x-table.th align="center">
                      {{ __('Actions') }}
                    </x-table.th>
                  </x-table.row>
                </x-table.head>

                <x-table.body>
                  @forelse($users as $user)
                    <x-table.row>
                      <x-table.td align="center">
                        {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                      </x-table.td>

                      <x-table.td>
                        <x-avatar src="{{ $user->avatar_url }}" alt="{{ $user->name }}" />
                      </x-table.td>

                      <x-table.td>
                        {{ $user->name }}
                      </x-table.td>

                      <x-table.td>
                        <a class="inline-block w-auto h-auto p-0 m-0 text-primary no-underline cursor-pointer outline-none hover:underline focus:underline active:underline" href="mailto:{{ $user->email }}">
                          {{ $user->email }}
                        </a>
                      </x-table.td>

                      <x-table.td>
                        {{ $user->phone_number ?? __('-') }}
                      </x-table.td>

                      <x-table.td align="center">
                        <x-badge>
                          {{ $user->role  }}
                        </x-badge>
                      </x-table.td>

                      <x-table.td align="center">
                        @if ($user->email_verified_at)
                          <x-badge color="success">
                            {{ __('Verified') }}
                          </x-badge>
                        @else
                          <x-badge color="warning">
                            {{ __('Unverified') }}
                          </x-badge>
                        @endif
                      </x-table.td>

                      <x-table.td class="!overflow-visible" align="center">
                        <form class="inline-block w-auto h-auto p-0 m-0 relative" action="{{ route('users.destroy', $user->id) }}" method="POST">
                          @csrf
                          @method('DELETE')

                          <x-dropdown>
                            <x-dropdown.trigger>
                              <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                              </svg>
                            </x-dropdown.trigger>

                            <x-dropdown.list>
                              <x-dropdown.link href="{{ route('users.show', $user->id) }}">
                                <x-dropdown.icon>
                                  <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                  </svg>
                                </x-dropdown.icon>
                                <x-dropdown.text>
                                  {{ __('View') }}
                                </x-dropdown.text>
                              </x-dropdown.link>

                              <x-dropdown.link href="{{ route('users.edit', $user->id) }}">
                                <x-dropdown.icon>
                                  <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                  </svg>
                                </x-dropdown.icon>
                                <x-dropdown.text>
                                  {{ __('Edit') }}
                                </x-dropdown.text>
                              </x-dropdown.link>

                              <x-dropdown.button type="submit">
                                <x-dropdown.icon>
                                  <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"
                                    />
                                  </svg>
                                </x-dropdown.icon>
                                <x-dropdown.text>
                                  {{ __('Delete') }}
                                </x-dropdown.text>
                              </x-dropdown.button>
                            </x-dropdown.list>
                          </x-dropdown>
                        </form>
                      </x-table.td>
                    </x-table.row>
                  @empty
                    <x-table.row>
                      <x-table.td align="center" colspan="7">
                        {{ __('No data available.') }}
                      </x-table.td>
                    </x-table.row>
                  @endforelse
                </x-table.body>
              </x-table>
            </x-scrollbar>
          </x-card.content>

          <x-card.actions>
            <div class="flex-1 block w-full min-h-[36px] h-auto p-0 m-0 relative">
              {{ $users->onEachSide(2)->links() }}
            </div>
          </x-card.actions>
        </x-card>
      </div>
    </main>

    @include('layouts.footer')

  </div>
@endsection

@push('scripts')
  <script type="text/javascript">
    const errors = {{ Illuminate\Support\Js::from(array_keys($errors->toArray())) }};
  </script>
@endpush
