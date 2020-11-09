<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- End required meta tags -->

<!-- Begin SEO tag -->
<title>@yield('title', config('app.name'))</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

@include('layouts.includes.metadata')


@env('production')
    <script type="text/js" async="" src="https://www.google-analytics.com/analytics.js"></script>
@endenv

{{--@include('layouts.includes.icons')--}}

<!-- Theme color -->
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="/images/mstile-144x144.png">
<meta name="theme-color" content="#3063A0">
<!-- End theme color -->

<link rel="manifest" href="/manifest.json">

@style('/assets/vendor/stacked-menu/css/stacked-menu.min.css')
@style('/assets/vendor/fontawesome/css/all.min.css')

@yield('head')

@mix('css/app.css')

@env('production')
    <script>
		if('serviceWorker' in navigator) {
			window.addEventListener('load', function() {
				navigator.serviceWorker.register('/sw.js').then(function(registration) {
					// Registration was successful
					console.log('ServiceWorker registration successful with scope: ', registration.scope)
				}, function(err) {
					// registration failed :(
					console.log('ServiceWorker registration failed: ', err)
				})
			})
		}
    </script>
@endenv

@stack('scripts')
