@section('scripts')
    <!-- BEGIN PLUGINS JS -->
    @mix('/js/manifest.js')
    @mix('/js/vendor.js')

    <script src="/assets/vendor/pace/pace.min.js"></script>
    <script src="/assets/vendor/stacked-menu/js/stacked-menu.min.js"></script>
    <script src="/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://sdk.scdn.co/spotify-player.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    @env('production')
        <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
        <script>
            window.dataLayer = window.dataLayer || []

            function gtag() {
                dataLayer.push(arguments)
            }

            gtag('js', new Date())
            gtag('config', 'UA-116692175-1')
        </script>
    @endenv
@show
