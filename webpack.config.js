const Encore = require('@symfony/webpack-encore');
const webpack = require('webpack');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    //JS
    .addEntry('js/vendor/scroll', './Resources/assets/js/vendor/scroll.min.js')
    .addEntry('js/forum/app', './Resources/assets/js/forum/app.js')
    //CSS
    .addStyleEntry('css/forum/style', './Resources/assets/scss/forum/style.scss')
    .addStyleEntry('css/vendor/bootstrap', './Resources/assets/scss/bootstrap.scss')
    .addStyleEntry('css/vendor/font-awesome', './Resources/assets/scss/font-awesome/fontawesome.scss')

    .addPlugin(new webpack.ProvidePlugin({ Cookies: 'js-cookie/src/js.cookie.js' }))

    .createSharedEntry('js/vendor', [
        'jquery',
        'bootstrap',
        'jquery-toast-plugin'
    ])

    .enableSassLoader()
    .enablePostCssLoader((options) => {
         options.config = {
             path: 'config/postcss.config.js'
         };
    })
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())

    .enableVersioning(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
