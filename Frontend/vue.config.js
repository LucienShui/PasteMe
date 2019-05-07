const CompressionPlugin = require('compression-webpack-plugin');

let webPath = '/pasteme/';
console.log('Add:\n' +
    'location ' + webPath + ' {\n' +
    '    try_files $uri $uri/ ' + webPath + 'index.html;\n' +
    '}\n' +
    'to your nginx config file.');

module.exports = {
    publicPath: process.env.NODE_ENV === 'production' ? webPath : '/',
    outputDir: 'pasteme',
    productionSourceMap: false,
    configureWebpack: config => {
        if (process.env.NODE_ENV === 'production') {
            return {
                plugins: [new CompressionPlugin({
                    test: /\.js$|\.html$|\.css$|\.png/,
                    threshold: 10240,
                    deleteOriginalAssets: true,
                })],
            }
        }
    },
};