<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_what_we_do_first_block' );
  function register_what_we_do_first_block() {
Block::make( __( 'What We Do Right Image' ) )
  ->add_fields( array(
    Field::make( 'text', 'wwd_top_heading', __( 'Block Heading' ) ),
    Field::make( 'rich_text', 'wwd_top_subheading', __( 'Block Sub Heading' ) ),
    Field::make('image', 'wwd_image', 'Image'),
    Field::make( 'checkbox', 'wwd_image_side', __( 'Use Image Left?' ) ),
      Field::make('complex', 'wwd_image_caption_box', 'Figure Caption Box')
    ->set_max(1) // 👈 makes it behave like a single group
    ->add_fields(array(
        Field::make('text', 'wwd_ic_text', 'Text'),
        Field::make('text', 'wwd_ic_small_text', 'Description'),
        Field::make('select', 'wwd_ic_icon', 'Select Icon')
       ->set_options(get_all_icons())
       ->set_classes('class', 'icon-select'),
    )),
          //Featured Text
    Field::make( 'text', 'wwd_featured_text', __( 'Featured Text' ) ),
    Field::make('select', 'wwd_featured_text_icon', 'Select Icon')
       ->set_options(get_all_icons())
       ->set_classes('class', 'icon-select'),
    Field::make( 'text', 'wwd_item_heading', __( 'Block Section Heading' ) ),
    
    // Repeater
    Field::make( 'complex', 'wwd_items', __( 'Content Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make('select', 'wwd_icon', 'Select Icon')
       ->set_options(get_all_icons()),
        Field::make( 'text', 'wwd_heading', __( 'Heading' ) ),
      ) ),
      //Lead Text
    Field::make( 'text', 'wwd_lead_text', __( 'Lead Text' ) ),

    // CTA Repeater
  Field::make( 'complex', 'wwd_ctas', __( 'Hero CTAs' ) )
    ->set_layout( 'tabbed-horizontal' )
    ->add_fields( array(
      Field::make( 'text', 'wwd_cta_text', __( 'Button Text' ) ),
      Field::make( 'text', 'wwd_cta_url', __( 'Button URL' ) ),
      Field::make( 'text', 'wwd_cta_class', __( 'Button Class' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
      Field::make('select', 'wwd_cta_icon', 'Select Icon')
       ->set_options(get_all_icons()),
       Field::make( 'checkbox', 'wwd_cta_icon_before', __( 'Use Icon Before' ) ),
    ) ),
  Field::make( 'text', 'wwd_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'about' ), __( 'about-one' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $wwd_items = $fields['wwd_items'] ?? [];
    $wwd_image = $fields['wwd_image'] ?? '';
    $wwd_experience_box = $fields['wwd_experience_box'] ?? [];
    $wwd_ctas = $fields['wwd_ctas'] ?? [];
    $wwd_image_url = wp_get_attachment_image_url($wwd_image, 'full') ?? [];
    $alt = get_post_meta($wwd_image, '_wp_attachment_image_alt', true);
    $image_title = get_the_title($wwd_image);
    $final_alt = !empty($alt) ? $alt : $image_title;
    ?>
      <!-- About Section -->
    <section id="about" class="about section <?php echo esc_attr($fields['wwd_extra_classes'] ?? '');?>">

      <!-- Section Title -->
      <?php if (!empty($fields['wwd_top_heading'])):?>
      <div class="container section-title" data-aos="fade-up">
        <h2><?php echo esc_html( $fields['wwd_top_heading'] ); ?></h2>
        <p><?php echo  $fields['wwd_top_subheading']; ?></p>
      </div><!-- End Section Title -->
    <?php endif;?>
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 align-items-stretch">
          <?php if($wwd_image):?>
            <?php if (!empty($fields['wwd_image_side'])):?>
          <div class="col-lg-5 order-lg-1" data-aos="fade-left" data-aos-delay="200">
          <?php else: ?>
            <div class="col-lg-5 order-lg-2" data-aos="fade-left" data-aos-delay="200">
          <?php endif;?>
            <aside class="showcase">
              <figure class="showcase-main">
                <img src="<?php echo $wwd_image_url;?>" alt="<?php echo $final_alt;?>" class="img-fluid">
                <?php if($fields['wwd_image_caption_box']):?>
                <?php foreach($fields['wwd_image_caption_box'] as $boxvalue):?>
                  
                <figcaption class="badge-note" data-aos="zoom-in" data-aos-delay="350">
                  <i class="bi <?php echo $boxvalue['wwd_ic_icon'];?>"></i>
                  <div>
                    <strong><?php echo $boxvalue['wwd_ic_text'];?></strong>
                    <small><?php echo $boxvalue['wwd_ic_small_text'];?></small>
                  </div>
                </figcaption>
                <?php endforeach;?>
              <?php endif;?>
              </figure>
            </aside>
          </div>
        <?php endif;?>
          <?php if($wwd_items):?>
            <?php if (!empty($fields['wwd_image_side'])):?>
          <div class="col-lg-7 order-lg-2" data-aos="fade-right" data-aos-delay="200">
            <?php else: ?>
              <div class="col-lg-7 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                <?php endif;?>
            <article class="intro-card">
              <div class="intro-head">
                <?php if($fields['wwd_featured_text']):?>
                <span class="kicker"><i class="bi <?php echo esc_html( $fields['wwd_featured_text_icon'] ); ?> me-1"></i><?php echo esc_html( $fields['wwd_featured_text'] ); ?></span>
              <?php endif;?>
                <h2><?php echo esc_html( $fields['wwd_item_heading'] ); ?></h2>
              </div>

              <div class="intro-body">
                <div class="feature-list row gy-3">
                  <?php foreach($wwd_items as $wkey => $wwd_item):?>
                  <div class="col-md-12" data-aos="fade-up" data-aos-delay="250">
                    <div class="feature-item align-items-center">
                      <i class="bi <?php echo esc_html($wwd_item['wwd_icon']);?>"></i>
                      <div class="text">
                        <h6><?php echo esc_html($wwd_item['wwd_heading']);?></h6>
                        <!-- <p>Index & Stock Options Research with defined strategy framework and risk parameters</p> -->
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
                <?php if($fields['wwd_lead_text']):?>
                <p class="lead_text"><?php echo esc_html( $fields['wwd_lead_text'] ); ?></p>
              <?php endif;?>
              <?php if($wwd_ctas):?>
                <div class="actions d-flex flex-wrap align-items-center gap-3" data-aos="fade-up" data-aos-delay="400">
                  <?php foreach( $wwd_ctas as $key => $wwd_cta):
                    if (!empty($wwd_cta['wwd_cta_icon_before'])):?>
                  <a href="<?php echo esc_html($wwd_cta['wwd_cta_url']);?>" class="btn <?php echo esc_html($wwd_cta['wwd_cta_class']);?>">
                    <i class="bi <?php echo esc_html($wwd_cta['wwd_cta_icon']);?> me-1"></i> <?php echo esc_html($wwd_cta['wwd_cta_text']);?>
                  </a>
                <?php else: ?>
                  <a href="<?php echo esc_html($wwd_cta['wwd_cta_url']);?>" class="btn <?php echo esc_html($wwd_cta['wwd_cta_class']);?>">
                    <?php echo esc_html($wwd_cta['wwd_cta_text']);?><i class="bi <?php echo esc_html($wwd_cta['wwd_cta_icon']);?>"></i>
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
