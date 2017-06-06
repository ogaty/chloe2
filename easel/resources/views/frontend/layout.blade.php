<!DOCTYPE html>
<html lang="ja">
    <head>
        @include('canvas::frontend.shared.partials.meta')
        @include('canvas::frontend.shared.partials.css')
        @include('canvas::frontend.shared.partials.user-generated-css')
    </head>
    <body>
        @include('canvas::frontend.shared.partials.header')
        @yield('content')
        @yield('unique-js')
        @include('canvas::frontend.shared.partials.user-generated-js')
        @include('canvas::frontend.shared.partials.footer')
    </body>
</html>
