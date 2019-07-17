<?php
/**
 * Child Theme Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage PACKAGENAME
 * @since 1.0.0
 */

	if ( ! function_exists( 'redhill_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function redhill_theme_setup() {

		// ? remove_editor_style( 'editor-color-palette' );
		// Add child theme editor styles, compiled from `style-child-theme-editor.scss`.
		add_editor_style( 'style-editor.css' );

		// Remove parent theme font sizes
		remove_theme_support( 'editor-font-sizes' );
		// Add child theme editor font sizes to match Sass-map variables in `_config-child-theme-deep.scss`.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'redhill' ),
					'shortName' => __( 'S', 'redhill' ),
					'size'      => 18.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'redhill' ),
					'shortName' => __( 'M', 'redhill' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'redhill' ),
					'shortName' => __( 'L', 'redhill' ),
					'size'      => 32,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'redhill' ),
					'shortName' => __( 'XL', 'redhill' ),
					'size'      => 38,
					'slug'      => 'huge',
				),
			)
		);

		// Remove parent theme color palette
		// remove_theme_support( 'editor-color-palette' );
		// Add child theme editor color pallete to match Sass-map variables in `_config-child-theme-deep.scss`.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'redhill' ),
					'slug'  => 'primary',
					'color' => '#CA2017', // _dsgnsystm_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? $default_hue : get_theme_mod( 'primary_color_hue', $default_hue ), $saturation, $lightness ),
				),
				array(
					'name'  => __( 'Secondary', 'redhill' ),
					'slug'  => 'secondary',
					'color' => '#007FDB', // _dsgnsystm_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? $default_hue : get_theme_mod( 'primary_color_hue', $default_hue ), $saturation, $lightness ),
				),
				array(
					'name'  => __( 'Dark Gray', 'redhill' ),
					'slug'  => 'foreground-dark',
					'color' => '#111111',
				),
				array(
					'name'  => __( 'Gray', 'redhill' ),
					'slug'  => 'foreground',
					'color' => '#444444',
				),
				array(
					'name'  => __( 'Light Gray', 'redhill' ),
					'slug'  => 'foreground-light',
					'color' => '#666666',
				),
				array(
					'name'  => __( 'White', 'redhill' ),
					'slug'  => 'background',
					'color' => '#FFFFFF',
				),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'redhill_theme_setup', 12 );

/**
 * Set the content width in pixels, based on the child-theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function redhill_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'redhill_theme_content_width', 740 );
}
add_action( 'after_setup_theme', 'redhill_theme_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function redhill_theme_scripts() {

	// dequeue parent styles
	wp_dequeue_style( '_dsgnsystm-style' );

	// enqueue child styles
	wp_enqueue_style( 'redhill-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ));

	// enqueue child RTL styles
	wp_style_add_data( 'redhill-style', 'rtl', 'replace' );

}
add_action( 'wp_enqueue_scripts', 'redhill_theme_scripts', 99 );
