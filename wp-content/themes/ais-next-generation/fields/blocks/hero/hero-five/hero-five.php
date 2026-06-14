<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_hero_five_block' );
  function register_hero_five_block() {
Block::make( __( 'Hero With Floated Images' ) )
  ->add_fields( array(
    Field::make( 'text', 'hfiveb_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'hfiveb_top_subheading', __( 'Block Sub Heading' ) ),
    Field::make( 'text', 'hfiveb_featured_text', __( 'Featured Text' ) ),
    Field::make('select', 'hfiveb_featured_text_icon', 'Select Icon')
       ->set_options(get_all_icons()),
    // Repeater
    Field::make( 'complex', 'hfiveb_lists', __( 'List Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'hfiveb_text', __( 'Text' ) ),
        Field::make('select', 'hfiveb_icon', 'Select Icon')
       ->set_options(get_all_icons()),
      ) ),
      Field::make( 'complex', 'hfiveb_floated_images', __( 'Floated Images' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->set_min(1) // minimum 1 required
    ->set_max(2) // maximum 2 allowed
      ->add_fields( array(
        Field::make( 'image', 'hfiveb_images', __( 'Images' ) ),
      ) ),
    Field::make( 'text', 'hfiveb_image_badge', __( 'Badge Text' ) ),
    Field::make('select', 'hfiveb_image_badge_icon', 'Select Icon')
       ->set_options(get_all_icons()),
      // CTA Repeater
  Field::make( 'complex', 'hfiveb_ctas', __( 'Hero CTAs' ) )
    ->set_layout( 'tabbed-horizontal' )
    ->add_fields( array(
      Field::make( 'text', 'hfiveb_cta_text', __( 'Button Text' ) ),
      Field::make( 'text', 'hfiveb_cta_url', __( 'Button URL' ) ),
      Field::make( 'text', 'hfiveb_cta_class', __( 'Button Class' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
      Field::make('select', 'hfiveb_cta_icon', 'Select Icon')
       ->set_options(get_all_icons()),
       Field::make( 'checkbox', 'hfiveb_icon_before', __( 'Use Icon Before' ) ),
    ) ),
  Field::make( 'text', 'hfiveb_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'testimonials' ), __( 'reviews' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

  $hfiveblists = $fields['hfiveb_lists'] ?? [];
  $hfiveb_ctas = $fields['hfiveb_ctas'] ?? [];
  $hfiveb_floated_images = $fields['hfiveb_floated_images'] ?? [];
   
?>
<!-- Hero Section -->
    <section id="hero" class="hero section <?php echo esc_attr($fields['hfiveb_extra_classes'] ?? '');?>">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center gy-5">
          <div class="col-lg-7">
            <div class="hero-card shadow-sm" data-aos="fade-right" data-aos-delay="150">
              <?php if($fields['hfiveb_featured_text']):?>
              <div class="eyebrow d-inline-flex align-items-center mb-3">
                <i class="bi <?php echo esc_html( $fields['hfiveb_featured_text_icon'] ); ?> me-2"></i>
                <span><?php echo esc_html( $fields['hfiveb_featured_text'] ); ?></span>
              </div>
            <?php endif;?>
              <div class="content">
                <h2 class="display-5 fw-bold mb-3 text-uppercase"><?php echo esc_html( $fields['hfiveb_top_heading'] ); ?></h2>
                <p class="lead mb-4"><?php echo esc_html( $fields['hfiveb_top_subheading'] ); ?></p>
                <?php if($hfiveb_ctas):?>
                <div class="d-flex flex-wrap gap-3">
                  <?php foreach($hfiveb_ctas as $hfiveb_cta):
                    if(!empty($hfiveb_cta['hfiveb_icon_before'])):?>
                  <a href="<?php echo esc_html( $hfiveb_cta['hfiveb_cta_url'] ); ?>" class="btn <?php echo esc_html( $hfiveb_cta['hfiveb_cta_class'] ); ?>">
                    <i class="bi  <?php echo $hfiveb_cta['hfiveb_cta_icon'] ; ?> ms-2"></i>
                    <span><?php echo esc_html( $hfiveb_cta['hfiveb_cta_text'] ); ?></span>
                  </a>
                <?php else:?>
                   <a href="<?php echo esc_html( $hfiveb_cta['hfiveb_cta_url'] ); ?>" class="btn <?php echo esc_html( $hfiveb_cta['hfiveb_cta_class'] ); ?>">
                    <span><?php echo esc_html( $hfiveb_cta['hfiveb_cta_text'] ); ?></span>
                    <i class="bi  <?php echo $hfiveb_cta['hfiveb_cta_icon'] ; ?> ms-2"></i>
                  </a>
                <?php endif;
               endforeach;?>
                </div>
              <?php endif;?>
                <?php if($hfiveblists):?>
                <div class="mini-stats d-flex flex-wrap gap-4 mt-4" data-aos="zoom-in" data-aos-delay="250">
                  <?php foreach ($hfiveblists as $key => $hfiveblist):?>
                  <div class="stat d-flex align-items-center">
                    <i class="bi <?php echo esc_html( $hfiveblist['hfiveb_icon'] ); ?> me-2"></i>
                    <span><?php echo $hfiveblist['hfiveb_text'];?></span>
                  </div>
                <?php endforeach;?>
                </div>
              <?php endif;?>
              </div>
            </div>
          </div>
          <?php if($hfiveb_floated_images):?>
          <div class="col-lg-5">
            <div class="media-stack" data-aos="zoom-in" data-aos-delay="200">
              <?php foreach($hfiveb_floated_images as $key => $hfiveb_floated_image):
                $image_class = '';
               if($key === 0){
                $image_class = 'primary';
               }else{
                $image_class = 'secondary';
               }
               $hfiveb_images = wp_get_attachment_image_url($hfiveb_floated_image['hfiveb_images'], 'full') ?? [];
                $alt = get_post_meta($hfiveb_images, '_wp_attachment_image_alt', true);
                $image_title = get_the_title($hfiveb_images);
                $final_alt = !empty($alt) ? $alt : $image_title;
                ?>
              <figure class="media <?php echo $image_class;?> shadow-sm">
                <img src="<?php echo $hfiveb_images;?>" class="img-fluid" alt="<?php echo $final_alt;?>">
              </figure>
            <?php endforeach;?>
            <?php if($fields['hfiveb_image_badge']):?>
              <div class="floating-badge d-flex align-items-center shadow-sm" data-aos="fade-down" data-aos-delay="300">
                <i class="bi <?php echo esc_html( $fields['hfiveb_image_badge_icon'] ); ?> me-2"></i>
                <span><?php echo esc_html( $fields['hfiveb_image_badge'] ); ?></span>
              </div>
            <?php endif;?>
            </div>
          </div>
        <?php endif;?>
        </div>

      </div>

    </section><!-- /Hero Section -->

<?php
});
  }
