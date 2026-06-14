<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_who_we_are_block' );
	function register_who_we_are_block() {
Block::make( __( 'Who We Are Section' ) )
	->add_fields( array(
		Field::make( 'text', 'wwa_heading', __( 'Block Heading' ) ),
		Field::make( 'text', 'wwa_subheading', __( 'Block Sub Heading' ) ),
		Field::make( 'textarea', 'wwa_blockleadtext', __( 'Block Lead text' ) ),
		Field::make( 'textarea', 'wwa_blockdescription', __( 'Block Description' ) ),
		Field::make( 'image', 'wwa_main_image', __( 'Block Main Image' ) ),
		Field::make( 'image', 'wwa_offset_image', __( 'Block Offset Image' ) ),
		// Repeater
		Field::make( 'complex', 'wwa_features', __( 'Who We Are Features' ) )
			->set_layout( 'tabbed-horizontal' )
			->add_fields( array(
				Field::make( 'text', 'wwa_boostrap_icon_code', __( 'Icon' ) ),
				Field::make( 'text', 'wwa_features_text', __( 'Features Title' ) ),
			) ),
			// Repeater
		Field::make( 'complex', 'wwa_states', __( 'WWA States' ) )
			->set_layout( 'tabbed-horizontal' )
			->add_fields( array(
				Field::make( 'text', 'wwa_states_number', __( 'Number' ) ),
				Field::make( 'text', 'wwa_states_title', __( 'States Title' ) ),
			) ),
		// CTA Repeater
	Field::make( 'complex', 'wwa_ctas', __( 'WWA CTAs' ) )
		->set_layout( 'tabbed-horizontal' )
		->add_fields( array(
			Field::make( 'text', 'cta_text', __( 'Button Text' ) ),
			Field::make( 'text', 'cta_url', __( 'Button URL' ) ),
			Field::make( 'text', 'cta_class', __( 'Button Class' ) )
				->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
		) ),
	Field::make( 'complex', 'wwa_experience_badge', __( 'Experience Badge' ) )
    ->set_layout( 'tabbed-horizontal' )
    ->set_max(1)
    ->add_fields( array(
        Field::make( 'text', 'wwa_exp_number', __( 'Number' ) )->set_default_value('12+'),
        Field::make( 'text', 'wwa_exp_text', __( 'Text' ) )->set_default_value('Years Experience'),
    ) ),
    Field::make( 'complex', 'wwa_contact_info', __( 'Contact Info' ) )
    ->set_layout( 'tabbed-horizontal' )
    ->set_max(1)
    ->add_fields( array(
    	Field::make( 'text', 'wwa_ci_boostrap_icon_code', __( 'Icon' ) ),
        Field::make( 'text', 'wwa_ci_text', __( 'Contact Info Text' ) ),
        Field::make( 'text', 'wwa_ci_calling_text', __( 'Contact Number' ) ),
    ) )
	) )
	->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
	->set_category( 'layout' )
	->set_icon( 'heart' )
	->set_keywords( [ __( 'hero' ), __( 'slider' ), __( 'banner' ) ] )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		?>
		 <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5 align-items-center">

          <div class="col-xl-6 aos-init aos-animate" data-aos="fade-right" data-aos-delay="200">
            <div class="about-images-wrapper">
              <div class="image-main">
                <img src="assets/img/about/about-5.webp" alt="Business meeting" class="img-fluid">
              </div>
              <div class="image-offset">
                <img src="assets/img/about/about-square-3.webp" alt="Detail shot" class="img-fluid">
              </div>
              <div class="experience-badge">
                <span class="years purecounter" data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1">12</span>
                <span class="text">Years of<br>Excellence</span>
              </div>
              <div class="shape-pattern"></div>
            </div>
          </div>

          <div class="col-xl-6 aos-init aos-animate" data-aos="fade-left" data-aos-delay="300">
            <div class="about-content">
              <div class="section-subtitle">Who We Are</div>
              <h2>Innovating for Your Success Through Technology</h2>
              <p class="lead-text">
                Voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
              </p>
              <p class="mb-4 description">
                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.
              </p>

              <div class="features-grid">
                <div class="feature-card">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>Fast Delivery</span>
                </div>
                <div class="feature-card">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>Quality Assured</span>
                </div>
                <div class="feature-card">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>Expert Team</span>
                </div>
                <div class="feature-card">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>24/7 Support</span>
                </div>
              </div>

              <div class="stats-row">
                <div class="stat-box">
                  <span class="number purecounter" data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1">150</span>
                  <span class="label">Projects Done</span>
                </div>
                <div class="stat-box">
                  <span class="number purecounter" data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1">85</span>
                  <span class="label">Happy Clients</span>
                </div>
                <div class="stat-box">
                  <span class="number purecounter" data-purecounter-start="0" data-purecounter-end="95" data-purecounter-duration="1">95%</span>
                  <span class="label">Retention</span>
                </div>
              </div>

              <div class="action-buttons">
                <a href="#" class="btn btn-primary-custom">
                  Discover More <i class="bi bi-arrow-right"></i>
                </a>
                <div class="contact-info">
                  <div class="icon-box">
                    <i class="bi bi-telephone-fill"></i>
                  </div>
                  <div class="text">
                    <span>Call Us Today</span>
                    <a href="tel:+15551234567">+1 (555) 123-4567</a>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->
		<?php
	} );
	}