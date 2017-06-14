<meta charset="utf-8">

<!-- SEO Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="{{ \Easel\Models\Settings::blogSeo() }}">
<meta name="author" content="{{ \Easel\Models\Settings::blogAuthor() }}">
<meta name="description" content="{{ \Easel\Models\Settings::blogDescription() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('vendor/canvas/assets/images/favicon.png') }}">

<!-- Facebook Open Graph Tags -->
@yield('og-title')
@yield('og-image')
@yield('og-description')
<meta name="og:type" content="blog">
<meta name="og:site_name" content="{{ \Easel\Models\Settings::blogTitle() }}">

<!-- Twitter Cards -->
@if (Request::is('blog/*'))
    @yield('twitter-card')
@else
    <meta name="twitter:site" content="{{ $user->twitter or ''}}" />
    <meta name="twitter:title" content="{{ \Easel\Models\Settings::blogTitle() }}" />
    <meta name="twitter:card" content="{{ \Easel\Models\Settings::twitterCardType() }}" />
    <meta name="twitter:image" content="{{ url('vendor/canvas/assets/images/favicon.png') }}" />
    <meta name="twitter:description" content="{{ \Easel\Models\Settings::blogDescription() }}" />
@endif
