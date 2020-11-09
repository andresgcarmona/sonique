<meta property="og:title" content="@yield('title')">
<meta name="author" content="{{ config('stadium.author') }}">
<meta property="og:locale" content="{{ config('stadium.locale') }}">
<meta name="description" content="{{ config('stadium.description') }}">
<meta property="og:description" content="{{ config('stadium.description') }}">
<link rel="canonical" href="{{ url()->current() }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<script type="application/ld+json">
  {
    "name": "{{ config('app.name') }}",
    "description": "{{ config('sonique.description') }}",
    "author":
    {
      "@type": "Person",
      "name": "{{ config('sonique.author') }}"
    },
    "@type": "WebSite",
    "url": "",
    "headline": "@yield('title')",
    "@context": "http://schema.org"
  }


</script>
