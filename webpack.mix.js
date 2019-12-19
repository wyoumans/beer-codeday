let mix = require('laravel-mix');

const tailwindcss = require('tailwindcss')

require('laravel-mix-purgecss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix

    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [
            tailwindcss('./tailwind.config.js'),
        ]
    })

    .copyDirectory('resources/fonts', 'public/fonts')
    .copyDirectory('resources/images', 'public/images')

    .purgeCss({
        extensions: [
            'html', 'js', 'jsx', 'ts',
            'tsx', 'php', 'vue', 'svg'
        ],

        // classes only used in vue conditional class bindings
        // must be explicitely whitelisted
        whitelistPatterns: [
        ],
    })

    .version()

    .sourceMaps()

    .browserSync('local.beer.com');
