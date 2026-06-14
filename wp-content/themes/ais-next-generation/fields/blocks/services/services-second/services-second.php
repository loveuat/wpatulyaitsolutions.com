<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_service_second_block' );
  function register_service_second_block() {
Block::make( __( 'Service Theme 2' ) )
  ->add_fields( array(
    Field::make( 'text', 'ssb_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'ssb_top_subheading', __( 'Block Sub Heading' ) ),
    // Repeater
    Field::make( 'complex', 'ssb_users', __( 'Content Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'ssb_text', __( 'Text' ) ),
        Field::make( 'text', 'ssb_star', __( 'Rating' ) ),
        Field::make( 'image', 'ssb_user_image', __( 'User Image' ) ),
        Field::make( 'text', 'ssb_user_name', __( 'User Name' ) ),
        Field::make( 'text', 'ssb_user_designation', __( 'User Designation' ) ),
         // ✅ INNER REPEATER
        Field::make( 'complex', 'ssb_social_links', __( 'Social Links' ) )
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

  $ssbs = $fields['ssb_users'] ?? [];
  $heading = $fields['ssb_top_heading'] ?? 'ssb';
  $subheading = $fields['ssb_top_subheading'] ?? '';

?>

<!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">

          <!-- Service Card 1 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="bi bi-lightbulb"></i>
              </div>
              <h3>Strategic Consulting</h3>
              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
              <a href="service-details.html" class="service-link">
                <span>Discover More</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

          <!-- Service Card 2 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="bi bi-graph-up-arrow"></i>
              </div>
              <h3>Growth Analytics</h3>
              <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.</p>
              <a href="service-details.html" class="service-link">
                <span>Discover More</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

          <!-- Service Card 3 - Featured -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card featured">
              <div class="featured-badge">
                <i class="bi bi-star-fill"></i>
                <span>Popular</span>
              </div>
              <div class="icon-wrapper">
                <i class="bi bi-palette"></i>
              </div>
              <h3>Creative Design</h3>
              <p>Praesent commodo cursus magna vel scelerisque nisl consectetur et vivamus sagittis.</p>
              <a href="service-details.html" class="service-link">
                <span>Discover More</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

          <!-- Service Card 4 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="bi bi-code-slash"></i>
              </div>
              <h3>Web Development</h3>
              <p>Cras mattis consectetur purus sit amet fermentum aenean lacinia bibendum nulla sed.</p>
              <a href="service-details.html" class="service-link">
                <span>Discover More</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

          <!-- Service Card 5 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="bi bi-megaphone"></i>
              </div>
              <h3>Digital Marketing</h3>
              <p>Donec ullamcorper nulla non metus auctor fringilla vestibulum id ligula porta felis.</p>
              <a href="service-details.html" class="service-link">
                <span>Discover More</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

          <!-- Service Card 6 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="bi bi-shield-check"></i>
              </div>
              <h3>Security Solutions</h3>
              <p>Maecenas sed diam eget risus varius blandit sit amet non magna integer posuere erat.</p>
              <a href="service-details.html" class="service-link">
                <span>Discover More</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

        </div>

        <!-- Stats Row -->
        <div class="stats-row" data-aos="fade-up" data-aos-delay="400">
          <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
              <div class="stat-item">
                <span class="stat-number">250+</span>
                <span class="stat-label">Projects Delivered</span>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="stat-item">
                <span class="stat-number">98%</span>
                <span class="stat-label">Client Satisfaction</span>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="stat-item">
                <span class="stat-number">15+</span>
                <span class="stat-label">Years Experience</span>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="stat-item">
                <span class="stat-number">40+</span>
                <span class="stat-label">Team Experts</span>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Services Section -->

<?php
});
  }
