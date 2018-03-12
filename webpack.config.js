// webpack.config.js
var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // will create public/build/app.js and public/build/app.css
   .addEntry('app', './assets/js/app.js')
   .addEntry('global', './assets/js/global.js')
  
   
   // .addEntry('page1', 'assets/js/page1.js')
   // .addEntry('page2', 'assets/js/page2.js')

    // this creates a 'vendor.js' file with jquery and the bootstrap JS module
    // these modules will *not* be included in page1.js or page2.js anymore
    .createSharedEntry('vendor', [
        'jquery',
        'bootstrap',
        'select2'
        // you can also extract CSS - this will create a 'vendor.css' file
        // this CSS will *not* be included in page1.css or page2.css anymore
        
       // 'bootstrap-sass/assets/stylesheets/_bootstrap.scss'
    ])

    // allow sass/scss files to be processed
   .enableSassLoader(function(sassOptions) {}, {
         resolveUrlLoader: false
     })
    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    // create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning()
;

// export the final configuration
module.exports = Encore.getWebpackConfig();
