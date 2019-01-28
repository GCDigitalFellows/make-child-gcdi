<?php

/**
 * @package Make GCDI
 */
/**
 * The GC Digital Initiatives Child Theme of Make
 *
 *
 * @see MAKE_Setup_Scripts::enqueue_frontend_styles()
 */
define( 'TTFMAKE_CHILD_VERSION', '0.1' );

/**
 * Turn off the parent theme styles.
 *
 * If you would like to use this child theme to style Make from scratch, rather
 * than simply overriding specific style rules, remove the '//' from the
 * 'add_filter' line below. This will tell the theme not to enqueue the parent
 * stylesheet along with the child one.
 */
//add_filter( 'make_enqueue_parent_stylesheet', '__return_false' );

/**
 * Define a version number for the child theme's stylesheet.
 *
 * In order to prevent old versions of the child theme's stylesheet from loading
 * from a browser's cache, update the version number below each time changes are
 * made to the stylesheet.
 *
 * @uses MAKE_Setup_Scripts::update_version()
 */
function childtheme_style_version() {
    // Ensure the Make API is available.
    if ( ! function_exists( 'Make' ) ) {
        return;
    }
    // Version string to append to the child theme's style.css URL.
    $version = '1.0.0'; // <- Update this!
    Make()->scripts()->update_version( 'make-main', $version, 'style' );
}
add_action( 'wp_enqueue_scripts', 'childtheme_style_version', 20 );

function make_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'make-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'make-gcdi-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'make-style' )
    );

}
add_action( 'wp_enqueue_scripts', 'make_parent_theme_enqueue_styles' );

function gcdi_update_setting_defaults() {
    $gcdi_settings = array (
        'general-layout'                    => array( 'default' => 'boxed' ),
        'background_color'                  => array( 'default' => 'ff0000' ),
        'hide-site-title'                   => array( 'default' => true ),
        'hide-tagline'                      => array( 'default' => false ),
        /* Colors  */
        'color-primary'                     => array( 'default' => '29a6dd' ), // darker tint of 55b8e4
        'color-secondary'                   => array( 'default' => 'f1d798' ), // tint of #e4af32
        'color-text'                        => array( 'default' => '171717' ),
        'color-detail'                      => array( 'default' => 'b3282e' ),
        /* Blog Layout */
        'layout-blog-sidebar-right'         => array( 'default' => false ),
        'layout-blog-post-date-location'    => array( 'default' => 'before-content' ),
        'layout-blog-post-author'           => array( 'default' => 'name' ),
        'layout-blog-post-author-location'  => array( 'default' => 'before-content' ),
        'layout-blog-show-categories'       => array( 'default' => false ),
        // 'layout-blog-post-show-tags'        => array( 'default' => false ),
        /* Post Layout */
        'layout-post-post-date-location'    => array( 'default' => 'before-content' ),
        'layout-post-post-author'           => array( 'default' => 'name' ),
        'layout-post-post-author-location'  => array( 'default' => 'before-content' ),
        'layout-post-show-categories'       => array( 'default' => false ),
        // 'layout-post-post-show-tags'        => array( 'default' => false ),
        /* Header */
        'header-layout'                     => array( 'default' => '1' ),
        'header-hide-padding-bottom'        => array( 'default' => true ),
        /* Footer */
        'footer-widget-areas'               => array( 'default' => '2' ),
        'font-size-footer-icon'             => array( 'default' => 30 ),
        /* Typography */
        'font-family-body'                  => array( 'default' => 'IBM Plex Sans' ),
        'font-family-h1'                    => array( 'default' => 'IBM Plex Serif' ),
        'font-family-h2'                    => array( 'default' => 'IBM Plex Serif' ),
        'font-family-h3'                    => array( 'default' => 'IBM Plex Sans Condensed' ),
        'font-family-h4'                    => array( 'default' => 'IBM Plex Sans Condensed' ),
        'font-family-h5'                    => array( 'default' => 'IBM Plex Sans Condensed' ),
        'font-family-h6'                    => array( 'default' => 'IBM Plex Sans Condensed' ),
        'font-family-site-title'            => array( 'default' => 'IBM Plex Sans Condensed' ),
        'font-family-nav'                   => array( 'default' => 'IBM Plex Sans Condensed' ),
        'font-family-subnav'                => array( 'default' => 'IBM Plex Sans Condensed' ),
        'font-family-header-bar-text'       => array( 'default' => 'IBM Plex Sans Condensed' ),
        'font-family-widget-title'          => array( 'default' => 'IBM Plex Sans Condensed' ),
        'font-family-widget'                => array( 'default' => 'IBM Plex Sans' ),
        'font-family-footer-widget-title'   => array( 'default' => 'IBM Plex Sans Condensed' ),
        'font-family-footer-widget'         => array( 'default' => 'IBM Plex Sans' ),
        'font-family-footer-text'           => array( 'default' => 'IBM Plex Sans' ),
        'font-weight-h1'                    => array( 'default' => 'bold' ),
        'font-weight-h2'                    => array( 'default' => 'bold' ),
        'font-weight-h3'                    => array( 'default' => 'bold' ),
        'font-weight-h4'                    => array( 'default' => 'bold' ),
        'font-weight-h5'                    => array( 'default' => 'bold' ),
        'font-weight-h6'                    => array( 'default' => 'bold' ),
        'text-transform-h1'                 => array( 'default' => 'none' ),
        'text-transform-h2'                 => array( 'default' => 'none' ),
        'text-transform-h3'                 => array( 'default' => 'uppercase' ),
        'text-transform-h4'                 => array( 'default' => 'none' ),
        'text-transform-h5'                 => array( 'default' => 'none' ),
        'text-transform-h6'                 => array( 'default' => 'none' ),
        // 'line-underline-h3'                 => array( 'default' => 'never' ),
    );

    foreach ($gcdi_settings as $id => $settings) {
        make_update_thememod_setting_definition( $id, $settings );
        Make()->thememod()->set_value( $id, $settings["default"] );
    }
}

function childtheme_change_cac_icon() {
	make_update_socialicon_definition(
		'commons.gc.cuny.edu',
		array(
			'title' => _x( 'CUNY Academic Commons', 'CAC', 'make-child' ),
			'class' => array( 'fa', 'fa-cac-icon' ),
		)
	);
}

add_action( 'make_socialicons_loaded', 'childtheme_change_cac_icon' );

// Disable Google Fonts
add_filter( 'make_add_font_source_google', '__return_false' );

// The Events Calendar - Add iCal Link Above Month View
add_action( 'tribe_events_before_header', 'ecp_add_month_ical');
function ecp_add_month_ical() {
	if ( tribe_is_month() ) {
		echo '<div class="tribe-events-cal-links">';
		echo '<a title="' . $title . '" href="' . esc_url( tribe_get_ical_link() ) . '">+ Export Month\'s Events</a>';
		echo '</div><-- .tribe-events-cal-links -->';
	}
}
