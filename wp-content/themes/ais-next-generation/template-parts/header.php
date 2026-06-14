<?php
/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
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
$top_header =  carbon_get_theme_option('enable_top_header');
$infos = carbon_get_theme_option('information');
$socials = carbon_get_theme_option('social_media');
?>
  <header id="header" class="header sticky-top">
  	<?php if (!empty($top_header)):?>
  	<div class="nav-wrap">
      <div class="container d-flex justify-content-between position-relative flex-column flex-lg-row">
      	<?php if (!empty($infos)) :?>
      	<div class="contact-info d-flex align-items-center">
      		<?php  foreach ($infos as $item) :?>
          <i class="bi <?php echo $item['info_icon'];?> d-flex align-items-center"><span><?php echo $item['info_label'] .' : '.$item['info_value'];?> </span></i>
      <?php endforeach;?>
        </div>
    <?php endif;?>
        <div class="d-flex align-items-center gap-3">
        	<?php if (!empty($socials)) :?>
        	<div class="social-links justify-content-center">
        		<?php foreach ($socials as $social):?>
            <a href="<?php echo $social['social_url'];?>" target="_blank" class=""><i class="bi <?php echo $social['social_icon'];?>"></i></a>
        <?php endforeach;?>
          </div>
          	<?php endif;?>
          <!-- <form class="search-form ms-4">
            <input type="text" placeholder="Search..." class="form-control">
            <button type="submit" class="btn"><i class="bi bi-search"></i></button>
          </form> -->
          <span class="nav-item accessibility-wrapper">
    <a href="javascript:void(0)" 
       class="accessibility-btn"
       aria-haspopup="true"
       aria-expanded="false">
       <svg width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
    <path d="M9.10943 11.1621C8.04754 11.1621 7.02744 11.1639 6.00735 11.1603C5.80813 11.1603 5.60625 11.1532 5.41059 11.1212C4.5817 10.986 3.99295 10.2766 4.00006 9.43644C4.00718 8.61673 4.63684 7.89038 5.44883 7.77392C5.62403 7.74902 5.80279 7.74191 5.98067 7.74191C9.981 7.74013 13.9813 7.73836 17.9817 7.74458C18.2449 7.74458 18.5197 7.76591 18.7688 7.84326C19.5114 8.07352 19.9721 8.78121 19.9223 9.55912C19.8742 10.3113 19.2944 10.9789 18.5446 11.1096C18.2734 11.1567 17.9923 11.1576 17.7158 11.1594C16.7633 11.1647 15.8099 11.1612 14.7613 11.1612C14.82 12.0778 14.7666 12.9811 14.9543 13.831C15.3945 15.8225 15.9548 17.7873 16.4555 19.7654C16.6912 20.698 16.1994 21.6039 15.3207 21.9027C14.3264 22.2405 13.2796 21.6662 13.0279 20.6189C12.6864 19.1955 12.368 17.7659 12.039 16.3399C12.0256 16.2812 12.0061 16.2243 11.9243 16.1647C11.7597 16.8813 11.5943 17.5988 11.4289 18.3153C11.2546 19.0719 11.0918 19.8312 10.9033 20.5842C10.6516 21.5862 9.71508 22.148 8.73768 21.9053C7.79585 21.6706 7.22933 20.7122 7.47746 19.7298C7.92747 17.9446 8.35614 16.1532 8.86397 14.384C9.16635 13.3305 9.08898 12.2769 9.10854 11.1621H9.10943Z"/>
    <path d="M11.8695 6.62963C10.5689 6.62692 9.54837 5.59711 9.55472 4.29402C9.56106 3.02713 10.6124 1.9928 11.8867 2.00004C13.1574 2.00818 14.187 3.05065 14.1843 4.3275C14.1816 5.60707 13.1511 6.63144 11.8695 6.62872V6.62963Z"/>
</svg>

    </a>

    <div class="accessibility-dropdown" role="menu">

    <!-- ================= COLOR & DISPLAY ================= -->
    <h4>Color & Display</h4>
    <div class="a11y-grid">

        <!-- High Contrast -->
        <button
            class="a11y-btn a11y-contrast-high"
            onclick="setContrast('high')"
            role="menuitem"
            aria-label="High Contrast">
            High Contrast
        </button>

        <!-- Normal Contrast -->
        <button
            class="a11y-btn a11y-contrast-normal"
            onclick="setContrast('normal')"
            role="menuitem"
            aria-label="Normal Contrast">
            Normal Contrast
        </button>

        <!-- Highlight Links -->
        <button
            class="a11y-btn"
            onclick="toggleHighlightLinks()"
            role="menuitem"
            aria-label="Highlight Links">
            Highlight Links
        </button>

        <!-- Invert Colors -->
        <button
            class="a11y-btn"
            onclick="toggleInvert()"
            role="menuitem"
            aria-label="Invert Colors">
            Invert Colors
        </button>

        <!-- Saturation -->
        <button
            class="a11y-btn"
            onclick="toggleSaturation()"
            role="menuitem"
            aria-label="Increase Saturation">
            Saturation
        </button>

    </div>

    <!-- ================= TEXT SIZE ================= -->
    <h4>Text Size</h4>
    <div class="a11y-grid">

        <!-- Font Increase -->
        <button
            class="a11y-btn"
            onclick="fontIncrease()"
            role="menuitem"
            aria-label="Increase Font Size">
            A+
        </button>

        <!-- Font Decrease -->
        <button
            class="a11y-btn"
            onclick="fontDecrease()"
            role="menuitem"
            aria-label="Decrease Font Size">
            A-
        </button>

        <!-- Font Reset -->
        <button
            class="a11y-btn"
            onclick="fontReset()"
            role="menuitem"
            aria-label="Reset Font Size">
            Normal Font
        </button>

    </div>

    <!-- ================= TEXT LAYOUT ================= -->
    <h4>Text Layout</h4>
    <div class="a11y-grid">

        <!-- Text Spacing -->
        <button
            class="a11y-btn"
            onclick="toggleTextSpacing()"
            role="menuitem"
            aria-label="Text Spacing">
            Text Spacing
        </button>

        <!-- Line Height -->
        <button
            class="a11y-btn"
            onclick="toggleLineHeight()"
            role="menuitem"
            aria-label="Line Height">
            Line Height
        </button>

    </div>

    <!-- ================= OTHERS ================= -->
    <h4>Others</h4>
    <div class="a11y-grid">

        <!-- Hide Images -->
        <button
            class="a11y-btn"
            onclick="toggleHideImages()"
            role="menuitem"
            aria-label="Hide Images">
            Hide Images
        </button>

        <!-- Big Cursor -->
        <button
            class="a11y-btn"
            onclick="toggleBigCursor()"
            role="menuitem"
            aria-label="Big Cursor">
            Big Cursor
        </button>

    </div>

</div>

</span> 
<a class="skip-link" 
         href="#content">
         Skip To Content
      </a>	
        </div>
         

      </div>

    </div>
<?php endif;?>
    <div class="container-fluid container-xl position-relative ">

      <div class="top-row d-flex align-items-center justify-content-between">
      	<?php
		if ( has_custom_logo() ) {
			my_theme_logo('header');
		} elseif ( $site_name ) {
			?>
				<a class="logo d-flex align-items-center" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr__( 'Home', 'hello-elementor' ); ?>" rel="home">
					<h1 class="sitename"><?php echo esc_html( $site_name ); ?></h1><span>.</span>
				</a>
			<?php if ( $tagline ) : ?>
			<p class="site-description">
				<?php echo esc_html( $tagline ); ?>
			</p>
			<?php endif; ?>
		<?php } ?>
        <div class="nav-wrap-menu">
      <div class="container d-flex justify-content-between position-relative">
      	<?php if ( $header_nav_menu ) : ?>
        <nav id="navmenu" class="navmenu">
         <?php echo $header_nav_menu;?>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <?php endif;?>
      </div>
    </div>
      </div>
    </div>
  </header>