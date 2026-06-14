<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_hero_third_block' );
  function register_hero_third_block() {
Block::make( __( 'Hero Theme 3' ) )
  ->add_fields( array(
    Field::make( 'text', 'htb_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'htb_top_subheading', __( 'Block Sub Heading' ) ),
    // Repeater
    Field::make( 'complex', 'htb_users', __( 'Content Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'htb_text', __( 'Text' ) ),
        Field::make( 'text', 'htb_star', __( 'Rating' ) ),
        Field::make( 'image', 'htb_user_image', __( 'User Image' ) ),
        Field::make( 'text', 'htb_user_name', __( 'User Name' ) ),
        Field::make( 'text', 'htb_user_designation', __( 'User Designation' ) ),
         // ✅ INNER REPEATER
        Field::make( 'complex', 'htb_social_links', __( 'Social Links' ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'icon', __( 'Icon Class' ) ),
                Field::make( 'text', 'url', __( 'URL' ) ),
            ) )
      ) ),
    
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'testimonials' ), __( 'reviews' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

  $htbs = $fields['htb_users'] ?? [];
  $heading = $fields['htb_top_heading'] ?? 'htb';
  $subheading = $fields['htb_top_subheading'] ?? '';

?>

<!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
              <h2>Strategic Solutions for Business Growth</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <div class="hero-btns">
                <a href="#contact" class="btn btn-primary">Get a Free Consultation</a>
                <a href="#services" class="btn btn-outline">Our Services</a>
              </div>
              <div class="hero-stats">
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                  <p>Years Experience</p>
                </div>
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                  <p>Clients Worldwide</p>
                </div>
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="1" class="purecounter"></span>%</h3>
                  <p>Success Rate</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
              <img src="assets/img/about/about-8.webp" alt="Consulting Services" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

<?php
});
  }
