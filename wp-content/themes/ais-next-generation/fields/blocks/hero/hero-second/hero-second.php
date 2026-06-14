<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_hero_second_block' );
  function register_hero_second_block() {
Block::make( __( 'Hero With Large Text' ) )
  ->add_fields( array(
    Field::make( 'text', 'hs_heading', __( 'Block Heading' ) ),
    Field::make( 'textarea', 'hs_description', __( 'Block Description' ) ),
    Field::make('image', 'hs_bg_image', 'Background Image'),
    // Repeater
    Field::make( 'complex', 'hs_hero_features', __( 'Hero Theme 2 Features' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'hs_icon_code', __( 'Icon' ) ),
        Field::make( 'text', 'hs_states_text', __( 'Number' ) ),
        Field::make( 'text', 'hs_states_description', __( 'Text' ) ),
      ) ),
    // CTA Repeater
  Field::make( 'complex', 'hs_hero_ctas', __( 'Hero CTAs' ) )
    ->set_layout( 'tabbed-horizontal' )
    ->add_fields( array(
      Field::make( 'text', 'hs_cta_text', __( 'Button Text' ) ),
      Field::make( 'text', 'hs_cta_url', __( 'Button URL' ) ),
      Field::make( 'text', 'hs_cta_class', __( 'Button Class' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
        Field::make( 'radio', 'hs_cta_radio', 'Add Icon' )
                ->set_options( array(
                    'no' => 'No',
                    'yes' => 'Yes',
                ) ),
      Field::make( 'text', 'hs_cta_icon', 'Icon Code Text' )
                ->set_conditional_logic( array(
                    array(
                        'field' => 'hs_cta_radio',
                        'value' => 'yes',
                    )
                ) ),
    ) )
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'hero' ), __( 'slider' ), __( 'banner' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $ctas = $fields['hs_hero_ctas'] ?? [];
    $bg_image = $fields['hs_bg_image'] ?? '';
    $bg_image_url = wp_get_attachment_image_url($bg_image, 'full') ?? [];
    $alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);
    $image_title = get_the_title($bg_image);
    $final_alt = !empty($alt) ? $alt : $image_title;
    $hs_features = $fields['hs_hero_features'] ?? [];
    ?>
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
      <div class="hero-background">
        <div class="hero-overlay"></div>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center text-center">
          <div class="col-lg-10">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
              <h1><?php echo esc_html( $fields['hs_heading'] ); ?></h1>
              <p><?php echo esc_html( $fields['hs_description'] ); ?></p>
              <?php if (!empty($ctas)) : ?>
              <div class="hero-btns" data-aos="fade-up" data-aos-delay="300">
                <?php foreach($ctas as $cta): ?>
                <a href="<?php echo $cta['hs_cta_text'];?>" class="btn <?php echo $cta['hs_cta_class'];?>">
                  <?php if($cta['hs_cta_radio'] === 'yes'): ?>
                  <i class="bi bi-play-circle"></i>
                <?php endif;?>
                 <?php echo $cta['hs_cta_text'];?>
                </a>
              <?php endforeach; ?>
              </div>
            <?php endif;?>
            </div>
          </div>
        </div>
        <?php if ($bg_image):?>
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="hero-image-container" data-aos="zoom-in" data-aos-delay="400">
              <div class="hero-image">
                <img src="<?php echo $bg_image_url;?>" alt="<?php echo $final_alt;?>" class="img-fluid">
                <div class="image-decoration"></div>
              </div>
            </div>
          </div>
        </div>
        <?php endif;?>
        <?php if($hs_features):?>
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="hero-stats" data-aos="fade-up" data-aos-delay="500">
              <?php foreach($hs_features as $hs_feature): ?>
              <div class="stat-item">
                <div class="stat-icon">
                  <i class="bi <?php echo $hs_feature['hs_icon_code'];?>"></i>
                </div>
                <h3><span data-purecounter-start="0" data-purecounter-end="<?php echo intval($hs_feature['hs_states_text']);?>" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                <p><?php echo $hs_feature['hs_states_description'];?></p>
              </div>
            <?php endforeach;?>
            </div>
          </div>
        </div>
      <?php endif;?>
      </div>
    </section><!-- /Hero Section -->
    <?php
  } );
  }
