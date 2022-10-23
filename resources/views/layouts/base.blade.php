<!doctype html>
 <html lang="en">
 <head>
 <meta charset="UTF-8">
 <title>@yield('title')</title>
 </head>
 <body>
@include('layouts.master')
@yield('body')
@include('partials.base')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
 </body>
 </html>