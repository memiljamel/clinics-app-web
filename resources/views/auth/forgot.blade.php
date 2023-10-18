@extends('app')

@section('title', 'Forgot Password')

@section('content')
  <div class="flex flex-col w-full h-full p-0 m-0 relative sm:before:block sm:before:h-6 sm:before:min-h-[24px] sm:before:flex-grow sm:after:block sm:after:h-6 sm:after:min-h-[24px] sm:after:flex-grow">
    <div class="flex flex-col flex-shrink-0 w-full max-w-md min-h-screen h-auto p-0 mx-auto my-0 bg-white shadow-none border-0 border-none rounded-lg relative sm:block sm:min-h-0 sm:shadow-02dp sm:border dark:bg-charleston-green">
      <form class="flex flex-col w-full h-full min-h-0 p-0 m-0 overflow-x-hidden overflow-y-auto outline-none relative sm:h-auto sm:min-h-[500px]" action="{{ route('forgot.send') }}" method="POST" autocomplete="off" autocapitalize="off">
        @csrf
        @method('POST')

        <div class="flex flex-col flex-grow-0 w-full h-auto p-4 m-0 relative lg:px-6">
          <div class="inline-block p-0 my-4 overflow-hidden relative">
            <img class="block w-12 h-auto p-0 mx-auto align-middle" src="{{ Vite::asset('resources/images/logo-app.png') }}" alt="Clinics App" />
            <span class="block w-full h-auto p-0 mt-3 headline-5 text-black/[0.87] text-center truncate dark:text-white">
              Find your account
            </span>
          </div>
        </div>

        @if (session()->has('message'))
          <x-toast>
            {{ session()->get('message') }}
          </x-toast>
        @endif

        <div class="flex flex-col flex-grow-0 w-full h-auto p-4 m-0 relative lg:px-6">
          <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mt-2 relative sm:flex-nowrap">
            <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-full">
              <x-forms.input label="Email" id="email" name="email" value="{{ old('email') }}" type="email" autocomplete="off" spellcheck="false" autocapitalize="off" autofocus="true" />
            </div>
          </div>
        </div>

        <div class="flex flex-col flex-grow-0 w-full h-auto px-4 my-2 relative lg:px-6">
          <div class="block w-full max-w-3xl h-auto p-0 my-0 relative">
            <x-forms.button class="w-full" type="submit">
              Send Password Reset Link
            </x-forms.button>
          </div>
        </div>

        <div class="flex flex-col flex-grow w-full min-h-[56px] h-auto p-4 m-0 relative lg:px-6">
          <div class="block w-auto h-auto p-0 m-0 absolute left-1/2 bottom-4 -translate-x-1/2 z-auto">
            <span class="inline-block w-auto h-auto p-0 m-0 caption text-black/[0.60] align-middle whitespace-nowrap dark:text-white/[0.60]">
              &copy Clinics App {{ now()->year }}, All rights reserved.
            </span>
          </div>
        </div>

      </form>
    </div>
  </div>
@endsection
