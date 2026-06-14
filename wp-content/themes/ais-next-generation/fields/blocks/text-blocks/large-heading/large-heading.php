<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_large_heading_block' );
  function register_large_heading_block() {
Block::make( __( 'Large Heading' ) )
  ->add_fields( array(
    Field::make( 'text', 'lh_heading', __( 'Block Heading' ) ),
    Field::make( 'textarea', 'lh_description', __( 'Block Description' ) ),
     Field::make( 'text', 'lh_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'hero' ), __( 'slider' ), __( 'banner' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    ?>
    <!-- Hero Section -->
    <section id="hero" class="hero section <?php echo esc_attr($fields['lh_extra_classes'] ?? '');?>">
      <div class="hero-background">
        <div class="hero-overlay"></div>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center text-center">
          <div class="col-lg-10">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
              <h2><?php echo esc_html( $fields['lh_heading'] ); ?></h2>
              <p><?php echo esc_html( $fields['lh_description'] ); ?></p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->
    <?php
  } );
  }
