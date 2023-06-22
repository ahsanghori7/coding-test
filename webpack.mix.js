const mix = require('laravel-mix');

mix.js('resources/js/app.tsx', 'public/js')
    .react()
    .webpackConfig({
        resolve: {
            extensions: ['*', '.wasm', '.mjs', '.js', '.jsx', '.json']
        }
    });