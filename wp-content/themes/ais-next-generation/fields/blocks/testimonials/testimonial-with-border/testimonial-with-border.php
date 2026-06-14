<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_testimonial_with_border_block' );
  function register_testimonial_with_border_block() {
Block::make( __( 'Testimonials With Borders' ) )
  ->add_fields( array(
    Field::make( 'text', 'twb_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'twb_top_subheading', __( 'Block Sub Heading' ) ),
    // Repeater
    Field::make( 'complex', 'twb_testimonials', __( 'Content Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'twb_text', __( 'Text' ) ),
        Field::make( 'text', 'twb_star', __( 'Rating' ) ),
        Field::make( 'image', 'twb_user_image', __( 'User Image' ) ),
        Field::make( 'text', 'twb_user_name', __( 'User Name' ) ),
        Field::make( 'text', 'twb_user_designation', __( 'User Designation' ) ),
      ) ),
  Field::make( 'text', 'twb_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'testimonials' ), __( 'reviews' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $testimonials = $fields['twb_testimonials'] ?? [];
    ?>
     <!-- Testimonials Section -->
     <section id="testimonials" class="testimonials section <?php echo esc_attr($fields['twb_extra_classes'] ?? '');?>">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <!-- <span class="description-title"><?php echo $fields['serf_top_heading'];?></span>-->
        <h2><?php echo $fields['twb_top_heading'];?></h2> 
        <p><?php echo $fields['twb_top_subheading'];?></p>
      </div><!-- End Section Title -->
      
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        
        <div class="row">
          <div class="col-12">
           <?php if (!empty($testimonials)): ?>
            <div class="testimonials-container">
              <div class="swiper testimonials-slider init-swiper" data-aos="fade-up" data-aos-delay="400">

                <div class="swiper-wrapper">
                   <?php foreach ($testimonials as $item): 

      $text = $item['twb_text'] ?? '';
      $stars = (int) ($item['twb_star'] ?? 5);
      $image_id = $item['twb_user_image'] ?? '';

      $img_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';

      $alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
      $title = $image_id ? get_the_title($image_id) : '';

      $final_alt = $alt ?: $title;
      $name = $item['twb_user_name'] ?? '';
      $designation = $item['twb_user_designation'] ?? '';

      // If image is ID or URL
      $img_url = is_numeric($image_id) ? wp_get_attachment_image_url($image_id, 'full') : $img_url;

    ?>
                  <div class="swiper-slide">
                    <div class="testimonial-item">
                            <div class="stars">
                  <?php for ($i = 0; $i < $stars; $i++): ?>
                    <i class="bi bi-star-fill"></i>
                  <?php endfor; ?>
                </div>
                      <p>
                        <?php echo esc_html($text); ?>
                      </p>
                      <div class="testimonial-profile">
                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($name); ?>" class="img-fluid rounded-circle">
                        <div>
                          <h3><?php echo esc_html($name); ?></h3>
                          <h4><?php echo esc_html($designation); ?></h4>
                        </div>
                      </div>
                    </div>
                  </div><!-- End testimonial item -->

                 <?php endforeach;?>

                  

                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
          <?php endif;?>
          </div>
        </div>

       
      </div>
    </section><!-- /Testimonials Section -->
    <?php
  } );
  }
