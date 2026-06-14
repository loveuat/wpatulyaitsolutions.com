<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_what_we_do_second_block' );
  function register_what_we_do_second_block() {
Block::make( __( 'What We Do Column Layout' ) )
  ->add_fields( array(
    //Field::make( 'text', 'wwdss_top_heading', __( 'Block Heading' ) ),
    //Field::make( 'rich_text', 'wwds_top_subheading', __( 'Block Sub Heading' ) ),
    Field::make('image', 'wwds_image', 'Image'),
    Field::make( 'checkbox', 'wwds_image_side', __( 'Use Image Left?' ) ),
      Field::make('complex', 'wwds_image_caption_box', 'Figure Caption Box')
    ->set_max(1) // 👈 makes it behave like a single group
    ->add_fields(array(
        Field::make('text', 'wwds_ic_text', 'Text'),
        Field::make('text', 'wwds_ic_small_text', 'Description'),
        Field::make('select', 'wwds_ic_icon', 'Select Icon')
       ->set_options(get_all_icons())
       ->set_classes('class', 'icon-select'),
    )),
          //Featured Text
    Field::make( 'text', 'wwds_featured_text', __( 'Featured Text' ) ),
    Field::make('select', 'wwds_featured_text_icon', 'Select Icon')
       ->set_options(get_all_icons())
       ->set_classes('class', 'icon-select'),
    Field::make( 'text', 'wwds_item_heading', __( 'Block Section Heading' ) ),
    
    // Repeater
    Field::make( 'complex', 'wwds_items', __( 'Content Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make('select', 'wwds_icon', 'Select Icon')
       ->set_options(get_all_icons()),
        Field::make( 'text', 'wwds_heading', __( 'Heading' ) ),
        Field::make( 'text', 'wwds_content', __( 'Content' ) ),
      ) ),
      //Lead Text
    Field::make( 'text', 'wwds_lead_text', __( 'Lead Text' ) ),

    // CTA Repeater
  Field::make( 'complex', 'wwds_ctas', __( 'Hero CTAs' ) )
    ->set_layout( 'tabbed-horizontal' )
    ->add_fields( array(
      Field::make( 'text', 'wwds_cta_text', __( 'Button Text' ) ),
      Field::make( 'text', 'wwds_cta_url', __( 'Button URL' ) ),
      Field::make( 'text', 'wwds_cta_class', __( 'Button Class' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
      Field::make('select', 'wwds_cta_icon', 'Select Icon')
       ->set_options(get_all_icons()),
       Field::make( 'checkbox', 'wwds_cta_icon_before', __( 'Use Icon Before' ) ),
    ) ),
  Field::make( 'text', 'wwds_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'about' ), __( 'about-one' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $wwds_items = $fields['wwds_items'] ?? [];
    $wwds_image = $fields['wwds_image'] ?? '';
    $wwds_experience_box = $fields['wwds_experience_box'] ?? [];
    $wwds_ctas = $fields['wwds_ctas'] ?? [];
    $wwds_image_url = wp_get_attachment_image_url($wwds_image, 'full') ?? [];
    $alt = get_post_meta($wwds_image, '_wp_attachment_image_alt', true);
    $image_title = get_the_title($wwds_image);
    $final_alt = !empty($alt) ? $alt : $image_title;
    ?>
      <!-- About Section -->
    <section id="about" class="about section <?php echo esc_attr($fields['wwds_extra_classes'] ?? '');?>">

      <!-- Section Title -->
      <!-- <div class="container section-title" data-aos="fade-up">
        <h2><?php //echo esc_html( $fields['wwds_top_heading'] ); ?></h2>
        <p><?php //echo  $fields['wwds_top_subheading']; ?></p>
      </div> -->
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 align-items-stretch">
          <?php if($wwds_image):?>
            <?php if (!empty($fields['wwds_image_side'])):?>
          <div class="col-lg-5 order-lg-1" data-aos="fade-left" data-aos-delay="200">
          <?php else: ?>
            <div class="col-lg-5 order-lg-2" data-aos="fade-left" data-aos-delay="200">
          <?php endif;?>
            <aside class="showcase">
              <figure class="showcase-main">
                <img src="<?php echo $wwds_image_url;?>" alt="<?php echo $final_alt;?>" class="img-fluid">
                <?php if($fields['wwds_image_caption_box']):?>
                <?php foreach($fields['wwds_image_caption_box'] as $boxvalue):?>
                  
                <figcaption class="badge-note" data-aos="zoom-in" data-aos-delay="350">
                  <i class="bi <?php echo $boxvalue['wwds_ic_icon'];?>"></i>
                  <div>
                    <strong><?php echo $boxvalue['wwds_ic_text'];?></strong>
                    <small><?php echo $boxvalue['wwds_ic_small_text'];?></small>
                  </div>
                </figcaption>
                <?php endforeach;?>
              <?php endif;?>
              </figure>
            </aside>
          </div>
        <?php endif;?>
          <?php if($wwds_items):?>
            <?php if (!empty($fields['wwds_image_side'])):?>
          <div class="col-lg-7 order-lg-2" data-aos="fade-right" data-aos-delay="200">
            <?php else: ?>
              <div class="col-lg-7 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                <?php endif;?>
            <article class="intro-card">
              <div class="intro-head">
                <?php if($fields['wwds_featured_text']):?>
                <span class="kicker"><i class="bi <?php echo esc_html( $fields['wwds_featured_text_icon'] ); ?> me-1"></i><?php echo esc_html( $fields['wwds_featured_text'] ); ?></span>
              <?php endif;?>
                <h2><?php echo esc_html( $fields['wwds_item_heading'] ); ?></h2>
              </div>

              <div class="intro-body">
                <div class="feature-list row gy-3">
                  <?php foreach($wwds_items as $wkey => $wwds_item):?>
                  <div class="col-md-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="feature-item align-items-center">
                      <i class="bi <?php echo esc_html($wwds_item['wwds_icon']);?>"></i>
                      <div class="text">
                        <h6><?php echo esc_html($wwds_item['wwds_heading']);?></h6>
                        <p><?php echo esc_html($wwds_item['wwds_content']);?></p>
                      </div>
                    </div>
                  </div>
                <?php endforeach;?>
                </div>

                <!-- <div class="metric-band" data-aos="fade-up" data-aos-delay="350">
                  <div class="metric">
                    <span class="value">9+</span>
                    <span class="label">Years</span>
                  </div>
                  <div class="divider"></div>
                  <div class="metric">
                    <span class="value">520</span>
                    <span class="label">Projects</span>
                  </div>
                  <div class="divider"></div>
                  <div class="metric">
                    <span class="value">30</span>
                    <span class="label">Experts</span>
                  </div>
                </div> -->
                <?php if($fields['wwds_lead_text']):?>
                <p class="lead_text"><?php echo esc_html( $fields['wwds_lead_text'] ); ?></p>
              <?php endif;?>
              <?php if($wwds_ctas):?>
                <div class="actions d-flex flex-wrap align-items-center gap-3" data-aos="fade-up" data-aos-delay="400">
                  <?php foreach( $wwds_ctas as $key => $wwds_cta):
                    if (!empty($wwds_cta['wwds_cta_icon_before'])):?>
                  <a href="<?php echo esc_html($wwds_cta['wwds_cta_url']);?>" class="btn <?php echo esc_html($wwds_cta['wwds_cta_class']);?>">
                    <i class="bi <?php echo esc_html($wwds_cta['wwds_cta_icon']);?> me-1"></i> <?php echo esc_html($wwds_cta['wwds_cta_text']);?>
                  </a>
                <?php else: ?>
                  <a href="<?php echo esc_html($wwds_cta['wwds_cta_url']);?>" class="btn <?php echo esc_html($wwds_cta['wwds_cta_class']);?>">
                    <?php echo esc_html($wwds_cta['wwds_cta_text']);?><i class="bi <?php echo esc_html($wwds_cta['wwds_cta_icon']);?>"></i>
                  </a>
                <?php endif;?>
                <?php endforeach;?> 
                </div>
              <?php endif;?>
              </div>
            </article>
          </div>
        <?php endif;?>
        </div>

      </div>

    </section><!-- /About Section -->
    <?php
  } );
  }
