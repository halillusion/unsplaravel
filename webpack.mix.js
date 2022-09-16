const path = require("path");
const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix
    .js('resources/js/app.js', 'public/js')
    .vue({ runtimeOnly: (process.env.NODE_ENV || 'production') === 'production' })
    .webpackConfig({
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "resources/js"),
            },
        },
        output: {
            chunkFilename: 'js/[name].js?id=[chunkhash]',
        }
    })
    .extract()
    .postCss('resources/css/app.css', 'public/css', [require("tailwindcss")])
    .version()
    .sourceMaps();