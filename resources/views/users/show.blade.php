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

          <x-breadcrumbs.link href="{{ route('users.index') }}">
            {{ __('Users') }}
          </x-breadcrumbs.link>

          <x-breadcrumbs.text>
            {{ $user->name }}
          </x-breadcrumbs.text>
        </x-breadcrumbs>

        <x-card class="mt-4">
          <x-card.header class="gap-4">
            <div class="flex justify-start items-center gap-2 w-auto h-auto p-0 m-0 overflow-hidden relative">
              <div class="inline-block w-auto h-auto p-0 m-0 relative">
                <x-icon-link href="{{ route('users.index') }}" data-te-toggle="tooltip" title="Back">
                  <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                  </svg>
                </x-icon-link>
              </div>
            </div>

            <div class="flex-1 block w-auto h-auto p-0 m-0 overflow-hidden relative">
              <div class="block w-full h-auto p-0 m-0 relative">
                <h6 class="block w-full h-auto px-2 py-1.5 m-0 headline-6 text-black/[0.87] truncate dark:text-white/[0.87]">
                  {{ __('View') }}
                </h6>
              </div>
            </div>

            <div class="flex justify-start items-center gap-2 w-auto h-auto p-0 m-0 overflow-hidden relative">
              <form class="contents w-auto h-auto p-0 m-0 relative" action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="inline-block w-auto h-auto p-0 m-0 relative">
                  <x-icon-link href="{{ route('users.edit', $user->id) }}" data-te-toggle="tooltip" title="Edit">
                    <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                      <path d="M0 0h24v24H0z" fill="none" />
                      <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                    </svg>
                  </x-icon-link>
                </div>

                <div class="inline-block w-auto h-auto p-0 m-0 relative">
                  <x-icon-button type="submit" data-te-toggle="tooltip" title="Delete">
                    <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                      <path d="M0 0h24v24H0z" fill="none" />
                      <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                    </svg>
                  </x-icon-button>
                </div>
              </form>
            </div>
          </x-card.header>

          <x-card.content class="border-t border-solid border-chinese-white dark:border-dark-liver sm:p-6">
            <div class="block w-full max-w-3xl h-auto p-0 m-0 relative">
              <div class="block w-32 h-32 p-0 mx-auto relative sm:ml-0">
                <div class="block w-auto h-auto p-0 m-0 relative">
                  <x-avatar class="!w-32 !h-32" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" />
                </div>
              </div>

              <x-list class="!py-0 mt-8">
                <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                  <x-list.text class="lg:basis-4/12">
                    <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ __('Name') }}
                    </span>
                  </x-list.text>

                  <x-list.text class="lg:basis-8/12">
                    <span class="block w-full h-auto p-0 m-0 body-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ $user->name }}
                    </span>
                  </x-list.text>
                </x-list.item>

                <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                  <x-list.text class="lg:basis-4/12">
                    <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ __('Email') }}
                    </span>
                  </x-list.text>

                  <x-list.text class="lg:basis-8/12">
                    <a class="inline-block w-auto h-auto p-0 m-0 body-2 text-primary no-underline cursor-pointer outline-none hover:underline focus:underline active:underline" href="mailto:{{ $user->email }}">
                      {{ $user->email }}
                    </a>
                  </x-list.text>
                </x-list.item>

                <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                  <x-list.text class="lg:basis-4/12">
                    <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ __('Role') }}
                    </span>
                  </x-list.text>

                  <x-list.text class="lg:basis-8/12">
                    <x-badge>
                      {{ $user->role  }}
                    </x-badge>
                  </x-list.text>
                </x-list.item>

                <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                  <x-list.text class="lg:basis-4/12">
                    <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ __('Phone Number') }}
                    </span>
                  </x-list.text>

                  <x-list.text class="lg:basis-8/12">
                    <span class="block w-full h-auto p-0 m-0 body-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ $user->phone_number ?? __('-') }}
                    </span>
                  </x-list.text>
                </x-list.item>

                <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                  <x-list.text class="lg:basis-4/12">
                    <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ __('Status') }}
                    </span>
                  </x-list.text>

                  <x-list.text class="flex items-center gap-2 lg:basis-8/12">
                    @if ($user->email_verified_at)
                      <x-badge size="small" color="success">
                        {{ __('Verified') }}
                      </x-badge>
                    @else
                      <x-badge size="small" color="warning">
                        {{ __('Unverified') }}
                      </x-badge>
                    @endif
                  </x-list.text>
                </x-list.item>

                <li class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                  <x-list class="hidden !py-0 !visible" id="collapse" data-te-collapse-item>
                    <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                      <x-list.text class="lg:basis-4/12">
                        <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                          {{ __('Date of Birth') }}
                        </span>
                      </x-list.text>

                      <x-list.text class="lg:basis-8/12">
                        <span class="block w-full h-auto p-0 m-0 body-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                          {{ $user->profile?->date_of_birth ?? __('-') }}
                        </span>
                      </x-list.text>
                    </x-list.item>

                    <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                      <x-list.text class="lg:basis-4/12">
                        <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                          {{ __('Address') }}
                        </span>
                      </x-list.text>

                      <x-list.text class="lg:basis-8/12">
                        <span class="block w-full h-auto p-0 m-0 body-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                          {{ $user->profile?->address ?? __('-') }}
                        </span>
                      </x-list.text>
                    </x-list.item>

                    <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                      <x-list.text class="lg:basis-4/12">
                        <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                          {{ __('Martial Status') }}
                        </span>
                      </x-list.text>

                      <x-list.text class="lg:basis-8/12">
                        <span class="block w-full h-auto p-0 m-0 body-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                          {{ $user->profile?->status ?? __('-') }}
                        </span>
                      </x-list.text>
                    </x-list.item>

                    <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                      <x-list.text class="lg:basis-4/12">
                        <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                          {{ __('Gender') }}
                        </span>
                      </x-list.text>

                      <x-list.text class="lg:basis-8/12">
                        <span class="block w-full h-auto p-0 m-0 body-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                          {{ $user->profile?->gender ?? __('-') }}
                        </span>
                      </x-list.text>
                    </x-list.item>
                  </x-list>
                </li>

                <x-list.item class="h-auto !px-0 !py-2">
                  <x-forms.button class="normal-case" variant="text" data-te-collapse-init data-te-target="#collapse" aria-expanded="false" aria-controls="collapse">
                    {{ __('Show more') }}
                  </x-forms.button>
                </x-list.item>

                <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                  <x-list.text class="lg:basis-4/12">
                    <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ __('Created At') }}
                    </span>
                  </x-list.text>

                  <x-list.text class="lg:basis-8/12">
                    <span class="block w-full h-auto p-0 m-0 body-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ $user->created_at }}
                    </span>
                  </x-list.text>
                </x-list.item>

                <x-list.item class="flex-col !gap-1 h-auto !px-0 py-4 border-b border-solid border-chinese-white dark:border-dark-liver lg:flex-row lg:!gap-8 lg:h-12 lg:py-3">
                  <x-list.text class="lg:basis-4/12">
                    <span class="block w-full h-auto p-0 m-0 subtitle-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ __('Updated At') }}
                    </span>
                  </x-list.text>

                  <x-list.text class="lg:basis-8/12">
                    <span class="block w-full h-auto p-0 m-0 body-2 text-black/[0.87] text-left leading-6 truncate dark:text-white/[0.87]">
                      {{ $user->updated_at }}
                    </span>
                  </x-list.text>
                </x-list.item>
              </x-list>
            </div>
          </x-card.content>
        </x-card>
      </div>
    </main>

    @include('layouts.footer')

  </div>
@endsection
