let mix = require('laravel-mix');
let SWPrecacheWebpackPlugin = require('sw-precache-webpack-plugin');

mix.js('resources/assets/js/app.js', 'public/js').version();
mix.js('resources/assets/js/push_message.js', 'public/js');
mix.js('resources/assets/js/bootstrap.bundle.js', 'public/js');
mix.copy('resources/assets/images/icons', 'public/images/icons');
mix.copy('resources/assets/sounds', 'public/sounds');
mix.sass('resources/assets/sass/app.scss', 'public/css').version();

mix.webpackConfig({
    plugins: [
        new SWPrecacheWebpackPlugin({
            cacheId: 'farm-attacks',
            filename: 'service-worker.js',
            staticFileGlobs: ['public/**/*.{css,eot,svg,ttf,woff,woff2,js,html}'],
            minify: false,
            stripPrefix: 'public/',
            handleFetch: true,
            dynamicUrlToDependencies: {
                '/': ['resources/views/index.blade.php']
            },
            staticFileGlobsIgnorePatterns: [/\.map$/, /mix-manifest\.json$/, /manifest\.json$/, /service-worker\.js$/],
            runtimeCaching: [
                {
                    urlPattern: /^https:\/\/fonts\.googleapis\.com\//,
                    handler: 'cacheFirst'
                },
                {
                    urlPattern: /^https:\/\/ajax\.googleapis\.com\//,
                    handler: 'cacheFirst'
                }
            ],
            importScripts: ['./js/push_message.js']
        })
    ]
});
