const basePath = 'P:\\_Sites\\coeursdechiens';
const { assertSupportedNodeVersion } = require(basePath + '/node_modules/laravel-mix/src/Engine');

module.exports = async () => {
    assertSupportedNodeVersion();

    const mix = require(basePath + '/node_modules/laravel-mix/src/Mix').primary;

    // disable manifest
    mix.manifest.refresh = _ => void 0

    mix.listen('init', function (mix) {
        // Setup Winter path aliases
        mix._api.alias({
            '$': 'P:\\_Sites\\coeursdechiens\\plugins',
            '~': 'P:\\_Sites\\coeursdechiens',
        });
        // disable notifications if not in watch
        mix._api.disableNotifications();
        // define options
        mix._api.options({
            processCssUrls: false,
            clearConsole: false,
            cssNano: {
                discardComments: {removeAll: true},
            }
        });
        // enable source maps for dev builds
        if (!mix._api.inProduction()) {
            mix._api.webpackConfig({
                devtool: 'inline-source-map'
            });
            mix._api.sourceMaps();
        }
    });

    // override default mix output
    mix.listen("loading-plugins", function (plugins) {
        plugins.forEach(function (plugin, index) {
            switch (plugin.constructor.name) {
                case "BuildOutputPlugin":
                    plugins[index].apply = function (compiler) {
                        compiler.hooks.done.tap('BuildOutputPlugin', stats => {
                            if (stats.hasErrors()) {
                                return false;
                            }

                            if (this.options.clearConsole) {
                                this.clearConsole();
                            }

                            let data = stats.toJson({
                                assets: true,
                                builtAt: true,
                                hash: true,
                                performance: true,
                                relatedAssets: this.options.showRelated
                            });

                            if (data.assets.length && !0) {
                                console.log(this.statsTable(data));
                            }
                        });
                    };
                    break;
                case "WebpackBarPlugin":
                    if (0) {
                        plugins[index].apply = _ => void 0;
                    }
                    break;
            }
        });
    });

    require('P:\\_Sites\\coeursdechiens\\plugins\\hounddd\\reviews\\winter.mix.js');

    await mix.installDependencies();
    await mix.init();

    return mix.build();
};
