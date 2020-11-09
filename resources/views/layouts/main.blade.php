<!DOCTYPE html>
<html lang="{{ config('sonique.locale') }}">
<head>
    @include('layouts.includes.head')
</head>
<body>
<!--[if lt IE 10]>
@if(strpos(app()->getLocale(), 'es') !== false)
    <div class="page-message" role="alert">Estás usando un navegador <strong>anticuado</strong>. Por favor<a class="alert-link" href="http://browsehappy.com/">actualiza tu navegador</a> para mejorar tu experiencia de usuario y tu seguridad.</div>
@else
    <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
@endif
        <![endif]-->
<div class="app w-full overflow-hidden">
    @include('layouts.includes.header')
    @include('layouts.includes.sidebar')

    <main class="app-main pl-16 min-h-screen relative pt-16 px-0 overflow-hidden">
        @include('layouts.includes.alerts')
        @yield('main')
    </main>
</div>

@include('layouts.includes.scripts')
</body>
</html>
