<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_services_first_block' );
  function register_services_first_block() {
Block::make( __( 'Services Theme 1' ) )
  ->add_fields( array(
    Field::make( 'text', 'serf_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'serf_top_subheading', __( 'Block Sub Heading' ) ),
    // Repeater
    Field::make( 'complex', 'serf_items', __( 'Content Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'serf_icon', __( 'Icon' ) ),
        Field::make( 'text', 'serf_heading', __( 'Heading' ) ),
        Field::make( 'text', 'serf_text', __( 'Description' ) ),
        Field::make( 'text', 'serf_link_text', __( 'Link Text' ) ),
        Field::make( 'text', 'serf_link_url', __( 'Link Url' ) ),
        Field::make('checkbox', 'serf_link_url_new_tab', 'Open in new tab'),
      ) ),
      Field::make('checkbox', 'serf_quote_enable', 'Enable'),
      Field::make('complex', 'serf_quote_box', 'Quote Box')
    ->set_max(1) // 👈 makes it behave like a single group
    ->add_fields(array(
        
        Field::make('text', 'serf_quote_heading', 'Heading'),
        Field::make('text', 'serf_quote_text', 'Description'),
        Field::make('image', 'serf_quote_image', 'Image'),
        Field::make('text', 'serf_quote_cta_text', 'CTA Text'),
        Field::make('text', 'serf_quote_cta_url', 'CTA Url'),
        Field::make('checkbox', 'serf_quote_cta_url_new_tab', 'Open in new tab'),
        
    )),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'services' ), __( 'services-first' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $serf_items = $fields['serf_items'] ?? [];
    $enable = $fields['serf_quote_enable'] ?? false;
    $quote = $fields['serf_quote_box'][0] ?? [];
    $heading = $quote['serf_quote_heading'] ?? '';
    $text = $quote['serf_quote_text'] ?? '';
    $image = $quote['serf_quote_image'] ?? '';
    $cta_text = $quote['serf_quote_cta_text'] ?? '';
    $cta_url = $quote['serf_quote_cta_url'] ?? '';
    $cta_target = !empty($quote['serf_quote_cta_url_new_tab']) ? '_blank' : '_self';

    // Image handling
    $image_id = is_numeric($image) ? $image : ($image['id'] ?? '');

    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';

    $alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
    $title = $image_id ? get_the_title($image_id) : '';
    $final_alt = $alt ?: $title;
    ?>
    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="description-title"><?php echo $fields['serf_top_heading'];?></span>
        <h2><?php echo $fields['serf_top_heading'];?></h2>
        <p><?php echo $fields['serf_top_subheading'];?></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <?php if($serf_items):?>
        <div class="services-container">
          <div class="row g-4">
            <?php foreach ($serf_items as $key => $serf_item):?>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item">
                <div class="service-icon">
                  <i class="bi <?php echo $serf_item['serf_icon'];?>"></i>
                </div>
                <div class="service-content">
                  <span class="service-number">01</span>
                  <h3 class="service-title"><?php echo $serf_item['serf_heading'];?></h3>
                  <p class="service-text"><?php echo $serf_item['serf_text'];?></p>
                  <a href="<?php echo $serf_item['serf_link_url'];?>" class="service-link" target="<?php echo !empty($serf_item['serf_link_url_new_tab']) ? '_blank' : '_self'; ?>">
                    <?php echo $serf_item['serf_link_text'];?>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach;?>
          </div>
        </div>
      <?php endif; ?>
      <?php if(!empty($fields['serf_quote_enable']) && $quote) :?>
        <div class="cta-wrapper mt-5 text-center" data-aos="fade-up" data-aos-delay="100">
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <div class="cta-box">
        <div class="row align-items-center">

          <?php if ($image_url): ?>
          <div class="col-lg-4">
            <div class="cta-image" data-aos="zoom-in" data-aos-delay="200">
              <img 
                src="<?php echo esc_url($image_url); ?>" 
                alt="<?php echo esc_attr($final_alt); ?>" 
                class="img-fluid rounded-circle"
              >
            </div>
          </div>
          <?php endif; ?>

          <div class="col-lg-8">
            <div class="cta-content text-lg-start" data-aos="fade-left" data-aos-delay="300">

              <?php if ($heading): ?>
                <h3><?php echo esc_html($heading); ?></h3>
              <?php endif; ?>

              <?php if ($text): ?>
                <p><?php echo esc_html($text); ?></p>
              <?php endif; ?>

              <?php if ($cta_url && $cta_text): ?>
                <a 
                  href="<?php echo esc_url($cta_url); ?>" 
                  target="<?php echo esc_attr($cta_target); ?>" 
                  class="primary-btn"
                >
                  <?php echo esc_html($cta_text); ?>
                </a>
              <?php endif; ?>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
  <?php endif;?>
      </div>

    </section><!-- /Services Section -->
    <?php
  } );
  }
