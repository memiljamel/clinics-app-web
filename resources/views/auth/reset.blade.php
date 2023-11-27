@extends('app')

@section('title', 'Reset Password')

@section('content')
  <div class="flex flex-col w-full h-full p-0 m-0 relative sm:before:block sm:before:h-6 sm:before:min-h-[24px] sm:before:flex-grow sm:after:block sm:after:h-6 sm:after:min-h-[24px] sm:after:flex-grow">
    <div class="flex flex-col flex-shrink-0 w-full max-w-md min-h-screen h-auto p-0 mx-auto my-0 bg-white shadow-none rounded-none relative sm:block sm:min-h-0 sm:shadow-02dp sm:rounded-lg dark:bg-charleston-green">
      <form class="flex flex-col w-full h-full min-h-0 p-0 m-0 overflow-x-hidden overflow-y-auto outline-none relative sm:h-auto sm:min-h-[500px]" action="{{ route('reset.recovery') }}" method="POST" autocomplete="off" autocapitalize="off" data-te-validation-init>
        @csrf
        @method('POST')

        <div class="flex flex-col flex-grow-0 w-full h-auto p-4 m-0 relative lg:px-6">
          <div class="inline-block p-0 my-4 overflow-hidden relative">
            <img class="block w-12 h-auto p-0 mx-auto align-middle" src="{{ Vite::asset('resources/images/logo-app.png') }}" alt="Clinics App" />
            <span class="block w-full h-auto p-0 mt-3 headline-5 text-black/[0.87] text-center truncate dark:text-white">
              Reset your password
            </span>
          </div>
        </div>

        <div class="flex flex-col flex-grow-0 w-full h-auto p-4 m-0 relative lg:px-6">
          <input type="hidden" name="token" value="{{ $token }}" />

          <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 my-2 relative sm:flex-row">
            <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-2" data-te-validate="input" data-te-validation-ruleset="isRequired|isEmail">
              <div class="block w-auto h-auto p-0 mb-2 relative">
                <x-forms.input label="Email" id="email" name="email" value="{{ old('email') }}" type="email" autocomplete="off" spellcheck="false" autocapitalize="off" autofocus="true" />
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
            <div class="group flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full data-[te-validation-state='valid']:!mb-2" data-te-validate="input" data-te-validation-ruleset="isRequired|isString|isMin(8)|isMax(70)|isConfirmed(#password_confirmation)">
              <div class="block w-auto h-auto p-0 mb-2 relative">
                <x-forms.input label="New Password" id="password" name="password" value="" type="password" autocomplete="off" spellcheck="false" autocapitalize="off" />
              </div>

              @error('password')
                <span class="block w-full h-auto p-0 mb-2 text-xs tracking-normal text-error break-words" data-te-validation-feedback>
                  {{ $message }}
                </span>
              @else
                <span class="block w-full h-auto p-0 m-0 text-xs tracking-normal text-error break-words" data-te-validation-feedback></span>
              @enderror
            </div>
          </div>

          <div class="flex flex-col justify-between item-center gap-4 w-full h-auto p-0 mt-2 relative sm:flex-row">
            <div class="flex-1 inline-block w-full h-auto p-0 m-0 relative sm:basis-full">
              <div class="block w-auto h-auto p-0 mb-2 relative">
                <x-forms.input label="Confirm New Password" id="password_confirmation" name="password_confirmation" value="" type="password" autocomplete="off" spellcheck="false" autocapitalize="off" />
              </div>
            </div>
          </div>
        </div>

        <div class="flex flex-col flex-grow-0 w-full h-auto px-4 my-2 relative lg:px-6">
          <div class="block w-full max-w-3xl h-auto p-0 my-0 relative">
            <x-forms.button class="w-full" data-te-submit-btn-ref>
              Reset Password
            </x-forms.button>
          </div>
        </div>

        <div class="flex flex-col flex-grow w-full min-h-[56px] h-auto p-4 m-0 relative lg:px-6">
          <div class="block w-auto h-auto p-0 m-0 absolute left-1/2 bottom-4 -translate-x-1/2 z-auto">
            <span class="inline-block w-auto h-auto p-0 m-0 caption text-black/[0.60] align-middle whitespace-nowrap dark:text-white/[0.60]">
              &copy {{ config('app.name', 'Laravel') }} {{ now()->year }}, All rights reserved.
            </span>
          </div>
        </div>

      </form>
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript">
    const errors = {{ Illuminate\Support\Js::from(array_keys($errors->toArray())) }};
  </script>
@endpush
