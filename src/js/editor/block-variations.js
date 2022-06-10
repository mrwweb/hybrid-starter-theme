/* ESLINT config: */
/* global wp */

/* Set Group to Inherit Layout by Default */
wp.blocks.registerBlockVariation(
	'core/group',
	{
		isDefault: true,
		attributes: {
			layout: {
				inherit: true,
			},
		},
	}
);

/* Adjust default Media & Text block*/
wp.blocks.registerBlockVariation(
	'core/media-text',
	{
		isDefault: true,
		attributes: {
			mediaPosition: 'right',
			imageFill: true,
			backgroundColor: 'primary',
			textColor: 'background',
		},
		innerBlocks: [
			[ 'core/paragraph' ],
		],
	}
);

/* Latest Posts */
wp.blocks.registerBlockVariation(
	'core/latest-posts',
	{
		isDefault: true,
		attributes: {
			displayPostContent: true,
			excerptLength: 50,
			displayPostDate: true,
			displayFeaturedImage: true,
			featuredImageSizeSlug: 'medium',
			addLinkToFeaturedImage: true,
		},
	}
);
