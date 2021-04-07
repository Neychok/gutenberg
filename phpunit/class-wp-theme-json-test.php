<?php

/**
 * Test WP_Theme_JSON class.
 *
 * @package Gutenberg
 */

class WP_Theme_JSON_Test extends WP_UnitTestCase {

	function test_get_settings_v0() {
		$defaults = WP_Theme_JSON_Schema_V0::ALL_BLOCKS_NAME;
		$root     = WP_Theme_JSON_Schema_V0::ROOT_BLOCK_NAME;
		$theme_json = new WP_Theme_JSON(
			array(
				'settings' => array(
					$defaults => array(
						'color' => array(
							'customGradient' => false,
							'palette' => array(
								array(
									'slug'  => 'white',
									'color' => 'white',
								),
								array(
									'slug'  => 'black',
									'color' => 'black',
								),
							),
						),
					),
					$root => array(
						'color'       => array(
							'custom' => false,
							'palette' => array(
								array(
									'slug' => 'grey',
									'color' => 'grey',
								),
							),
						),
						'invalid/key' => 'value',
					),
					'core/heading/h1' => array(
						'color' => array(
							'customGradient' => false,
							'palette' => array(
								array(
									'slug'  => 'white',
									'color' => 'white',
								),
								array(
									'slug'  => 'black',
									'color' => 'black',
								),
							),
						),
					),
					'core/heading/h2' => array(
						'color' => array(
							'custom'  => false,
							'palette' => array(
								array(
									'slug'  => 'grey',
									'color' => 'grey',
								),
							),
						),
					),
					'core/post-title/h1' => array(
						'color' => array(
							'customGradient' => false,
							'palette' => array(
								array(
									'slug'  => 'white',
									'color' => 'white',
								),
								array(
									'slug'  => 'black',
									'color' => 'black',
								),
							),
						),
					),
					'core/post-title/h2' => array(
						'color' => array(
							'custom'  => false,
							'palette' => array(
								array(
									'slug'  => 'grey',
									'color' => 'grey',
								),
							),
						),
					),
					'core/query-title/h1' => array(
						'color' => array(
							'customGradient' => false,
							'palette' => array(
								array(
									'slug'  => 'white',
									'color' => 'white',
								),
								array(
									'slug'  => 'black',
									'color' => 'black',
								),
							),
						),
					),
					'core/query-title/h2' => array(
						'color' => array(
							'custom'  => false,
							'palette' => array(
								array(
									'slug'  => 'grey',
									'color' => 'grey',
								),
							),
						),
					),
				),
				'styles'   => array(
					$root_name => array(
						'color' => array(
							'link' => 'blue',
						),
					),
				),
			)
		);

		$actual = $theme_json->get_settings();

		$expected = array(
			'color' => array(
				'custom' => false,
				'customGradient' => false,
				'palette' => array(
					array(
						'slug'  => 'grey',
						'color' => 'grey',
					)
				),
			),
			'blocks' => array(
				'core/heading' => array(
					'color' => array(
						'customGradient' => false,
						'custom'         => false,
						'palette'        => array(
							array(
								'slug'  => 'grey',
								'color' => 'grey',
							)
						),
					),
				),
				'core/post-title' => array(
					'color' => array(
						'customGradient' => false,
						'custom'         => false,
						'palette'        => array(
							array(
								'slug'  => 'grey',
								'color' => 'grey',
							)
						),
					),
				),
				'core/query-title' => array(
					'color' => array(
						'customGradient' => false,
						'custom'         => false,
						'palette'        => array(
							array(
								'slug'  => 'grey',
								'color' => 'grey',
							)
						),
					),
				),
			),
		);

		$this->assertEqualSetsWithIndex( $expected, $actual );
	}

	function test_get_settings() {
		$theme_json = new WP_Theme_JSON(
			array(
				'version'  => 1,
				'settings' => array(
					'color'       => array(
						'custom' => false,
					),
					'invalid/key' => 'value',
					'blocks' => array(
						'core/group' => array(
							'color'       => array(
								'custom' => false,
							),
							'invalid/key' => 'value',
						),
					),
				),
				'styles'   => array(
					'color' => array(
						'link' => 'blue',
					),
				),
			)
		);

		$actual = $theme_json->get_settings();

		$expected = array(
			'color' => array(
				'custom' => false,
			),
			'blocks' => array(
				'core/group' => array(
					'color' => array(
						'custom' => false,
					),
				),
			),
		);

		$this->assertEqualSetsWithIndex( $expected, $actual );
	}

	function test_get_stylesheet_v0() {
		$root_name       = WP_Theme_JSON_Schema_V0::ROOT_BLOCK_NAME;
		$all_blocks_name = WP_Theme_JSON_Schema_V0::ALL_BLOCKS_NAME;

		$theme_json = new WP_Theme_JSON(
			array(
				'settings' => array(
					$all_blocks_name => array(
						'color'      => array(
							'text'    => 'value',
							'palette' => array(
								array(
									'slug'  => 'white',
									'color' => 'white',
								),
								array(
									'slug'  => 'black',
									'color' => 'black',
								),
							),
						),
						'typography' => array(
							'fontFamilies' => array(
								array(
									'slug'       => 'small',
									'fontFamily' => '14px',
								),
								array(
									'slug'       => 'big',
									'fontFamily' => '41px',
								),
							),
						),
						'misc'       => 'value',
					),
					$root_name => array(
						'color'      => array(
							'palette' => array(
								array(
									'slug'  => 'grey',
									'color' => 'grey',
								),
							),
						),
					),
					'core/group'     => array(
						'custom' => array(
							'base-font'   => 16,
							'line-height' => array(
								'small'  => 1.2,
								'medium' => 1.4,
								'large'  => 1.8,
							),
						),
					),
				),
				'styles'   => array(
					$root_name   => array(
						'color' => array(
							'link' => '#111',
							'text' => 'var:preset|color|grey',
						),
						'misc'  => 'value',
					),
					'core/group' => array(
						'color'   => array(
							'link' => '#333',
						),
						'spacing' => array(
							'padding' => array(
								'top'    => '12px',
								'bottom' => '24px',
							),
						),
					),
					'core/heading/h1' => array(
						'color' => array(
							'link' => '#111',
						),
						'typography' => array(
							'fontSize' => '1em'
						)
					),
					'core/heading/h2' => array(
						'color' => array(
							'link' => '#222',
						),
						'typography' => array(
							'fontSize' => '2em'
						)
					),
					'core/post-title/h3' => array(
						'color' => array(
							'link' => '#333'
						),
						'typography' => array(
							'fontSize' => '3em'
						),
					),
					'core/query-title/h4' => array(
						'color' => array(
							'link' => '#444'
						),
						'typography' => array(
							'fontSize' => '4em'
						),
					),
				),
				'misc'     => 'value',
			)
		);

		$this->assertEquals(
			':root{--wp--preset--color--grey: grey;--wp--preset--font-family--small: 14px;--wp--preset--font-family--big: 41px;}.wp-block-group{--wp--custom--base-font: 16;--wp--custom--line-height--small: 1.2;--wp--custom--line-height--medium: 1.4;--wp--custom--line-height--large: 1.8;}:root{color: var(--wp--preset--color--grey);}a{color: #111;}.wp-block-group{padding-top: 12px;padding-bottom: 24px;}.wp-block-group a{color: #333;}h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{color: #222;}h1{font-size: 1em;}h2{font-size: 2em;}.wp-block-post-title a{color: #333;}h3.wp-block-post-title{font-size: 3em;}.wp-block-query-title a{color: #444;}h4.wp-block-query-title{font-size: 4em;}.has-grey-color{color: grey !important;}.has-grey-background-color{background-color: grey !important;}',
			$theme_json->get_stylesheet()
		);
		$this->assertEquals(
			':root{color: var(--wp--preset--color--grey);}a{color: #111;}.wp-block-group{padding-top: 12px;padding-bottom: 24px;}.wp-block-group a{color: #333;}h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{color: #222;}h1{font-size: 1em;}h2{font-size: 2em;}.wp-block-post-title a{color: #333;}h3.wp-block-post-title{font-size: 3em;}.wp-block-query-title a{color: #444;}h4.wp-block-query-title{font-size: 4em;}.has-grey-color{color: grey !important;}.has-grey-background-color{background-color: grey !important;}',
			$theme_json->get_stylesheet( 'block_styles' )
		);
		$this->assertEquals(
			':root{--wp--preset--color--grey: grey;--wp--preset--font-family--small: 14px;--wp--preset--font-family--big: 41px;}.wp-block-group{--wp--custom--base-font: 16;--wp--custom--line-height--small: 1.2;--wp--custom--line-height--medium: 1.4;--wp--custom--line-height--large: 1.8;}',
			$theme_json->get_stylesheet( 'css_variables' )
		);
	}

	function test_get_stylesheet() {
		$theme_json = new WP_Theme_JSON(
			array(
				'version'  => 1,
				'settings' => array(
					'color'      => array(
						'text'    => 'value',
						'palette' => array(
							array(
								'slug'  => 'grey',
								'color' => 'grey',
							),
						),
					),
					'typography' => array(
						'fontFamilies' => array(
							array(
								'slug'       => 'small',
								'fontFamily' => '14px',
							),
							array(
								'slug'       => 'big',
								'fontFamily' => '41px',
							),
						),
					),
					'misc'       => 'value',
					'blocks' => array(
						'core/group'     => array(
							'custom' => array(
								'base-font'   => 16,
								'line-height' => array(
									'small'  => 1.2,
									'medium' => 1.4,
									'large'  => 1.8,
								),
							),
						),
					),
				),
				'styles'   => array(
					'color' => array(
						'text' => 'var:preset|color|grey',
					),
					'misc'  => 'value',
					'elements' => array(
						'link' => array(
							'color' => array(
								'text' => '#111',
							),
						),
					),
					'blocks' => array(
						'core/group' => array(
							'elements' => array(
								'link'   => array(
									'color' => array(
										'text' => '#333',
									),
								),
							),
							'spacing' => array(
								'padding' => array(
									'top'    => '12px',
									'bottom' => '24px',
								),
							),
						),
						'core/heading' => array(
							'color' => array(
								'text' => '#123456',
							),
							'elements' => array(
								'h1' => array(
									'typography' => array(
										'fontSize' => '60px',
									),
								),
								'h2' => array(
									'typography' => array(
										'fontSize' => '30px',
									),
								),
								'h3' => array(
									'typography' => array(
										'fontSize' => '20px',
									),
								),
								'h4' => array(
									'typography' => array(
										'fontSize' => '15px',
									),
								),
								'h5' => array(
									'typography' => array(
										'fontSize' => '12px',
									),
								),
								'h6' => array(
									'typography' => array(
										'fontSize' => '10px',
									),
								),
							),
						),
						'core/post-title' => array(
							'color' => array(
								'text' => '#123456',
							),
							'elements' => array(
								'h1' => array(
									'typography' => array(
										'fontSize' => '60px',
									),
								),
								'h2' => array(
									'typography' => array(
										'fontSize' => '30px',
									),
								),
								'h3' => array(
									'typography' => array(
										'fontSize' => '20px',
									),
								),
								'h4' => array(
									'typography' => array(
										'fontSize' => '15px',
									),
								),
								'h5' => array(
									'typography' => array(
										'fontSize' => '12px',
									),
								),
								'h6' => array(
									'typography' => array(
										'fontSize' => '10px',
									),
								),
							),
						),
					),
				),
				'misc'     => 'value',
			)
		);

		$this->assertEquals(
			':root{--wp--preset--color--grey: grey;--wp--preset--font-family--small: 14px;--wp--preset--font-family--big: 41px;}.wp-block-group{--wp--custom--base-font: 16;--wp--custom--line-height--small: 1.2;--wp--custom--line-height--medium: 1.4;--wp--custom--line-height--large: 1.8;}:root{color: var(--wp--preset--color--grey);}a{color: #111;}.wp-block-group{padding-top: 12px;padding-bottom: 24px;}.wp-block-group a{color: #333;}h1,h2,h3,h4,h5,h6{color: #123456;}h1{font-size: 60px;}h2{font-size: 30px;}h3{font-size: 20px;}h4{font-size: 15px;}h5{font-size: 12px;}h6{font-size: 10px;}.wp-block-post-title{color: #123456;}h1.wp-block-post-title{font-size: 60px;}h2.wp-block-post-title{font-size: 30px;}h3.wp-block-post-title{font-size: 20px;}h4.wp-block-post-title{font-size: 15px;}h5.wp-block-post-title{font-size: 12px;}h6.wp-block-post-title{font-size: 10px;}.has-grey-color{color: grey !important;}.has-grey-background-color{background-color: grey !important;}',
			$theme_json->get_stylesheet()
		);
		$this->assertEquals(
			':root{color: var(--wp--preset--color--grey);}a{color: #111;}.wp-block-group{padding-top: 12px;padding-bottom: 24px;}.wp-block-group a{color: #333;}h1,h2,h3,h4,h5,h6{color: #123456;}h1{font-size: 60px;}h2{font-size: 30px;}h3{font-size: 20px;}h4{font-size: 15px;}h5{font-size: 12px;}h6{font-size: 10px;}.wp-block-post-title{color: #123456;}h1.wp-block-post-title{font-size: 60px;}h2.wp-block-post-title{font-size: 30px;}h3.wp-block-post-title{font-size: 20px;}h4.wp-block-post-title{font-size: 15px;}h5.wp-block-post-title{font-size: 12px;}h6.wp-block-post-title{font-size: 10px;}.has-grey-color{color: grey !important;}.has-grey-background-color{background-color: grey !important;}',
			$theme_json->get_stylesheet( 'block_styles' )
		);
		$this->assertEquals(
			':root{--wp--preset--color--grey: grey;--wp--preset--font-family--small: 14px;--wp--preset--font-family--big: 41px;}.wp-block-group{--wp--custom--base-font: 16;--wp--custom--line-height--small: 1.2;--wp--custom--line-height--medium: 1.4;--wp--custom--line-height--large: 1.8;}',
			$theme_json->get_stylesheet( 'css_variables' )
		);
	}

	function test_get_stylesheet_preset_rules_come_after_block_rules() {
		$theme_json = new WP_Theme_JSON(
			array(
				'version'  => 1,
				'settings' => array(
					'blocks' => array(
						'core/group' => array(
							'color' => array(
								'palette' => array(
									array(
										'slug'  => 'grey',
										'color' => 'grey',
									),
								),
							),
						),
					)
				),
				'styles'   => array(
					'blocks' => array(
						'core/group' => array(
							'color' => array(
								'text' => 'red',
							),
						),
					),
				),
			)
		);

		$this->assertEquals(
			'.wp-block-group{--wp--preset--color--grey: grey;}.wp-block-group{color: red;}.wp-block-group.has-grey-color{color: grey !important;}.wp-block-group.has-grey-background-color{background-color: grey !important;}',
			$theme_json->get_stylesheet()
		);
		$this->assertEquals(
			'.wp-block-group{color: red;}.wp-block-group.has-grey-color{color: grey !important;}.wp-block-group.has-grey-background-color{background-color: grey !important;}',
			$theme_json->get_stylesheet( 'block_styles' )
		);
	}

	public function test_get_stylesheet_preset_values_are_marked_as_important() {
		$theme_json = new WP_Theme_JSON(
			array(
				'version'  => 1,
				'settings' => array(
					'color' => array(
						'palette' => array(
							array(
								'slug'  => 'grey',
								'color' => 'grey',
							),
						),
					),
				),
				'styles'   => array(
					'blocks' => array(
						'core/heading' => array(
							'elements' => array(
								'h2' => array(
									'color'      => array(
										'text'       => 'red',
										'background' => 'blue',
									),
									'typography' => array(
										'fontSize'   => '12px',
										'lineHeight' => '1.3',
									),
								),
							),
						),
					),
				),
			)
		);

		$this->assertEquals(
			':root{--wp--preset--color--grey: grey;}h2{background-color: blue;color: red;font-size: 12px;line-height: 1.3;}.has-grey-color{color: grey !important;}.has-grey-background-color{background-color: grey !important;}',
			$theme_json->get_stylesheet()
		);
	}

	public function test_merge_incoming_data() {
		$initial   = array(
			'version'  => 1,
			'settings' => array(
				'color' => array(
					'custom'  => false,
					'palette' => array(
						array(
							'slug'  => 'red',
							'color' => 'red',
						),
						array(
							'slug'  => 'green',
							'color' => 'green',
						),
					),
				),
				'blocks' => array(
					'core/paragraph' => array(
						'color' => array(
							'custom' => false,
						),
					),
				),
			),
			'styles'   => array(
				'typography' => array(
					'fontSize' => '12',
				),
			),
		);

		$add_new_block = array(
			'version'  => 1,
			'settings' => array(
				'blocks' => array(
					'core/list' => array(
						'color' => array(
							'custom' => false,
						),
					),
				),
			),
			'styles'   => array(
				'blocks' => array(
					'core/list' => array(
						'typography' => array(
							'fontSize' => '12',
						),
						'color'      => array(
							'background' => 'brown',
						),
					),
				),
			),
		);

		$add_key_in_settings = array(
			'version'  => 1,
			'settings' => array(
				'color' => array(
					'customGradient' => true,
				),
			),
		);

		$update_key_in_settings = array(
			'version'  => 1,
			'settings' => array(
				'color' => array(
					'custom' => true,
				),
			),
		);

		$add_styles = array(
			'version' => 1,
			'styles'  => array(
				'blocks' => array(
					'core/group' => array(
						'spacing' => array(
							'padding' => array(
								'top' => '12px',
							),
						),
					),
				),
			),
		);

		$add_key_in_styles = array(
			'version' => 1,
			'styles'  => array(
				'blocks' => array(
					'core/group' => array(
						'spacing' => array(
							'padding' => array(
								'bottom' => '12px',
							),
						),
					),
				),
			),
		);

		$add_invalid_context = array(
			'version' => 1,
			'styles'  => array(
				'blocks' => array(
					'core/para' => array(
						'typography' => array(
							'lineHeight' => '12',
						),
					),
				),
			),
		);

		$update_presets = array(
			'version'  => 1,
			'settings' => array(
				'color'      => array(
					'palette'   => array(
						array(
							'slug'  => 'blue',
							'color' => 'blue',
						),
					),
					'gradients' => array(
						array(
							'slug'     => 'gradient',
							'gradient' => 'gradient',
						),
					),
				),
				'typography' => array(
					'fontSizes'    => array(
						array(
							'slug' => 'fontSize',
							'size' => 'fontSize',
						),
					),
					'fontFamilies' => array(
						array(
							'slug'       => 'fontFamily',
							'fontFamily' => 'fontFamily',
						),
					),
				),
			),
		);

		$expected = array(
			'version'  => 1,
			'settings' => array(
				'color'      => array(
					'custom'         => true,
					'customGradient' => true,
					'palette'        => array(
						array(
							'slug'  => 'blue',
							'color' => 'blue',
						),
					),
					'gradients'      => array(
						array(
							'slug'     => 'gradient',
							'gradient' => 'gradient',
						),
					),
				),
				'typography' => array(
					'fontSizes'    => array(
						array(
							'slug' => 'fontSize',
							'size' => 'fontSize',
						),
					),
					'fontFamilies' => array(
						array(
							'slug'       => 'fontFamily',
							'fontFamily' => 'fontFamily',
						),
					),
				),
				'blocks' => array(
					'core/paragraph' => array(
						'color' => array(
							'custom' => false,
						),
					),
					'core/list'      => array(
						'color' => array(
							'custom' => false,
						),
					),
				),
			),
			'styles'   => array(
				'typography' => array(
					'fontSize' => '12',
				),
				'blocks' => array(
					'core/group' => array(
						'spacing' => array(
							'padding' => array(
								'top'    => '12px',
								'bottom' => '12px',
							),
						),
					),
					'core/list'  => array(
						'typography' => array(
							'fontSize' => '12',
						),
						'color'      => array(
							'background' => 'brown',
						),
					),
				),
			),
		);

		$theme_json = new WP_Theme_JSON( $initial );
		$theme_json->merge( new WP_Theme_JSON( $add_new_block ) );
		$theme_json->merge( new WP_Theme_JSON( $add_key_in_settings ) );
		$theme_json->merge( new WP_Theme_JSON( $update_key_in_settings ) );
		$theme_json->merge( new WP_Theme_JSON( $add_styles ) );
		$theme_json->merge( new WP_Theme_JSON( $add_key_in_styles ) );
		$theme_json->merge( new WP_Theme_JSON( $add_invalid_context ) );
		$theme_json->merge( new WP_Theme_JSON( $update_presets ) );
		$actual = $theme_json->get_raw_data();

		$this->assertEqualSetsWithIndex( $expected, $actual );
	}

	function test_remove_insecure_properties_removes_unsafe_styles() {
		$theme_json = new WP_Theme_JSON(
			array(
				'version' => 1,
				'styles'  => array(
					'color' => array(
						'gradient' => 'url(\'data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxMCcgaGVpZ2h0PScxMCc+PHNjcmlwdD5hbGVydCgnb2snKTwvc2NyaXB0PjxsaW5lYXJHcmFkaWVudCBpZD0nZ3JhZGllbnQnPjxzdG9wIG9mZnNldD0nMTAlJyBzdG9wLWNvbG9yPScjRjAwJy8+PHN0b3Agb2Zmc2V0PSc5MCUnIHN0b3AtY29sb3I9JyNmY2MnLz4gPC9saW5lYXJHcmFkaWVudD48cmVjdCBmaWxsPSd1cmwoI2dyYWRpZW50KScgeD0nMCcgeT0nMCcgd2lkdGg9JzEwMCUnIGhlaWdodD0nMTAwJScvPjwvc3ZnPg==\')',
						'text'     => 'var:preset|color|dark-red',
					),
					'elements' => array(
						'link' => array(
							'color' => array(
								'gradient' => 'url(\'data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxMCcgaGVpZ2h0PScxMCc+PHNjcmlwdD5hbGVydCgnb2snKTwvc2NyaXB0PjxsaW5lYXJHcmFkaWVudCBpZD0nZ3JhZGllbnQnPjxzdG9wIG9mZnNldD0nMTAlJyBzdG9wLWNvbG9yPScjRjAwJy8+PHN0b3Agb2Zmc2V0PSc5MCUnIHN0b3AtY29sb3I9JyNmY2MnLz4gPC9saW5lYXJHcmFkaWVudD48cmVjdCBmaWxsPSd1cmwoI2dyYWRpZW50KScgeD0nMCcgeT0nMCcgd2lkdGg9JzEwMCUnIGhlaWdodD0nMTAwJScvPjwvc3ZnPg==\')',
								'text'     => 'var:preset|color|dark-yellow',
							),
						),
					),
					'blocks'   => array(
						'core/group'  => array(
							'color' => array(
								'gradient' => 'url(\'data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxMCcgaGVpZ2h0PScxMCc+PHNjcmlwdD5hbGVydCgnb2snKTwvc2NyaXB0PjxsaW5lYXJHcmFkaWVudCBpZD0nZ3JhZGllbnQnPjxzdG9wIG9mZnNldD0nMTAlJyBzdG9wLWNvbG9yPScjRjAwJy8+PHN0b3Agb2Zmc2V0PSc5MCUnIHN0b3AtY29sb3I9JyNmY2MnLz4gPC9saW5lYXJHcmFkaWVudD48cmVjdCBmaWxsPSd1cmwoI2dyYWRpZW50KScgeD0nMCcgeT0nMCcgd2lkdGg9JzEwMCUnIGhlaWdodD0nMTAwJScvPjwvc3ZnPg==\')',
								'text'     => 'var:preset|color|dark-gray',
							),
							'elements' => array(
								'link' => array(
									'color' => array(
										'gradient' => 'url(\'data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxMCcgaGVpZ2h0PScxMCc+PHNjcmlwdD5hbGVydCgnb2snKTwvc2NyaXB0PjxsaW5lYXJHcmFkaWVudCBpZD0nZ3JhZGllbnQnPjxzdG9wIG9mZnNldD0nMTAlJyBzdG9wLWNvbG9yPScjRjAwJy8+PHN0b3Agb2Zmc2V0PSc5MCUnIHN0b3AtY29sb3I9JyNmY2MnLz4gPC9saW5lYXJHcmFkaWVudD48cmVjdCBmaWxsPSd1cmwoI2dyYWRpZW50KScgeD0nMCcgeT0nMCcgd2lkdGg9JzEwMCUnIGhlaWdodD0nMTAwJScvPjwvc3ZnPg==\')',
										'text'     => 'var:preset|color|dark-pink',
									),
								),
							),
						),
						'invalid/key' => array(
							'background' => 'green',
						),
					),
				),
			),
			true
		);
		$theme_json->remove_insecure_properties();
		$actual   = $theme_json->get_raw_data();
		$expected = array(
			'version' => 1,
			'styles'  => array(
				'color' => array(
					'text' => 'var:preset|color|dark-red',
				),
				'elements' => array(
					'link' => array(
						'color' => array(
							'text' => 'var:preset|color|dark-yellow',
						),
					),
				),
				'blocks' => array(
					'core/group' => array(
						'color' => array(
							'text' => 'var:preset|color|dark-gray',
						),
						'elements' => array(
							'link' => array(
								'color' => array(
									'text' => 'var:preset|color|dark-pink',
								),
							)
						)
					),
				),
			),
		);
		$this->assertEqualSetsWithIndex( $expected, $actual );
	}

	function test_remove_insecure_properties_removes_unsafe_styles_sub_properties() {
		$theme_json = new WP_Theme_JSON(
			array(
				'version' => 1,
				'styles'  => array(
					'spacing' => array(
						'padding' => array(
							'top'    => '1px',
							'right'  => '1px',
							'bottom' => 'var(--unsafe-var-toplevel)',
							'left'   => '1px',
						),
					),
					'elements' => array(
						'link' => array(
							'spacing' => array(
								'padding' => array(
									'top'    => '1px',
									'right'  => '1px',
									'bottom' => 'var(--unsafe-var-elements)',
									'left'   => '1px',
								),
							),
						),
					),
					'blocks' => array(
						'core/group' => array(
							'spacing' => array(
								'padding' => array(
									'top'    => '1px',
									'right'  => '1px',
									'bottom' => 'var(--unsafe-var-block)',
									'left'   => '1px',
								),
							),
							'elements' => array(
								'link' => array(
									'spacing' => array(
										'padding' => array(
											'top'    => '1px',
											'right'  => '1px',
											'bottom' => 'var(--unsafe-var-block-elements)',
											'left'   => '1px',
										),
									),
								),
							),
						),
					),
				),
			),
			true
		);
		$theme_json->remove_insecure_properties();
		$actual   = $theme_json->get_raw_data();
		$expected = array(
			'version' => 1,
			'styles'  => array(
				'spacing' => array(
					'padding' => array(
						'top'   => '1px',
						'right' => '1px',
						'left'  => '1px',
					),
				),
				'elements' => array(
					'link' => array(
						'spacing' => array(
							'padding' => array(
								'top'   => '1px',
								'right' => '1px',
								'left'  => '1px',
							),
						),
					),
				),
				'blocks' => array(
					'core/group' => array(
						'spacing' => array(
							'padding' => array(
								'top'   => '1px',
								'right' => '1px',
								'left'  => '1px',
							),
						),
						'elements' => array(
							'link' => array(
								'spacing' => array(
									'padding' => array(
										'top'   => '1px',
										'right' => '1px',
										'left'  => '1px',
									),
								),
							),
						),
					),
				),
			),
		);
		$this->assertEqualSetsWithIndex( $expected, $actual );
	}

	function test_remove_insecure_properties_removes_non_preset_settings() {
		$theme_json = new WP_Theme_JSON(
			array(
				'version'  => 1,
				'settings' => array(
					'color'   => array(
						'custom'  => true,
						'palette' => array(
							array(
								'name'  => 'Red',
								'slug'  => 'red',
								'color' => '#ff0000',
							),
							array(
								'name'  => 'Green',
								'slug'  => 'green',
								'color' => '#00ff00',
							),
							array(
								'name'  => 'Blue',
								'slug'  => 'blue',
								'color' => '#0000ff',
							),
						),
					),
					'spacing' => array(
						'customPadding' => false,
					),
					'blocks' => array(
						'core/group' => array(
							'color'   => array(
								'custom'  => true,
								'palette' => array(
									array(
										'name'  => 'Yellow',
										'slug'  => 'yellow',
										'color' => '#ff0000',
									),
									array(
										'name'  => 'Pink',
										'slug'  => 'pink',
										'color' => '#00ff00',
									),
									array(
										'name'  => 'Orange',
										'slug'  => 'orange',
										'color' => '#0000ff',
									),
								),
							),
							'spacing' => array(
								'customPadding' => false,
							),
						),
					),
				),
			),
			true
		);
		$theme_json->remove_insecure_properties();
		$result   = $theme_json->get_raw_data();
		$expected = array(
			'version'  => 1,
			'settings' => array(
				'color' => array(
					'palette' => array(
						array(
							'name'  => 'Red',
							'slug'  => 'red',
							'color' => '#ff0000',
						),
						array(
							'name'  => 'Green',
							'slug'  => 'green',
							'color' => '#00ff00',
						),
						array(
							'name'  => 'Blue',
							'slug'  => 'blue',
							'color' => '#0000ff',
						),
					),
				),
				'blocks' => array(
					'core/group' => array(
						'color' => array(
							'palette' => array(
								array(
									'name'  => 'Yellow',
									'slug'  => 'yellow',
									'color' => '#ff0000',
								),
								array(
									'name'  => 'Pink',
									'slug'  => 'pink',
									'color' => '#00ff00',
								),
								array(
									'name'  => 'Orange',
									'slug'  => 'orange',
									'color' => '#0000ff',
								),
							),
						),
					),
				)
			),
		);
		$this->assertEqualSetsWithIndex( $expected, $result );
	}

	function test_remove_insecure_properties_removes_unsafe_preset_settings() {
		$theme_json = new WP_Theme_JSON(
			array(
				'version'  => 1,
				'settings' => array(
					'color'      => array(
						'palette' => array(
							array(
								'name'  => 'Red/><b>ok</ok>',
								'slug'  => 'red',
								'color' => '#ff0000',
							),
							array(
								'name'  => 'Green',
								'slug'  => 'a" attr',
								'color' => '#00ff00',
							),
							array(
								'name'  => 'Blue',
								'slug'  => 'blue',
								'color' => 'var(--custom-v1)',
							),
							array(
								'name'  => 'Pink',
								'slug'  => 'pink',
								'color' => '#FFC0CB',
							),
						),
					),
					'typography' => array(
						'fontFamilies' => array(
							array(
								'name'       => 'Helvetica Arial/><b>test</b>',
								'slug'       => 'helvetica-arial',
								'fontFamily' => 'Helvetica Neue, Helvetica, Arial, sans-serif',
							),
							array(
								'name'       => 'Geneva',
								'slug'       => 'geneva#asa',
								'fontFamily' => 'Geneva, Tahoma, Verdana, sans-serif',
							),
							array(
								'name'       => 'Cambria',
								'slug'       => 'cambria',
								'fontFamily' => 'Cambria, Georgia, serif',
							),
							array(
								'name'       => 'Helvetica Arial',
								'slug'       => 'helvetica-arial',
								'fontFamily' => 'var(--custom-var-1)',
							),
						),
					),
					'blocks' => array(
						'core/group' => array(
							'color'      => array(
								'palette' => array(
									array(
										'name'  => 'Red/><b>ok</ok>',
										'slug'  => 'red',
										'color' => '#ff0000',
									),
									array(
										'name'  => 'Green',
										'slug'  => 'a" attr',
										'color' => '#00ff00',
									),
									array(
										'name'  => 'Blue',
										'slug'  => 'blue',
										'color' => 'var(--custom-v1)',
									),
									array(
										'name'  => 'Pink',
										'slug'  => 'pink',
										'color' => '#FFC0CB',
									),
								),
							),
						)
					)
				),
			),
			true
		);
		$theme_json->remove_insecure_properties();
		$result   = $theme_json->get_raw_data();
		$expected = array(
			'version'  => 1,
			'settings' => array(
				'color'      => array(
					'palette' => array(
						array(
							'name'  => 'Pink',
							'slug'  => 'pink',
							'color' => '#FFC0CB',
						),
					),
				),
				'typography' => array(
					'fontFamilies' => array(
						array(
							'name'       => 'Cambria',
							'slug'       => 'cambria',
							'fontFamily' => 'Cambria, Georgia, serif',
						),
					),
				),
				'blocks' => array(
					'core/group' => array(
						'color'      => array(
							'palette' => array(
								array(
									'name'  => 'Pink',
									'slug'  => 'pink',
									'color' => '#FFC0CB',
								),
							),
						),
					),
				)
			),
		);
		$this->assertEqualSetsWithIndex( $expected, $result );
	}

	function test_get_custom_templates() {
		$theme_json = new WP_Theme_JSON(
			array(
				'customTemplates' => array(
					array(
						'name'  => 'page-home',
						'title' => 'Homepage template',
					),
				),
			)
		);

		$page_templates = $theme_json->get_custom_templates();

		$this->assertEqualSetsWithIndex(
			$page_templates,
			array(
				'page-home' => array(
					'title'     => 'Homepage template',
					'postTypes' => array( 'page' ),
				),
			)
		);
	}

	function test_get_template_parts() {
		$theme_json = new WP_Theme_JSON(
			array(
				'templateParts' => array(
					array(
						'name' => 'small-header',
						'area' => 'header',
					),
				),
			)
		);

		$template_parts = $theme_json->get_template_parts();

		$this->assertEqualSetsWithIndex(
			$template_parts,
			array(
				'small-header' => array(
					'area' => 'header',
				),
			)
		);
	}

	function test_get_from_editor_settings() {
		$input      = array(
			'disableCustomColors'    => true,
			'disableCustomGradients' => true,
			'disableCustomFontSizes' => true,
			'enableCustomLineHeight' => true,
			'enableCustomUnits'      => true,
			'colors'                 => array(
				array(
					'slug'  => 'color-slug',
					'name'  => 'Color Name',
					'color' => 'colorvalue',
				),
			),
			'gradients'              => array(
				array(
					'slug'     => 'gradient-slug',
					'name'     => 'Gradient Name',
					'gradient' => 'gradientvalue',
				),
			),
			'fontSizes'              => array(
				array(
					'slug' => 'size-slug',
					'name' => 'Size Name',
					'size' => 'sizevalue',
				),
			),
		);

		$expected = array(
			'settings' => array(
				'color'      => array(
					'custom'         => false,
					'customGradient' => false,
					'gradients'      => array(
						array(
							'slug'     => 'gradient-slug',
							'name'     => 'Gradient Name',
							'gradient' => 'gradientvalue',
						),
					),
					'palette'        => array(
						array(
							'slug'  => 'color-slug',
							'name'  => 'Color Name',
							'color' => 'colorvalue',
						),
					),
				),
				'spacing'    => array(
					'units' => array( 'px', 'em', 'rem', 'vh', 'vw' ),
				),
				'typography' => array(
					'customFontSize'   => false,
					'customLineHeight' => true,
					'fontSizes'        => array(
						array(
							'slug' => 'size-slug',
							'name' => 'Size Name',
							'size' => 'sizevalue',
						),
					),
				),
			),
		);

		$actual = WP_Theme_JSON::get_from_editor_settings( $input );

		$this->assertEqualSetsWithIndex( $expected, $actual );
	}

	function test_get_editor_settings_no_theme_support() {
		$input      = array(
			'__unstableEnableFullSiteEditingBlocks' => false,
			'disableCustomColors'                   => false,
			'disableCustomFontSizes'                => false,
			'disableCustomGradients'                => false,
			'enableCustomLineHeight'                => false,
			'enableCustomUnits'                     => false,
			'imageSizes'                            => array(
				array(
					'slug' => 'thumbnail',
					'name' => 'Thumbnail',
				),
				array(
					'slug' => 'medium',
					'name' => 'Medium',
				),
				array(
					'slug' => 'large',
					'name' => 'Large',
				),
				array(
					'slug' => 'full',
					'name' => 'Full Size',
				),
			),
			'isRTL'                                 => false,
			'maxUploadFileSize'                     => 123,
		);

		$expected   = array(
			'settings' => array(
				'color'      => array(
					'custom'         => true,
					'customGradient' => true,
				),
				'spacing'    => array(
					'units' => false,
				),
				'typography' => array(
					'customFontSize'   => true,
					'customLineHeight' => false,
				),
			),
		);

		$actual = WP_Theme_JSON::get_from_editor_settings( $input );

		$this->assertEqualSetsWithIndex( $expected, $actual );
	}

	function test_get_editor_settings_blank() {
		$input      = array();
		$expected   = array(
			'settings' => array(),
		);

		$actual = WP_Theme_JSON::get_from_editor_settings( $input );

		$this->assertEqualSetsWithIndex( $expected, $actual );
	}

	function test_get_editor_settings_custom_units_can_be_disabled() {
		add_theme_support( 'custom-units', array() );
		$input = gutenberg_get_common_block_editor_settings();

		$expected = array(
			'units'         => array( array() ),
			'customPadding' => false,
		);

		$actual = WP_Theme_JSON::get_from_editor_settings( $input );

		$this->assertEqualSetsWithIndex( $expected, $actual['settings']['spacing'] );
	}

	function test_get_editor_settings_custom_units_can_be_enabled() {
		add_theme_support( 'custom-units' );
		$input = gutenberg_get_common_block_editor_settings();

		$expected = array(
			'units'         => array( 'px', 'em', 'rem', 'vh', 'vw' ),
			'customPadding' => false,
		);

		$actual = WP_Theme_JSON::get_from_editor_settings( $input );

		$this->assertEqualSetsWithIndex( $expected, $actual['settings']['spacing'] );
	}

	function test_get_editor_settings_custom_units_can_be_filtered() {
		add_theme_support( 'custom-units', 'rem', 'em' );
		$input = gutenberg_get_common_block_editor_settings();

		$expected = array(
			'units'         => array( 'rem', 'em' ),
			'customPadding' => false,
		);

		$actual = WP_Theme_JSON::get_from_editor_settings( $input );

		$this->assertEqualSetsWithIndex( $expected, $actual['settings']['spacing'] );
	}

}
