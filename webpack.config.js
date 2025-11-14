const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const WorkboxPlugin = require('workbox-webpack-plugin');
const ReactRefreshWebpackPlugin = require('@pmmmwh/react-refresh-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const isDev = process.env.NODE_ENV === 'development';

const JS_DIR = path.resolve(__dirname, 'src/js');
const IMG_DIR = path.resolve(__dirname, 'src/img');
const LIB_DIR = path.resolve(__dirname, 'src/library');
const BUILD_DIR = path.resolve(__dirname, 'build');
const SRC_DIR = path.resolve(__dirname, 'src');

module.exports = {
  entry: {
    public: path.resolve(JS_DIR, 'public.js'),
    admin: path.resolve(JS_DIR, 'admin.js'),
    editor: path.resolve(JS_DIR, 'editor.js'),
  },
  output: {
    clean: true,
    // libraryTarget: 'var',
    filename: 'js/[name].js',
    path: path.resolve(__dirname, 'dist'),
    chunkFilename: 'js/[name].[contenthash].js',
  },
  mode: isDev ? 'development' : 'production',
  devtool: isDev ? 'source-map' : false,
  resolve: {

    extensions: ['.js', '.jsx', '.json'],
    alias: {
      '@library': path.resolve(__dirname, 'src/library'),
      '@icons': path.resolve(__dirname, 'src/icons'),
      '@sass': path.resolve(__dirname, 'src/sass'),
      '@img': path.resolve(__dirname, 'src/img'),
      '@js': path.resolve(__dirname, 'src/js'),
    },
    fallback: {
      fs: false
    }
  },
  devServer: {
    hot: true,
    historyApiFallback: true,
    static: {
      directory: path.resolve(__dirname, 'dist'),
    },
    port: 3000,
    open: true
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/,
        exclude: /node_modules/,
        use: [
          {
            loader: 'babel-loader',
            options: {
              presets: [
                ['@babel/preset-env', { targets: { browsers: ['>0.25%', 'not dead'] } }],
                ['@babel/preset-react', { runtime: 'automatic' }],
              ],
              plugins: [
                '@babel/plugin-syntax-dynamic-import',
                isDev && require.resolve('react-refresh/babel')
              ].filter(Boolean),
            },
          },
        ].filter(Boolean),
      },
      {
        test: /\.mjs$/,
        type: 'javascript/auto',
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          isDev ? 'style-loader' : MiniCssExtractPlugin.loader,
          'css-loader',
          'postcss-loader',
          'sass-loader',
        ],
      },
      {
        test: /\.(ico|png|jpe?g|gif|svg|webp)$/i,
        type: 'asset/resource',
        generator: {
          filename: 'images/[name][ext]',
          // filename: 'images/[hash][ext][query]',
        },
      },
      {
        test: /\.(woff2?|eot|ttf|otf)$/,
        type: 'asset/resource',
        generator: {
          filename: 'fonts/[hash][ext][query]',
        },
      },
    ],
  },
  plugins: [
    new CleanWebpackPlugin(),
    !isDev && new MiniCssExtractPlugin({
      filename: 'css/[name].css',
    }),
    isDev && new ReactRefreshWebpackPlugin(),
    new CopyPlugin({
      patterns: [
        { from: LIB_DIR, to: path.resolve(__dirname, 'dist/library') },
        { from: path.resolve(SRC_DIR, 'icons'), to: path.resolve(__dirname, 'dist/icons') },
        { from: path.resolve(SRC_DIR, 'icons'), to: path.resolve(__dirname, 'dist/icons') },
      ],
    })
  ].filter(Boolean),

};