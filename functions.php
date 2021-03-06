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
	$css_version = '20190423';
	$js_version  = '20190408';

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
			'title' => 'Commons',
			'class' => array( 'fa', 'fa-cac-icon' ),
		)
	);
}

add_action( 'make_socialicons_loaded', 'childtheme_change_cac_icon' );

// Disable Google Fonts
add_filter( 'make_add_font_source_google', '__return_false' );

/*
 * Fix postlist image aspect ratio to override Make's 'height:auto' CSS.
 */
add_filter( 'makeplus_postslist_output', function( $retval ) {
	static $run_once = null;
	if ( is_null( $run_once ) ) {
		$run_once = true;

		// Use JS to set the CSS height, which overrides Make's CSS.
		add_action( 'wp_footer', function() {
		?>

<script>
jQuery(".gcdi-thumb img").each(function() {
	var $t = jQuery(this);
	var ht = $t.attr("height");
	ht = ht ? ht+"px" : "auto";
	$t.css("height", ht);
});
</script>


		<?php
		} );
	}

	return $retval;
} );

/*
 * Add term link at the end of postlists automatically.
 */
add_filter( 'makeplus_postslist_output', function( $retval, $query, $display ) {
	$tax_query = $query->get( 'tax_query' );
	if ( empty( $tax_query[0] ) || ! is_string( $tax_query[0]['terms'] ) ) {
		return $retval;
	}

	$term = get_term_by( $tax_query[0]['field'], $tax_query[0]['terms'], $tax_query[0]['taxonomy'] );
	if ( false === $term ) {
		return $retval;
	}

	$term = sanitize_term( $term, $tax_query[0]['taxonomy'] );

	if ( 'news' === $tax_query[0]['terms'] ) {
		$link = get_permalink( get_page_by_title( 'News' ) );
	} else {
		$link = get_term_link( $tax_query[0]['terms'], $tax_query[0]['taxonomy'] );
	}

	$link = sprintf( '<p><a href="%s">More from %s &rarr;</a></p>',
		$link,
		$term->name
	);

	return $retval . $link;
}, 10, 3 );

/**
 * Filter Events Calendar's "No matching events" msg for empty 'workshop'
 * event archives.
 */
add_filter( 'tribe_events_set_notice', function( $retval, $key ) {
	if ( 'events-not-found' !== $key ) {
		return $retval;
	}

	$tribe = Tribe__Events__Main::instance();
	$maybe_term = get_query_var( 'term' );
	if ( is_tax( $tribe->get_event_taxonomy() ) && ! empty( $maybe_term ) && 'workshop' === $maybe_term ) {
		return 'GCDI has completed its workshop series at this time, check back for new workshops two weeks prior to the next semester.';
	}

	return $retval;
}, 10, 2 );

/**
 * Add 'Remove filter' link to events calendar.
 */
add_action( 'tribe_events_after_header', function() {
	echo '<div style="text-align:center;">';

	$show_full = true;
	$link = '';

	if ( get_query_var( 'term' ) ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			$link = '/events/';
			if ( ! empty( $_POST['eventDate'] ) ) {
				$link .= sanitize_title( $_POST['eventDate'] ) . '/';
			}
			if ( ! empty( $_POST['tribe-bar-date'] ) ) {
				$link .= '?tribe-bar-date=' . sanitize_title( $_POST['tribe-bar-date'] );
			}

		} else {
			$link = $_SERVER['REQUEST_URI'];

			if ( false !== strpos( $link, '?' ) ) {
				$link = preg_replace( '#/category/(.*)/?tribe_events_cat=(.*)&#', '/?', $link );
			} else {
				$link = preg_replace( '#/category/(.*)/#', '/', $link );
			}

			if ( empty( $GLOBALS['wp_query']->query['eventDate'] ) ) {
				$show_full = false;
			}
		}

		printf( '<a href="%s">Remove filter</a>', $link );
	}

	echo '</div>';
}, 999 );

/**
 * Adds the venue description to the end of a single event's Venue block.
 *
 * @see https://redmine.gc.cuny.edu/issues/12625
 */
add_action( 'tribe_events_single_meta_venue_section_end', function() {
	printf( '<dd class="tribe-venue-description">%s</dd>', get_post_field( 'post_content', tribe_get_venue_id() ) );
}, 0 );

/**
 * Follow Us widget, piggybacks off Make's Social Links feature.
 *
 * @see WP_Widget
 */
class GCDI_Follow_Us_Widget extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_follow_us',
			'description' => "Displays Make's Social Links feature in a widget.",
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'follow-us', 'Follow Us', $widget_ops );
	}

	/**
	 * Outputs the content for the current widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget( $args, $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		if ( is_customize_preview() ) {
			echo '<div class="footer-social-links">';
		}

		$icons = Make()->socialicons()->render_icons();
		$icons = str_replace( array( '<span class="screen-reader-text">', '</span>' ), '', $icons );
		echo $icons;

		if ( is_customize_preview() ) {
			echo '</div>';
		}

		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<?php
	}

	/**
	 * Handles updating settings for the current widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}

}

add_action( 'widgets_init', function() {
	register_widget( 'GCDI_Follow_Us_Widget' );
} );