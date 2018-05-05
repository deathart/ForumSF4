const Encore = require('@symfony/webpack-encore');
const webpack = require('webpack');

Encore
    //Set all path
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    //Clean olds files
    .cleanupOutputBeforeBuild()
    //JS
    .addEntry('js/vendor/scroll', './resources/assets/js/vendor/scroll.min.js')
    .addEntry('js/forum/app', './resources/assets/js/forum/app.js')
    .addEntry('js/forum/auth', './resources/assets/js/forum/auth.js')
    //CSS
    .addStyleEntry('css/forum/style', './resources/assets/scss/forum/style.scss')
    .addStyleEntry('css/vendor/bootstrap', './resources/assets/scss/bootstrap.scss')
    .addStyleEntry('css/vendor/font-awesome', './resources/assets/scss/font-awesome/font-awesome.scss')
    //Add public
    .addPlugin(new webpack.ProvidePlugin({ Cookies: 'js-cookie/src/js.cookie.js' }))
    //Add shared
    .createSharedEntry('js/vendor', [
        'jquery',
        'bootstrap',
        'jquery-toast-plugin'
    ])
    //Set css settings
    .enableSassLoader()
    .enablePostCssLoader((options) => {
         options.config = {
             path: 'config/postcss.config.js'
         };
    })
    //Set babel
    .configureBabel(function(babelConfig) {
        babelConfig.presets.push('env');
    })
    //Makes jQuery available everywhere
    .autoProvidejQuery()
    //Set source maps
    .enableSourceMaps(!Encore.isProduction())
    //Set versioning
    .enableVersioning(Encore.isProduction())
    //Add Notifications
    .enableBuildNotifications()
;

module.exports = Encore.getWebpackConfig();
