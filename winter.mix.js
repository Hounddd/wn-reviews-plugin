const mix = require('laravel-mix');
const PACKAGE = require('./package.json');

require('laravel-mix-banner');

/*
 |--------------------------------------------------------------------------
 | Usefull functions
 |--------------------------------------------------------------------------
 */
    Date.prototype.getBuild = function () {
        let mm = this.getMonth() + 1;
        let dd = this.getDate();
        let hours = this.getHours();
        let mins = this.getMinutes();
        let secs = this.getSeconds();

        return [this.getFullYear(),
        (mm > 9 ? '' : '0') + mm,
        (dd > 9 ? '' : '0') + dd,
            '-',
        (hours > 9 ? '' : '0') + hours,
        (mins > 9 ? '' : '0') + mins,
        (secs > 9 ? '' : '0') + secs,
        ].join('');
    };

// For assets in the current directory
mix.setPublicPath(__dirname);


// Render Tailwind style
mix
    .sass('assets/scss/reviews.scss', 'assets/css')
    .sass('assets/vendors/tinyslider/scss/styles.scss', 'assets/vendors/tinyslider/css')
    .sass('formwidgets/starrating/assets/scss/starrating.scss', 'formwidgets/starrating/assets/css')
    .options({
        processCssUrls: false,

        terser: {
            extractComments: false,   // Stop Mix from generating license file
            // sourceMap: false,
            parallel: true,
            terserOptions: {
                // compress: {},
                format: {
                    comments: /^\**!|@preserve|@license|@cc_on/i
                },
            },
        },

        postCss: [
            require('postcss-nested-ancestors'),
            require('postcss-nested'),
            require('postcss-import'),
            require('tailwindcss'),
            require('autoprefixer'),
        ],
    });

if (mix.inProduction()) {

    mix.banner({
        banner: (function () {
            var authorLines = PACKAGE.authors;
            authorLines.forEach(function (author, index, myArr) {
                myArr[index] = ' * %name% - %company% (%url%)'.replace('%name%', author.name)
                    .replace('%company%', author.company)
                    .replace('%url%', author.url)
            });

            return [
                '/*!',
                ' * ' + PACKAGE.name + ' - ' + PACKAGE.version + ' - ' + new Date().getBuild(),
                ' * ' + PACKAGE.description,
                ' *',
                authorLines.join('\n'),
                ' *',
                ' * filebase: [base] - hash: [fullhash]',
                ' */',
                '',
            ].join('\n');
        })(),
        raw: true,
    });

    mix.version();
}
