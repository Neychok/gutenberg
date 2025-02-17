<?php
/**
 * Server-side rendering of the `core/cover` block.
 *
 * @package WordPress
 */

/**
 * Renders the `core/cover` block on server.
 *
 * @param array $attributes The block attributes.
 * @param array $content    The block rendered content.
 *
 * @return string Returns the cover block markup, if useFeaturedImage is true.
 */
function render_block_core_cover( $attributes, $content ) {
	if ( 'image' !== $attributes['backgroundType'] || false === $attributes['useFeaturedImage'] ) {
		return $content;
	}

	if ( ! ( $attributes['hasParallax'] || $attributes['isRepeated'] ) ) {
		$attr = array(
			'class'           => 'wp-block-cover__image-background',
			'data-object-fit' => 'cover',
		);

		if ( isset( $attributes['focalPoint'] ) ) {
			$object_position              = round( $attributes['focalPoint']['x'] * 100 ) . '%' . ' ' . round( $attributes['focalPoint']['y'] * 100 ) . '%';
			$attr['data-object-position'] = $object_position;
			$attr['style']                = 'object-position: ' . $object_position;
		}

		$image = get_the_post_thumbnail( null, 'post-thumbnail', $attr );

		$content = str_replace(
			'</span><div',
			'</span>' . $image . '<div',
			$content
		);

	} else {
		if ( in_the_loop() ) {
			update_post_thumbnail_cache();
		}
		$current_featured_image = get_the_post_thumbnail_url();

		$styles = 'background-image:url(' . esc_url( $current_featured_image ) . '); ';

		if ( isset( $attributes['minHeight'] ) ) {
			$height_unit = empty( $attributes['minHeightUnit'] ) ? 'px' : $attributes['minHeightUnit'];
			$height      = " min-height:{$attributes['minHeight']}{$height_unit}";

			$styles .= $height;
		}

		$content = preg_replace(
			'/class=\".*?\"/',
			'${0} style="' . $styles . '"',
			$content,
			1
		);
	}

	return $content;
}

/**
 * Registers the `core/cover` block renderer on server.
 */
function register_block_core_cover() {
	register_block_type_from_metadata(
		__DIR__ . '/cover',
		array(
			'render_callback' => 'render_block_core_cover',
		)
	);
}
add_action( 'init', 'register_block_core_cover' );
