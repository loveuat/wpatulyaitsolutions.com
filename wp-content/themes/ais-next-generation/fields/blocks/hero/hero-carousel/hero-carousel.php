<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_hero_carousel_block' );
	function register_hero_carousel_block() {
Block::make( __( 'Hero Carousel Block' ) )
	->add_fields([

        Field::make('complex', 'hc_slides', 'Carousel Slides')
            ->set_layout('tabbed-horizontal')
            ->add_fields([

                Field::make('image', 'hc_bg_image', 'Background Image'),

                Field::make('text', 'hc_heading', 'Heading'),
                Field::make('textarea', 'hc_description', 'Description'),

                // CTA Repeater
                Field::make('complex', 'hc_ctas', 'CTAs')
                    ->set_layout('tabbed-horizontal')
                    ->add_fields([
                        Field::make('text', 'hc_cta_text', 'Button Text'),
                        Field::make('text', 'hc_cta_url', 'Button URL'),
                        Field::make('text', 'hc_cta_class', 'Button Class')
                            ->set_help_text('ex: btn-primary'),
                    ])

            ])
    ])
	->set_description( __( 'Hero Slider' ) )
	->set_category( 'layout' )
	->set_icon( 'heart' )
	->set_keywords( [ __( 'hero' ), __( 'slider' ), __( 'banner' ), __( 'carousel' ) ] )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

  $slides = $fields['hc_slides'] ?? [];
$carousel_id = 'hc-carousel-' . wp_unique_id();
 if (!empty($slides)) : ?>
 <section id="blog-hero" class="blog-hero section">
<div class="container-fluid p-0" data-aos="fade">

    <div class="blog-hero-slider swiper">

      <div class="swiper-wrapper">

        <?php if (!empty($slides)): 
          foreach ($slides as $slide):

            $image_id = $slide['hc_bg_image'] ?? '';
            $heading = $slide['hc_heading'] ?? '';
            $desc = $slide['hc_description'] ?? '';
            $ctas = $slide['hc_ctas'] ?? [];

        ?>

        <div class="swiper-slide">
          <div class="blog-hero-item">

            <!-- Image -->
            <?php if ($image_id): ?>
              <?php echo wp_get_attachment_image($image_id, 'full', false, [
                'class' => 'img-fluid',
                'loading' => 'lazy'
              ]); ?>
            <?php endif; ?>

            <div class="blog-hero-content">

              <?php if ($heading): ?>
                <h1><?php echo esc_html($heading); ?></h1>
              <?php endif; ?>

              <?php if ($desc): ?>
                <p><?php echo esc_html($desc); ?></p>
              <?php endif; ?>

              <!-- CTA Buttons -->
              <?php if (!empty($ctas)): ?>
                <div class="hero-ctas">
                  <?php foreach ($ctas as $cta):

                    $text = $cta['hc_cta_text'] ?? '';
                    $url = $cta['hc_cta_url'] ?? '#';
                    $class = $cta['hc_cta_class'] ?? 'read-more';

                  ?>

                    <a href="<?php echo esc_url($url); ?>" class="<?php echo esc_attr($class); ?>">
                      <?php echo esc_html($text); ?> 
                      <i class="bi bi-arrow-right"></i>
                    </a>

                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

            </div>

          </div>
        </div>

        <?php endforeach; endif; ?>

      </div>

      <!-- Navigation -->
      <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
      <div class="swiper-pagination"></div>

    </div>

  </div>

</section><!-- /Hero Section -->

<?php endif;
	} );
	}