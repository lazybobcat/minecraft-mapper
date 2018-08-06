var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .addStyleEntry('css/app', [ './assets/sass/main.scss' ])
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .addEntry('js/app', [ './assets/js/app.js' ])
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
