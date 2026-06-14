<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$footer_tagline = carbon_get_theme_option('footer_tagline');
$footer_contact_info = carbon_get_theme_option('footer_contact_info');
$footer_compliance_info = carbon_get_theme_option('footer_complinace_info');
$footer_sebi_info = apply_filters('the_content', carbon_get_theme_option('footer_sebi_details'));
$footer_sebi_office = apply_filters('the_content', carbon_get_theme_option('footer_sebi_office'));
$footer_sebi_head_office = apply_filters('the_content', carbon_get_theme_option('footer_sebi_head_office'));
$footer_disclaimer = apply_filters('the_content', carbon_get_theme_option('footer_disclaimer'));
$socials = carbon_get_theme_option('social_media');
//Menu Title 
$location1 = 'menu-2';
$location2 = 'menu-3';
$location3 = 'menu-4';
$locations = get_nav_menu_locations();

$menu_title1 = '';
$menu_title2 = '';
$menu_title3 = '';

if (isset($locations[$location1])) {
    $menu_obj1 = wp_get_nav_menu_object($locations[$location1]);
    $menu_title1 = $menu_obj1->name;
}
if (isset($locations[$location2])) {
    $menu_obj2 = wp_get_nav_menu_object($locations[$location2]);
    $menu_title2 = $menu_obj2->name;
}
if (isset($locations[$location3])) {
    $menu_obj3 = wp_get_nav_menu_object($locations[$location3]);
    $menu_title3 = $menu_obj3->name;
}
$footer_nav_menu_first = wp_nav_menu( [
  'theme_location' => 'menu-2',
  'fallback_cb' => false,
  'container' => false,
  'echo' => false,
  'menu_class' => '',
  'walker' => new Bootstrap_Navwalker_Footer_Custom()
] );
$footer_nav_menu_second = wp_nav_menu( [
  'theme_location' => 'menu-3',
  'fallback_cb' => false,
  'container' => false,
  'echo' => false,
  'menu_class' => '',
  'walker' => new Bootstrap_Navwalker_Footer_Custom()
] );
$footer_nav_menu_third = wp_nav_menu( [
  'theme_location' => 'menu-4',
  'fallback_cb' => false,
  'container' => false,
  'echo' => false,
  'menu_class' => '',
  'walker' => new Bootstrap_Navwalker_Footer_Custom()
] );
?>
  <footer id="footer" class="footer position-relative dark-background">

    <div class="container">
      <div class="row gy-5">

        <div class="col-lg-3">
          <div class="footer-brand">
            <?php
    if ( has_custom_logo() ) {
      my_theme_logo('footer');
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
    <?php if($footer_tagline):?>
            <p class="footer_tagline"><?php echo $footer_tagline;?></p>
          <?php endif;?>
          <?php if($footer_contact_info):?>
             <div class="contact-info">
              <?php foreach($footer_contact_info as $footer_info):?>
  <p class="d-flex align-items-start mb-1"><i class="bi bi-house"></i><?php echo $footer_info['footer_address'];?></p>
  <p class="d-flex align-items-center mb-1"><i class="bi bi-telephone"></i><?php echo $footer_info['footer_phone'];?></p>
  <p class="d-flex align-items-center mb-1"><i class="bi bi-whatsapp"></i> <?php echo $footer_info['footer_whatsapp'];?></p>
  <p class="d-flex align-items-center mb-1"><i class="bi bi-envelope"></i> </i> <?php echo $footer_info['footer_email'];?></p>
<?php endforeach;?>
</div>
<?php endif;?>
<?php if($footer_compliance_info):?>
          <div class="compliance-info mt-3">
            <?php foreach($footer_compliance_info as $footer_compliance):?>
             <p>Compliance Officer & Grievance Officer:</p>
          <p class="d-flex align-items-center mb-1"><i class="bi bi-person-fill"></i> <?php echo $footer_compliance['complinace_name'];?></p>
<p class="d-flex align-items-center mb-1"><i class="bi bi-envelope"></i> <?php echo $footer_compliance['complinace_email'];?></p>
<p class="d-flex align-items-center mb-1"><i class="bi bi-telephone"></i> <?php echo $footer_compliance['complinace_number'];?></p>
<?php endforeach;?>
          </div>
         <?php endif;?>
         <?php if (!empty($socials)) :?>
            <div class="social-links mt-4">
              <?php foreach ($socials as $social):?>
                <a href="<?php echo $social['social_url'];?>" target="_blank" aria-label="Instagram"><i class="bi <?php echo $social['social_icon'];?>"></i></a>
            <?php endforeach;?>
            </div>
          <?php endif;?>
          </div>
        </div>

        <div class="col-lg-5 addspace">
          <div class="footer-links-grid">
            <div class="row">
              <?php if ( $footer_nav_menu_first ) : ?>
              <div class="col-6 col-md-4">
                <h5><?php echo  $menu_title1;?></h5>
                <?php echo $footer_nav_menu_first;?>
              </div>
              <?php endif; ?>
              <?php if ( $footer_nav_menu_second ) : ?>
              <div class="col-6 col-md-4">
                <h5><?php echo  $menu_title2;?></h5>
                <?php echo $footer_nav_menu_second;?>
              </div>
              <?php endif; ?>
              <?php if ( $footer_nav_menu_third ) : ?>
              <div class="col-6 col-md-4">
                <h5><?php echo  $menu_title3;?></h5>
                <?php echo $footer_nav_menu_third;?>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4 addspace">
          <?php if($footer_sebi_info):?>
          <div class="footer-sebi-details">
            <?php echo $footer_sebi_info;?>
            <?php if($footer_sebi_office):?>
            <hr>
            <div class="row">
            <div class="col-lg-6">
               <?php echo $footer_sebi_office;?>
            </div>
          <div class="col-lg-6">
               <?php echo $footer_sebi_head_office;?>
            </div>
          </div>
         <?php endif;?>
          </div>
        <?php endif;?>
        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="row mb-3">
          <div class="col-12">
            <?php if($footer_disclaimer):?>
            <div class="footer-bottom-content">
              <?php echo wp_kses_post($footer_disclaimer);?>
            </div>
          <?php endif;?>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="footer-bottom-content text-center">
              <p class="mb-0">© <?php echo date("Y"); ?> <span class="sitename">Pavan Prajapati</span>. All rights reserved.</p>
              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a target="_blank" href="https://atulyaitsolutions.com/">Atulya IT Solutions</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </footer>
 <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php //echo do_shortcode('[elfsight_whatsapp_chat id="2"]');?>
  
  
  <!-- Elfsight WhatsApp Chat | Pavan Prajapati -->
<!-- <script src="https://elfsightcdn.com/platform.js" async></script>
<div class="elfsight-app-40ad08a7-343b-4675-b387-d312347bd0fb" data-elfsight-app-lazy></div> -->
<!-- <div class="wa-wrapper">

  
  <div class="wa-box" id="waBox">

    <div class="wa-header">
      <div>
        <strong>Pavan Prajapati</strong>
        <small>Online</small>
      </div>
      <span id="waClose">×</span>
    </div>

    <div class="wa-body">
      <div class="wa-message">...</div>
    </div>

    <div class="wa-action">
      <a href="https://wa.me/91XXXXXXXXXX?text=Hello" target="_blank">
        <i class="bi bi-whatsapp"></i> Start Chat
      </a>
    </div>

    <div class="wa-footer">
      <span>Free WhatsApp Chat Widget</span>
      <span>Remove Branding</span>
    </div>

  </div>

  
  <div class="wa-trigger" id="waTrigger">
    <i class="bi bi-whatsapp"></i> Ask for free demo
  </div>

</div> -->
  <!-- Preloader -->
 <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>