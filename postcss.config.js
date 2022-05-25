module.exports = ( { env } ) => {
	const config = {
		plugins : {
			'postcss-import'     : {},
			'postcss-mixins'     : {},
			'postcss-nested'     : {},
			'postcss-preset-env' : {
				stage        : 0,
				autoprefixer : {
					grid : true,
				},
			},
		},
	};

	return config;
};
