<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_testimonial_first_block' );
  function register_testimonial_first_block() {
Block::make( __( 'Testimonial Theme 1' ) )
  ->add_fields( array(
    Field::make( 'text', 'tmb_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'tmb_top_subheading', __( 'Block Sub Heading' ) ),
    // Repeater
    Field::make( 'complex', 'tmb_testimonials', __( 'Content Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'tmb_text', __( 'Text' ) ),
        Field::make( 'text', 'tmb_star', __( 'Rating' ) ),
        Field::make( 'image', 'tmb_user_image', __( 'User Image' ) ),
        Field::make( 'text', 'tmb_user_name', __( 'User Name' ) ),
        Field::make( 'text', 'tmb_user_designation', __( 'User Designation' ) ),
      ) ),
  
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'testimonials' ), __( 'reviews' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $testimonials = $fields['tmb_testimonials'] ?? [];
    ?>
     <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="description-title"><?php echo $fields['tmb_top_heading'];?></span>
        <h2><?php echo $fields['tmb_top_heading'];?></h2>
        <p><?php echo $fields['tmb_top_subheading'];?></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <?php if (!empty($testimonials)): ?>
<div class="testimonials-slider swiper init-swiper">
  
  <div class="swiper-wrapper">

    <?php foreach ($testimonials as $item): 

      $text = $item['tmb_text'] ?? '';
      $stars = (int) ($item['tmb_star'] ?? 5);
      $image_id = $item['tmb_user_image'] ?? '';

      $img_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';

      $alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
      $title = $image_id ? get_the_title($image_id) : '';

      $final_alt = $alt ?: $title;
      $name = $item['tmb_user_name'] ?? '';
      $designation = $item['tmb_user_designation'] ?? '';

      // If image is ID or URL
      $img_url = is_numeric($image_id) ? wp_get_attachment_image_url($image_id, 'full') : $img_url;

    ?>

    <div class="swiper-slide">
      <div class="testimonial-card">

        <div class="testimonial-content">
          <p>
            <i class="bi bi-quote quote-icon"></i>
            <?php echo esc_html($text); ?>
          </p>
        </div>

        <div class="testimonial-profile">

          <!-- ⭐ Rating -->
          <div class="rating">
            <?php for ($i = 0; $i < $stars; $i++): ?>
              <i class="bi bi-star-fill"></i>
            <?php endfor; ?>
          </div>

          <div class="profile-info">
            <?php if ($img_url): ?>
              <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($name); ?>">
            <?php endif; ?>

            <div>
              <h3><?php echo esc_html($name); ?></h3>
              <h4><?php echo esc_html($designation); ?></h4>
            </div>
          </div>

        </div>

      </div>
    </div>

    <?php endforeach; ?>

  </div>

  <div class="swiper-pagination"></div>

</div>
<?php endif; ?>

      </div>

    </section><!-- /Testimonials Section -->
    <?php
  } );
  }
