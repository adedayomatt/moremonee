const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/packages/dashkit/scss/theme.scss', 'public/css')
    .webpackConfig({
        output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
        resolve: {
            alias: {
                vue$: 'vue/dist/vue.runtime.esm.js',
                '@': path.resolve('resources/js'),
            },
        },
        module: {
            rules: [
                { test: /\.php$/, loader: 'ignore-loader' },
            ],
        },
    });
