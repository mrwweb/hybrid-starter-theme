/* ESLINT config: */
/* global wp */

/* Adjust default Media & Text block*/
wp.blocks.registerBlockVariation(
	'core/media-text',
	{
		isDefault: true,
		attributes: {
			mediaPosition: 'right',
			imageFill: true
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
