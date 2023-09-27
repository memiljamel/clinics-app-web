<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
  <link rel="icon" type="image/x-icon" href="/img/favicon.ico"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('styles')
</head>

<body>
  <noscript>You need to enable JavaScript to run this app.</noscript>
  @yield('content')
  @stack('scripts')
</body>

</html>
