const mix = require('laravel-mix');

mix.js('resources/js/app.tsx', 'public/js')
    .react();
