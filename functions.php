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
define( 'TTFMAKE_CHILD_VERSION', '1.1.0' );

/**
 * Enqueues assets.
 *
 * - Updates our stylesheet version number for cache busting purposes.
 * - Enqueues our custom JS.
 */
function gcdi_enqueue_scripts() {
	// Ensure the Make API is available.
	if ( ! function_exists( 'Make' ) ) {
		return;
	}

	// Update this whenever we make an update to bust cache.
	$css_version = '20190207';
	$js_version  = '20190201';

	/* CSS ***************************************************/

	// Enqueue Slicknav CSS.
	wp_enqueue_style( 'jquery-slicknav', 'https://cdn.jsdelivr.net/gh/ComputerWolf/SlickNav/dist/slicknav.min.css' );

	// Update our stylesheet version number.
	Make()->scripts()->update_version( 'make-main', $css_version, 'style' );

	/* JS ****************************************************/

	// Register jSticky.
	wp_register_script( 'jquery-jsticky', 'https://cdn.jsdelivr.net/gh/AndrewHenderson/jSticky@master/jquery.jsticky.min.js', array( 'jquery' ) );
	// Register SlickNav.
	wp_register_script( 'jquery-slicknav', 'https://cdn.jsdelivr.net/gh/ComputerWolf/SlickNav/dist/jquery.slicknav.min.js', array( 'jquery' ) );

	// Enqueue our JS.
	wp_enqueue_script( 'gcdi', get_stylesheet_directory_uri() . '/js/app.js', array( 'jquery-jsticky', 'jquery-slicknav' ), $js_version );
}
add_action( 'wp_enqueue_scripts', 'gcdi_enqueue_scripts', 20 );

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
		echo '</div><!-- .tribe-events-cal-links -->';
	}
}
