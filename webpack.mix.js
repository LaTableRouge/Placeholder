const mix = require('laravel-mix')

require('laravel-mix-webp')

const isProduction = mix.inProduction()
/*
|--------------------------------------------------------------------------
| Theme config
|--------------------------------------------------------------------------
|
| Url (for browserSync)
| Theme name
| Assets path
| Assets destination path
 | Array of files to apply versionning
 | Array of files to apply cleaning
 | Array of files to be watched
 |
 */
const assetsPath = './assets'
const distPath = !isProduction ? assetsPath : './dist/assets'

/*
 |--------------------------------------------------------------------------
 | Minify pictures
 |--------------------------------------------------------------------------
 |
 | Minify pictures into webp
 |
 */
mix
  .options({
    manifest: false
  }).ImageWebp({
    disable: false,
    from: `${assetsPath}/img`,
    to: `${distPath}/img/`,
    imageminWebpOptions: {
      quality: 50
    }
  })

// Notification
mix.disableNotifications()
