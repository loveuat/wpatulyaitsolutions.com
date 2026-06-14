<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_hero_four_block' );
  function register_hero_four_block() {
Block::make( __( 'Hero Theme 4' ) )
  ->add_fields( array(
    Field::make( 'text', 'hfb_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'hfb_top_subheading', __( 'Block Sub Heading' ) ),
    // Repeater
    Field::make( 'complex', 'hfb_users', __( 'Content Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'hfb_text', __( 'Text' ) ),
        Field::make( 'text', 'hfb_star', __( 'Rating' ) ),
        Field::make( 'image', 'hfb_user_image', __( 'User Image' ) ),
        Field::make( 'text', 'hfb_user_name', __( 'User Name' ) ),
        Field::make( 'text', 'hfb_user_designation', __( 'User Designation' ) ),
         // ✅ INNER REPEATER
        Field::make( 'complex', 'hfb_social_links', __( 'Social Links' ) )
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

  $hfbs = $fields['hfb_users'] ?? [];
  $heading = $fields['hfb_top_heading'] ?? 'hfb';
  $subheading = $fields['hfb_top_subheading'] ?? '';

?>

 <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="cta-wrapper">
          <div class="content-block">
            <div class="row align-items-center">
              <div class="col-lg-7">
                <div class="text-content" data-aos="fade-right" data-aos-delay="200">
                  <div class="section-label" data-aos="fade-up" data-aos-delay="250">
                    <span>Transform Your Vision</span>
                  </div>

                  <h2 data-aos="fade-up" data-aos-delay="300">
                    Elevate Your Business
                    <span class="accent-text">Beyond Expectations</span>
                  </h2>

                  <p data-aos="fade-up" data-aos-delay="350">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis.</p>

                  <div class="benefits-list" data-aos="fade-up" data-aos-delay="400">
                    <div class="benefit-row">
                      <div class="benefit-item">
                        <div class="check-icon">
                          <i class="bi bi-check2"></i>
                        </div>
                        <span>Premium Quality Service</span>
                      </div>
                      <div class="benefit-item">
                        <div class="check-icon">
                          <i class="bi bi-check2"></i>
                        </div>
                        <span>Expert Consultation</span>
                      </div>
                    </div>
                    <div class="benefit-row">
                      <div class="benefit-item">
                        <div class="check-icon">
                          <i class="bi bi-check2"></i>
                        </div>
                        <span>Scalable Solutions</span>
                      </div>
                      <div class="benefit-item">
                        <div class="check-icon">
                          <i class="bi bi-check2"></i>
                        </div>
                        <span>Continuous Support</span>
                      </div>
                    </div>
                  </div>

                  <div class="action-group" data-aos="fade-up" data-aos-delay="450">
                    <a href="#" class="btn btn-primary-action">Start Your Journey</a>
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn btn-text-link glightbox">
                      <i class="bi bi-play-circle-fill"></i>
                      See How It Works
                    </a>
                  </div>

                  <div class="trust-indicators" data-aos="fade-up" data-aos-delay="500">
                    <div class="indicator">
                      <div class="metric">12K+</div>
                      <div class="label">Projects Completed</div>
                    </div>
                    <div class="separator"></div>
                    <div class="indicator">
                      <div class="metric">98%</div>
                      <div class="label">Client Satisfaction</div>
                    </div>
                    <div class="separator"></div>
                    <div class="indicator">
                      <div class="metric">24/7</div>
                      <div class="label">Expert Support</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-5">
                <div class="visual-section" data-aos="fade-left" data-aos-delay="300">
                  <div class="image-container">
                    <img src="assets/img/cta/cta-4.webp" alt="Business Growth" class="main-visual">

                    <div class="floating-badge badge-1" data-aos="zoom-in" data-aos-delay="600">
                      <div class="badge-icon">
                        <i class="bi bi-award-fill"></i>
                      </div>
                      <div class="badge-text">
                        <div class="badge-title">Award Winner</div>
                        <div class="badge-subtitle">Best Solution 2024</div>
                      </div>
                    </div>

                    <div class="floating-badge badge-2" data-aos="zoom-in" data-aos-delay="700">
                      <div class="badge-icon">
                        <i class="bi bi-people-fill"></i>
                      </div>
                      <div class="badge-text">
                        <div class="badge-title">25K+</div>
                        <div class="badge-subtitle">Active Users</div>
                      </div>
                    </div>
                  </div>

                  <div class="decorative-elements">
                    <div class="element element-1"></div>
                    <div class="element element-2"></div>
                    <div class="element element-3"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Call To Action Section -->

<?php
});
  }
