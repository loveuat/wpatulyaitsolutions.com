<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_about_one_block' );
  function register_about_one_block() {
Block::make( __( 'About Theme 1' ) )
  ->add_fields( array(
    Field::make( 'text', 'atf_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'atf_top_subheading', __( 'Block Sub Heading' ) ),
    Field::make( 'text', 'atf_section_heading', __( 'Block Section Heading' ) ),
    Field::make( 'text', 'atf_section_subheading', __( 'Block Section Sub Heading' ) ),
    Field::make('image', 'atf_image', 'Image'),
    Field::make( 'checkbox', 'enable_light_theme', 'Enabe Light Theme' ),
    // Repeater
    Field::make( 'complex', 'atf_items', __( 'Content Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'atf_icon', __( 'Icon' ) ),
        Field::make( 'text', 'atf_heading', __( 'Heading' ) ),
        Field::make( 'text', 'atf_text', __( 'Description' ) ),
      ) ),
      Field::make('complex', 'atf_experience_box', 'Experience Box')
    ->set_max(1) // 👈 makes it behave like a single group
    ->add_fields(array(
        Field::make('text', 'atf_exp_states', 'Number'),
        Field::make('text', 'atf_exp_text', 'Description'),
    )),
    // CTA Repeater
  Field::make( 'complex', 'atf_ctas', __( 'CTAs' ) )
    ->set_layout( 'tabbed-horizontal' )
    ->add_fields( array(
      Field::make( 'text', 'atf_cta_text', __( 'Button Text' ) ),
      Field::make( 'text', 'atf_cta_url', __( 'Button URL' ) ),
      Field::make( 'text', 'atf_cta_class', __( 'Button Class' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
        Field::make( 'radio', 'atf_cta_radio', 'Add Icon' )
                ->set_options( array(
                    'no' => 'No',
                    'yes' => 'Yes',
                ) ),
      Field::make( 'text', 'atf_cta_icon', 'Icon Code Text' )
                ->set_conditional_logic( array(
                    array(
                        'field' => 'atf_cta_radio',
                        'value' => 'yes',
                    )
                ) ),
    ) )
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'about' ), __( 'about-one' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $atf_items = $fields['atf_items'] ?? [];
    $atf_image = $fields['atf_image'] ?? '';
    $atf_experience_box = $fields['atf_experience_box'] ?? [];
    $atf_ctas = $fields['atf_ctas'] ?? [];
    $atf_image_url = wp_get_attachment_image_url($atf_image, 'full') ?? [];
    $alt = get_post_meta($atf_image, '_wp_attachment_image_alt', true);
    $image_title = get_the_title($atf_image);
    $final_alt = !empty($alt) ? $alt : $image_title;
    ?>
    <!-- About Section -->
    <section id="about" class="about section <?php echo !empty($fields['enable_light_theme']) ? 'light-background' : ''; ?>">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="description-title"><?php echo esc_html( $fields['atf_top_heading'] ); ?></span>
        <h2><?php echo esc_html( $fields['atf_top_heading'] ); ?></h2>
        <p><?php echo esc_html( $fields['atf_top_subheading'] ); ?></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gx-0 gx-lg-5 gy-5 align-items-center">
          <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="200">
            <div class="image-wrapper">
              <div class="image-box">
                <img src="<?php echo $atf_image_url;?>" class="img-fluid" alt="<?php echo $final_alt;?>" loading="lazy">
              </div>
              <?php if($atf_experience_box):?>
              <div class="experience-box" data-aos="zoom-in" data-aos-delay="300">
                <div class="years"><?php echo $atf_experience_box['atf_exp_states'];?></div>
                <div class="text"><?php echo $atf_experience_box['atf_exp_text'];?></div>
              </div>
            <?php endif;?>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
            <div class="content">
              <div class="section-header">
                <h2><?php echo esc_html( $fields['atf_section_heading'] ); ?></h2>
              </div>

              <p class="highlight-text"><?php echo esc_html( $fields['atf_section_subheading'] ); ?></p>
              <?php if($atf_items):?>
              <div class="features-list">
                <?php foreach ($atf_items as $atf_item):?>
                <div class="feature-item" data-aos="zoom-in" data-aos-delay="300">
                  <div class="icon-box">
                    <i class="bi <?php echo $atf_item['atf_icon'];?>"></i>
                  </div>
                  <div class="text">
                    <h4><?php echo $atf_item['atf_heading'];?></h4>
                    <p><?php echo $atf_item['atf_text'];?></p>
                  </div>
                </div>
              <?php endforeach;?>
              </div>
            <?php endif;?>
            <?php if($atf_ctas):?>
              <div class="cta-buttons">
                <?php foreach($atf_ctas as $atf_cta):?>
                <a href="<?php echo $atf_cta['atf_cta_url'];?>" class="<?php echo $atf_cta['atf_cta_class'];?>"><?php echo $atf_cta['atf_cta_text'];?></a>
              <?php endforeach;?>
              </div>
            <?php endif;?>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->
    <?php
  } );
  }
