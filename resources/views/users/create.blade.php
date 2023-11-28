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
            {{ __('Create') }}
          </x-breadcrumbs.text>
        </x-breadcrumbs>

        <x-card class="mt-4">
          <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" spellcheck="false" autocapitalize="off" data-te-validation-init>
            @csrf
            @method('POST')

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
                    {{ __('Create') }}
                  </h6>
                </div>
              </div>
            </x-card.header>

            <x-card.content class="border-y border-solid border-chinese-white dark:border-dark-liver sm:p-6">
              <div class="block w-full max-w-3xl h-auto p-0 m-0 relative">
                <div class="flex flex-col flex-grow-0 gap-0 w-full h-auto p-0 m-0 relative">

                  <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 mt-0 mb-6 relative sm:flex-row">
                    <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-6" data-te-validate="input" data-te-validation-ruleset="isNullable|isImage|isMimes(jpg,jpeg,png)">
                      <div class="block w-32 h-32 p-0 ml-0 mb-4 relative">
                        <div class="block w-auto h-auto p-0 m-0 relative">
                          <x-avatar class="!w-32 !h-32" src="{{ Vite::asset('resources/images/avatar.png') }}" alt="Current Avatar" data-te-container="avatar" />
                        </div>

                        <label class="block w-9 h-9 p-1.5 m-0 bg-primary rounded-full border-none text-white cursor-pointer outline-none absolute right-0 bottom-0 z-auto dark:text-black" role="button" tabindex="0">
                          <span class="block w-auto h-auto text-inherit p-0 m-0 relative">
                            <svg class="pointer-events-none w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                              <path d="M0 0h24v24H0z" fill="none" />
                              <circle cx="12" cy="12" r="3.2" />
                              <path d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z" />
                            </svg>
                          </span>
                          <input class="sr-only clip-path-inset-[50%]" type="file" name="avatar" accept=".jpg, .jpeg, .png" />
                        </label>
                      </div>

                      @error('avatar')
                        <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                          {{ $message }}
                        </span>
                      @else
                        <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
                      @enderror
                    </div>
                  </div>

                  <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 my-2 relative sm:flex-row">
                    <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-0" data-te-validate="input" data-te-validation-ruleset="isRequired|isString|isMin(3)|isMax(70)">
                      <div class="block w-auto h-auto p-0 mb-2 relative">
                        <x-forms.input label="Name *" id="name" name="name" value="{{ old('name') }}" autocomplete="off" spellcheck="false" autocapitalize="off" autofocus="true" />
                      </div>

                      @error('name')
                        <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                          {{ $message }}
                        </span>
                      @else
                        <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
                      @enderror
                    </div>
                  </div>

                  <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 mt-4 mb-2 relative sm:flex-row">
                    <span class="flex-1 inline-block w-full h-auto p-0 m-0 caption text-black/[0.60] truncate dark:text-white/[0.60]">
                      {{ __('Credentials') }}
                    </span>
                  </div>

                  <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 my-2 relative sm:flex-row">
                    <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-0" data-te-validate="input" data-te-validation-ruleset="isRequired|isEmail">
                      <div class="block w-auto h-auto p-0 mb-2 relative">
                        <x-forms.input label="Email *" id="email" name="email" value="{{ old('email') }}" type="email" autocomplete="off" spellcheck="false" autocapitalize="off" />
                      </div>

                      @error('email')
                        <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                          {{ $message }}
                        </span>
                      @else
                        <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
                      @enderror
                    </div>
                  </div>

                  <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 my-2 relative sm:flex-row">
                    <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-6/12 data-[te-validation-state='valid']:!mb-0" data-te-validate="input" data-te-validation-ruleset="isRequired|isString|isMin(8)|isMax(70)|isConfirmed(#password_confirmation)">
                      <div class="block w-auto h-auto p-0 mb-2 relative">
                        <x-forms.input label="Password *" id="password" name="password" value="" type="password" autocomplete="off" spellcheck="false" autocapitalize="off" />
                      </div>

                      @error('password')
                        <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                          {{ $message }}
                        </span>
                      @else
                        <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
                      @enderror
                    </div>

                    <div class="flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-6/12">
                      <div class="group block w-auto h-auto p-0 mb-2 relative">
                        <x-forms.input label="Confirm Password" id="password_confirmation" name="password_confirmation" value="" type="password" autocomplete="off" spellcheck="false" autocapitalize="off" />
                      </div>
                    </div>
                  </div>

                  <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 my-2 relative sm:flex-row">
                    <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-0" data-te-validate="input" data-te-validation-ruleset="isRequired|isString|isEnum(Administrator,Patient)">
                      <div class="block w-auto h-auto p-0 mb-2 relative">
                        <x-forms.select label="Role *" id="role" name="role">
                          @foreach (\App\Enums\Role::cases() as $key => $role)
                            <option value="{{ $role->value }}" @selected($key === 0)>
                              {{ ucwords(strtolower($role->name)) }}
                            </option>
                          @endforeach
                        </x-forms.select>
                      </div>

                      @error('role')
                        <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                          {{ $message }}
                        </span>
                      @else
                        <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
                      @enderror
                    </div>
                  </div>

                  <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 mt-4 mb-2 relative sm:flex-row">
                    <span class="flex-1 inline-block w-full h-auto p-0 m-0 caption text-black/[0.60] truncate dark:text-white/[0.60]">
                      {{ __('Contact') }}
                    </span>
                  </div>

                  <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 my-2 relative sm:flex-row">
                    <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-0" data-te-validate="input" data-te-validation-ruleset="isNullable|isString|isDigitsBetween(11,14)">
                      <div class="block w-auto h-auto p-0 mb-2 relative">
                        <x-forms.input label="Phone Number" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" type="tel" autocomplete="off" spellcheck="false" autocapitalize="off" />
                      </div>

                      @error('phone_number')
                        <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                          {{ $message }}
                        </span>
                      @else
                        <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
                      @enderror
                    </div>
                  </div>

                  <div class="hidden w-full p-0 m-0 list-none shadow-none !visible relative" id="collapse" data-te-collapse-item>
                    <div class="flex flex-col flex-grow-0 gap-0 w-full h-auto p-0 m-0 relative">
                      <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 mt-4 mb-2 relative sm:flex-row">
                        <span class="flex-1 inline-block w-full h-auto p-0 m-0 caption text-black/[0.60] truncate dark:text-white/[0.60]">
                          {{ __('Profile') }}
                        </span>
                      </div>

                      <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 my-2 relative sm:flex-row">
                        <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-0" data-te-validate="input" data-te-validation-ruleset="isNullable|isDate|isDateFormat(yyyy-mm-dd)|isBeforeOrEqual(today)">
                          <div class="block w-auto h-auto p-0 mb-2 relative">
                            <x-forms.datepicker label="Date of Birth" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" format="yyyy-mm-dd" autocomplete="off" spellcheck="false" autocapitalize="off" />
                          </div>

                          @error('date_of_birth')
                            <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                              {{ $message }}
                            </span>
                          @else
                            <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
                          @enderror
                        </div>
                      </div>

                      <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 my-2 relative sm:flex-row">
                        <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-0" data-te-validate="input" data-te-validation-ruleset="isNullable|isString|isEnum(Married,Divorced,Single)">
                          <div class="block w-auto h-auto p-0 mb-2 relative">
                            <x-forms.select label="Status" id="status" name="status">
                              @foreach (\App\Enums\MartialStatus::cases() as $key => $status)
                                <option value="{{ $status->value }}" @selected($key === 0)>
                                  {{ ucwords(strtolower($status->name)) }}
                                </option>
                              @endforeach
                            </x-forms.select>
                          </div>

                          @error('status')
                            <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                              {{ $message }}
                            </span>
                          @else
                            <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
                          @enderror
                        </div>
                      </div>

                      <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 my-2 relative sm:flex-row">
                        <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-0" data-te-validate="input" data-te-validation-ruleset="isNullable|isString|isMin(3)|isMax(255)|isRegex(^[-0-9A-Za-z.,\\/ ]+$)">
                          <div class="block w-auto h-auto p-0 mb-2 relative">
                            <x-forms.textarea label="Address" id="address" name="address" value="{{ old('address') }}" autocomplete="off" spellcheck="false" autocapitalize="off" />
                          </div>

                          @error('address')
                            <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                              {{ $message }}
                            </span>
                          @else
                            <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
                          @enderror
                        </div>
                      </div>

                      <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 mt-2 mb-2 relative sm:flex-row">
                        <span class="flex-1 inline-block w-full h-auto p-0 m-0 caption text-black/[0.60] truncate dark:text-white/[0.60]">
                          {{ __('Gender') }}
                        </span>
                      </div>

                      <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 mt-2 mb-4 relative sm:flex-row">
                        <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-0">
                          <div class="block w-auto h-auto p-0 mb-2 relative space-x-4">
                            @foreach(\App\Enums\Gender::cases() as $key => $gender)
                              <x-forms.radio label="{{ ucwords(strtolower($gender->name)) }}" id="{{ strtolower($gender->name) }}" name="gender" value="{{ $gender->value }}" checked="{{ $key === 0 }}" />
                            @endforeach
                          </div>

                          @error('gender')
                            <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                              {{ $message }}
                            </span>
                          @else
                            <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 m-0 relative sm:flex-row">
                    <div class="flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full">
                      <x-forms.button class="normal-case" variant="text" data-te-collapse-init data-te-target="#collapse" aria-expanded="false" aria-controls="collapse">
                        {{ __('Show more') }}
                      </x-forms.button>
                    </div>
                  </div>

                </div>
              </div>
            </x-card.content>

            <x-card.actions>
              <div class="flex-1 block w-full min-h-[36px] h-auto p-0 m-0 relative">
                <div class="flex justify-end items-center gap-4 w-full h-auto p-0 m-0 relative">
                  <x-forms.button type="reset" variant="text">
                    {{ __('Reset') }}
                  </x-forms.button>
                  <x-forms.button variant="text" data-te-submit-btn-ref>
                    {{ __('Submit') }}
                  </x-forms.button>
                </div>
              </div>
            </x-card.actions>

          </form>
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
