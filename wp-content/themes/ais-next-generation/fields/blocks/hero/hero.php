<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_hero_block' );
	function register_hero_block() {
Block::make( __( 'Hero Section' ) )
	->add_fields( array(
		Field::make( 'text', 'heading', __( 'Block Heading' ) ),
		Field::make( 'text', 'subheading', __( 'Block Sub Heading' ) ),
		Field::make( 'textarea', 'blockdescription', __( 'Block Description' ) ),
		// Repeater
		Field::make( 'complex', 'hero_features', __( 'Hero Features' ) )
			->set_layout( 'tabbed-horizontal' )
			->add_fields( array(
				Field::make( 'text', 'boostrap_icon_code', __( 'Icon' ) ),
				Field::make( 'text', 'states_text', __( 'Number' ) ),
				Field::make( 'text', 'states_description', __( 'Text' ) ),
			) ),
		// CTA Repeater
	Field::make( 'complex', 'hero_ctas', __( 'Hero CTAs' ) )
		->set_layout( 'tabbed-horizontal' )
		->add_fields( array(
			Field::make( 'text', 'cta_text', __( 'Button Text' ) ),
			Field::make( 'text', 'cta_url', __( 'Button URL' ) ),
			Field::make( 'text', 'cta_class', __( 'Button Class' ) )
				->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
		) )
	) )
	->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
	->set_category( 'layout' )
	->set_icon( 'heart' )
	->set_keywords( [ __( 'hero' ), __( 'slider' ), __( 'banner' ) ] )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		?>
		<!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center gy-5">

          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="hero-content">
              <div class="hero-tag" data-aos="fade-up" data-aos-delay="250">
                <span class="tag-dot"></span>
                <span class="tag-text"><?php echo esc_html( $fields['subheading'] ); ?></span>
              </div>

              <h1 class="hero-headline" data-aos="fade-up" data-aos-delay="300"><?php echo esc_html( $fields['heading'] ); ?></h1>

              <p class="hero-text" data-aos="fade-up" data-aos-delay="350"><?php echo esc_html( $fields['blockdescription'] ); ?></p>

              <div class="hero-cta" data-aos="fade-up" data-aos-delay="400">
                <a href="#services" class="cta-button">
                  <span>Explore Services</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox cta-link" data-gallery="hero-video">
                  <i class="bi bi-play-circle"></i>
                  <span>Watch Video</span>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="stats-grid">
            	<?php if ( ! empty( $fields['hero_features'] ) ) : ?>

			    <?php foreach ( $fields['hero_features'] as $feature ) : ?>

			        <div class="stat-card stat-card-primary" data-aos="zoom-in" data-aos-delay="350">

			             <div class="stat-icon-wrap">
			                <i class="bi <?php echo esc_html( $feature['boostrap_icon_code']); ?>"></i>
			            </div>

			            <div class="stat-info">
			                <span class="stat-value"><?php echo esc_html( $feature['states_text'] ); ?></span>
			                <span class="stat-title"><?php echo esc_html( $feature['states_description'] ); ?></span>
			            </div>

			        </div>

			    <?php endforeach; ?>

			<?php endif; ?>
              
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Hero Section -->
		<?php
	} );
	}
