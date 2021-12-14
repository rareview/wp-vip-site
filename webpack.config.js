const path = require( 'path' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const glob = require( 'glob' );
const OptimizeJS = require( 'terser-webpack-plugin' );
const OptimizeCSS = require( 'csso-webpack-plugin' ).default;
const ExtractCSS = require( 'mini-css-extract-plugin' );
const RemoveStyleJS = require( 'webpack-remove-empty-scripts' );
const { WebpackManifestPlugin } = require( 'webpack-manifest-plugin' );
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

const devMode = process.env.BUILD_MODEL !== 'release';
const suffix = devMode ? 'dev' : 'min';

const shared = {
	mode : devMode ? 'development' : 'production',

	cache : devMode,

	devtool : devMode ? 'source-map' : false,

	stats : devMode ? 'normal' : 'minimal',

	optimization : {
		minimize  : ! devMode,
		minimizer : [
			new OptimizeJS( { extractComments : true } ),
			new OptimizeCSS(),
		],
	},

	plugins : [
		new RemoveStyleJS(),
		new CleanWebpackPlugin( {
			cleanStaleWebpackAssets : false,
		} ),
		new ExtractCSS( {
			filename : `[name].css`,
		} ),
	],

	module : {
		rules : [
			{
				test    : /\.js$/,
				exclude : /node_modules/,
				use     : {
					loader  : 'babel-loader',
					options : {
						presets : [
							'@wordpress/default',
						],
					},
				},
			},

			{
				test : /\.css$/i,
				use  : [
					ExtractCSS.loader,
					{
						loader  : 'css-loader',
						options : {
							sourceMap : true,
							url       : false,
						},
					},
					{
						loader : 'postcss-loader',
					},
				],
			},
		],
	},
};

module.exports = [];
