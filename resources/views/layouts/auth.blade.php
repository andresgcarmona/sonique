<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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
<div class="app h-screen w-screen">
    @include('layouts.includes.alerts')

    <main class="auth h-full flex flex-col justify-center items-center p-2">
        @yield('main')
    </main>
</div>
@include('auth.includes.scripts')
</body>
</html>
