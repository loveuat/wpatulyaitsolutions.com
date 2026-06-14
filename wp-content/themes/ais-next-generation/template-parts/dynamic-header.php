<?php
/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! hello_get_header_display() ) {
	return;
}

$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
$header_nav_menu = wp_nav_menu( [
	'theme_location' => 'menu-1',
	'fallback_cb' => false,
	'container' => false,
	'echo' => false,
	'menu_class' => '',
	'walker' => new Bootstrap_Navwalker_Custom()
] );
?>
<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">
    	<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
		} elseif ( $site_name ) {
			?>
				<a class="logo d-flex align-items-center me-auto me-xl-0" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr__( 'Home', 'hello-elementor' ); ?>" rel="home">
					<h1 class="sitename"><?php echo esc_html( $site_name ); ?></h1><span>.</span>
				</a>
			<?php if ( $tagline ) : ?>
			<p class="site-description">
				<?php echo esc_html( $tagline ); ?>
			</p>
			<?php endif; ?>
		<?php } ?>
      <?php if ( $header_nav_menu ) : ?>
		<nav id = "navmenu" class="navmenu" aria-label="<?php echo esc_attr__( 'Main menu', 'hello-elementor' ); ?>">
			<?php
			// PHPCS - escaped by WordPress with "wp_nav_menu"
			echo $header_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
		</nav>
		<a class="btn-getstarted" href="index.html#about">Get Started</a>
	<?php endif; ?>
    </div>
  </header>
