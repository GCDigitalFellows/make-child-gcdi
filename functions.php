<?php

/**
 * @package Make GCDI Child
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
     $gcdi_defaults = array(
         // Site Title & Tagline
         'hide-site-title'                          => 0,
         'hide-tagline'                             => 1,
         'color-site-title'                         => '#171717',
         // General
         'general-layout'                           => 'boxed',
         'general-sticky-label'                     => __( 'Featured', 'make' ),
         // Logo
         'logo-regular'                             => NULL,
         'logo-retina'                              => NULL,
         'logo-favicon'                             => NULL,
         'logo-apple-touch'                         => NULL,
         // Background
         'background_color'                         => '#ffffff',
         'background_image'                         => '',
         'background_repeat'                        => 'repeat',
         'background_position_x'                    => 'left',
         'background_attachment'                    => 'scroll',
         'background_size'                          => 'auto',
         // Colors
         'color-primary'                            => '#403391',
         'color-secondary'                          => '#eaecee',
         'color-text'                               => '#171717',
         'color-detail'                             => '#b9bcbf',
         // Layout - Blog
         'layout-blog-hide-header'                  => 0,
         'layout-blog-hide-footer'                  => 0,
         'layout-blog-sidebar-left'                 => 0,
         'layout-blog-sidebar-right'                => 1,
         'layout-blog-featured-images'              => 'post-header',
         'layout-blog-post-date'                    => 'absolute',
         'layout-blog-post-author'                  => 'avatar',
         'layout-blog-auto-excerpt'                 => 0,
         'layout-blog-show-categories'              => 1,
         'layout-blog-show-tags'                    => 1,
         'layout-blog-featured-images-alignment'    => 'center',
         'layout-blog-post-date-location'           => 'top',
         'layout-blog-post-author-location'         => 'post-footer',
         'layout-blog-comment-count'                => 'none',
         'layout-blog-comment-count-location'       => 'before-content',
         // Layout - Archive
         'layout-archive-hide-header'               => 0,
         'layout-archive-hide-footer'               => 0,
         'layout-archive-sidebar-left'              => 0,
         'layout-archive-sidebar-right'             => 1,
         'layout-archive-featured-images'           => 'post-header',
         'layout-archive-post-date'                 => 'absolute',
         'layout-archive-post-author'               => 'avatar',
         'layout-archive-auto-excerpt'              => 0,
         'layout-archive-show-categories'           => 1,
         'layout-archive-show-tags'                 => 1,
         'layout-archive-featured-images-alignment' => 'center',
         'layout-archive-post-date-location'        => 'top',
         'layout-archive-post-author-location'      => 'post-footer',
         'layout-archive-comment-count'             => 'none',
         'layout-archive-comment-count-location'    => 'before-content',
         // Layout - Search
         'layout-search-hide-header'                => 0,
         'layout-search-hide-footer'                => 0,
         'layout-search-sidebar-left'               => 0,
         'layout-search-sidebar-right'              => 1,
         'layout-search-featured-images'            => 'thumbnail',
         'layout-search-post-date'                  => 'absolute',
         'layout-search-post-author'                => 'name',
         'layout-search-auto-excerpt'               => 1,
         'layout-search-show-categories'            => 1,
         'layout-search-show-tags'                  => 1,
         'layout-search-featured-images-alignment'  => 'center',
         'layout-search-post-date-location'         => 'top',
         'layout-search-post-author-location'       => 'post-footer',
         'layout-search-comment-count'              => 'none',
         'layout-search-comment-count-location'     => 'before-content',
         // Layout - Posts
         'layout-post-hide-header'                  => 0,
         'layout-post-hide-footer'                  => 0,
         'layout-post-sidebar-left'                 => 0,
         'layout-post-sidebar-right'                => 0,
         'layout-post-featured-images'              => 'post-header',
         'layout-post-post-date'                    => 'absolute',
         'layout-post-post-author'                  => 'avatar',
         'layout-post-show-categories'              => 1,
         'layout-post-show-tags'                    => 1,
         'layout-post-featured-images-alignment'    => 'center',
         'layout-post-post-date-location'           => 'top',
         'layout-post-post-author-location'         => 'post-footer',
         'layout-post-comment-count'                => 'none',
         'layout-post-comment-count-location'       => 'before-content',
         // Layout - Pages
         'layout-page-hide-header'                  => 0,
         'layout-page-hide-footer'                  => 0,
         'layout-page-sidebar-left'                 => 0,
         'layout-page-sidebar-right'                => 0,
         'layout-page-hide-title'                   => 1,
         'layout-page-featured-images'              => 'none',
         'layout-page-post-date'                    => 'none',
         'layout-page-post-author'                  => 'none',
         'layout-page-featured-images-alignment'    => 'center',
         'layout-page-post-date-location'           => 'top',
         'layout-page-post-author-location'         => 'post-footer',
         'layout-page-comment-count'                => 'none',
         'layout-page-comment-count-location'       => 'before-content',
         // Header
         'header-text-color'                        => '#171717',
         'header-background-color'                  => '#f5ed08',
         'header-background-image'                  => '',
         'header-background-repeat'                 => 'no-repeat',
         'header-background-position'               => 'center',
         'header-background-size'                   => 'cover',
         'header-bar-background-color'              => '#403391',
         'header-bar-text-color'                    => '#ffffff',
         'header-bar-border-color'                  => '#ffffff',
         'header-text'                              => '',
         'header-show-social'                       => 0,
         'header-show-search'                       => 1,
         'header-bar-content-layout'                => 'default',
         'header-layout'                            => 2,
         'header-branding-position'                 => 'left',
         // Main
         'main-background-color'                    => '#ffffff',
         'main-background-image'                    => '',
         'main-background-repeat'                   => 'repeat',
         'main-background-position'                 => 'left',
         'main-background-size'                     => 'auto',
         //'main-content-link-underline'              => 'link-underline-body',
         // Footer
         'footer-text-color'                        => '#464849',
         'footer-border-color'                      => '#b9bcbf',
         'footer-background-color'                  => '#eaecee',
         'footer-background-image'                  => NULL,
         'footer-background-repeat'                 => 'no-repeat',
         'footer-background-position'               => 'center',
         'footer-background-size'                   => 'contain'
     );

     foreach ($gcdi_defaults as $key => $value) {
         make_update_thememod_setting_definition(
             $key, 
             array(
                'default' => $value,
            )
        );
     }
}
add_action( 'make_settings_thememod_loaded', 'gcdi_update_setting_defaults' );
