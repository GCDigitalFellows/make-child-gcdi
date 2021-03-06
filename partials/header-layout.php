<?php
/**
 * @package Make
 */

// Header Options
$subheader_class = ( make_get_thememod_value( 'header-show-social' ) || make_get_thememod_value( 'header-show-search' ) ) ? ' right-content' : '';
$mobile_menu = make_get_thememod_value( 'mobile-menu' );
$header_menu_container_class = 'header-bar-menu' . ( 'header-bar' === $mobile_menu ? ' mobile-menu': ' desktop-menu' );
$header_bar_menu = wp_nav_menu( array(
	'theme_location'  => 'header-bar',
	'container_class' => $header_menu_container_class,
	'depth'           => 1,
	'fallback_cb'     => false,
	'echo'            => false,
) );

set_query_var( 'mobile_menu', $mobile_menu );
set_query_var( 'header_bar_menu', $header_bar_menu );
?>

<header id="site-header" class="<?php echo esc_attr( ttfmake_get_site_header_class() ); ?>" role="banner">
<?php // Only show Header Bar if it has content
if (
	make_get_thememod_value( 'header-text' )
	||
	make_get_thememod_value( 'header-show-search' )
	||
	( make_has_socialicons() && make_get_thememod_value( 'header-show-social' ) )
	||
	! empty( $header_bar_menu )
) : ?>

<div class="header-bar<?php echo esc_attr( $subheader_class ); ?>">
	<div class="container">
		<div class="branding">
		<?php // Logo
		if ( make_has_logo() ) : ?>
			<?php make_logo(); ?>
		<?php endif; ?>
		<?php // Site title
		if ( get_bloginfo( 'name' ) ) : ?>
			<h1 class="site-title<?php if ( make_get_thememod_value( 'hide-site-title' ) ) echo ' screen-reader-text'; ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</h1>
		<?php endif; ?>
		</div>

		<?php get_template_part( 'partials/nav', 'header-bar' ); ?>

		<a href="#search-field" class="search-form-link"><i class="fa fa-search"></i><span class="screen-reader-text">Search</span></a>
	</div>
</div>

<?php endif; ?>
</header>
