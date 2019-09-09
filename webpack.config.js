var Encore = require('@symfony/webpack-encore');
var path = require('path');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .addEntry('app', './assets/js/app.js')
  .autoProvidejQuery()
  .splitEntryChunks()
  .enableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning()
  .configureBabel(() => {}, {
    useBuiltIns: 'usage',
    corejs: 3
  })
  .enableSassLoader(function(sassOptions) {}, {
    resolveUrlLoader: false
  })
  .enablePostCssLoader((options) => {
    options.config = {
      path: 'config/postcss.config.js'
    };
  })
;

var config = Encore.getWebpackConfig();

config.resolve.alias = {
  'jquery-ui/ui/widget': path.resolve(__dirname, 'node_modules/jquery.ui.widget/jquery.ui.widget.js'),
  'load-image': path.resolve(__dirname, 'node_modules/blueimp-load-image/js/load-image.js'),
  'load-image-exif': path.resolve(__dirname, 'node_modules/blueimp-load-image/js/load-image-exif.js'),
  'load-image-scale': path.resolve(__dirname, 'node_modules/blueimp-load-image/js/load-image-scale.js'),
  'load-image-meta': path.resolve(__dirname, 'node_modules/blueimp-load-image/js/load-image-meta.js')
};

module.exports = config;
