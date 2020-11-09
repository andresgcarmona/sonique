const mix         = require('laravel-mix')
const tailwindcss = require('tailwindcss')

mix.js('resources/js/app.js', 'public/js')
	.extract()

mix.sass('resources/sass/app.scss', 'public/css')
	.options({
		processCssUrls: false,
		postCss: [tailwindcss('tailwind.config.js')],
	})

mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/assets/vendor/fontawesome/css')
	.copy('node_modules/@fortawesome/fontawesome-free/webfonts/*', 'public/assets/vendor/fontawesome/webfonts')
	.copy('node_modules/perfect-scrollbar/dist/*', 'public/assets/vendor/perfect-scrollbar')
	.copy('node_modules/stacked-menu/dist/', 'public/assets/vendor/stacked-menu')

if(mix.inProduction()) {
	mix.purgeCss()
}

mix.version()
	.sourceMaps()
