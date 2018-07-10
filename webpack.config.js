/* global process __dirname */

const path      = require('path');
const fs        = require('fs');
const webpack   = require('webpack');
const context   = path.join(__dirname);
const npmConfig = JSON.parse(fs.readFileSync('./package.json')).config;

const inProduction = process.env.NODE_ENV === 'production';
const env = inProduction ? 'production' : 'development';

const config = {
    context: context
};

config.mode = 'development';

config.watch = false;

config.module = {
    rules: [
        {
            test: /\.jsx?$/,
            exclude: /(node_modules|bower_components)/,
            loader: 'babel-loader',
            options: {
                presets: [
                    [ 'es2015', { modules: false } ]
                ],
            }
        },
        {
            test: /\.tsx?$/,
            exclude: /(node_modules|bower_components)/,
            use: [
                {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            [ 'es2015', { modules: false } ]
                        ]
                    }
                },
                {
                    loader: 'ts-loader'
                }
            ]
        }
    ]
};

config.resolve = {
    modules: [
        path.resolve(`${npmConfig.assetSource}scripts`),
        'node_modules',
        'bower_components'
    ],
    alias: {
        'babylon-grid': 'babylon-grid/dist/jquery.babylongrid.js'
    },
    extensions: ['.js', '.jsx', '.ts', '.tsx', '.vue', '.json']
};


config.externals ={
    'jquery': 'jQuery'
};

config.devtool = inProduction ? '#source-map' : '#eval-source-map';

const providePlugin = new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery'
});

const envProcess = new webpack.DefinePlugin({
    'process.env.NODE_ENV': JSON.stringify(env)
});

const loaderOptions = new webpack.LoaderOptionsPlugin({
    minimize: true
});

const aggressiveMerging = new webpack.optimize.AggressiveMergingPlugin();

config.plugins = [
    providePlugin,
    envProcess
];


module.exports = config;
