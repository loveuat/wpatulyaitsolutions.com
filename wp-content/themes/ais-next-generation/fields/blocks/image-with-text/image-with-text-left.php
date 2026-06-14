<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_image_with_text_block' );
  function register_image_with_text_block() {
Block::make( __( 'Image With Text' ) )
  ->add_fields( array(
    //Field::make( 'text', 'iwt_top_heading', __( 'Block Heading' ) ),
    //Field::make( 'rich_text', 'iwt_top_subheading', __( 'Block Sub Heading' ) ),
    Field::make('image', 'iwt_image', 'Image'),
     //Featured Text
    Field::make( 'text', 'iwt_featured_text', __( 'Featured Text' ) ),
   Field::make('select', 'iwt_featured_text_icon', 'Select Icon')
      ->set_options(get_all_icons())
      ->set_classes('class', 'icon-select'),
   Field::make( 'text', 'iwt_item_heading', __( 'Block Section Heading' ) ),
    Field::make( 'rich_text', 'iwt_content_box', __( 'Content' ) ),
    Field::make( 'checkbox', 'iwt_image_side', __( 'Use Image Left?' ) ),
      Field::make('complex', 'iwt_image_caption_box', 'Figure Caption Box')
    ->set_max(1) // 👈 makes it behave like a single group
    ->add_fields(array(
        Field::make('text', 'iwt_ic_text', 'Text'),
        Field::make('text', 'iwt_ic_small_text', 'Description'),
        Field::make('select', 'iwt_ic_icon', 'Select Icon')
       ->set_options(get_all_icons())
       ->set_classes('class', 'icon-select'),
    )),
         
    
    // Repeater
    // Field::make( 'complex', 'iwt_items', __( 'Content Items' ) )
    //   ->set_layout( 'tabbed-horizontal' )
    //   ->add_fields( array(
    //     Field::make('select', 'iwt_icon', 'Select Icon')
    //    ->set_options(get_all_icons()),
    //     Field::make( 'text', 'iwt_heading', __( 'Heading' ) ),
    //   ) ),
      //Lead Text
   // Field::make( 'text', 'iwt_lead_text', __( 'Lead Text' ) ),

    // CTA Repeater
  Field::make( 'complex', 'iwt_ctas', __( 'Hero CTAs' ) )
    ->set_layout( 'tabbed-horizontal' )
    ->add_fields( array(
      Field::make( 'text', 'iwt_cta_text', __( 'Button Text' ) ),
      Field::make( 'text', 'iwt_cta_url', __( 'Button URL' ) ),
      Field::make( 'text', 'iwt_cta_class', __( 'Button Class' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
      Field::make('select', 'iwt_cta_icon', 'Select Icon')
       ->set_options(get_all_icons()),
       Field::make( 'checkbox', 'iwt_cta_icon_before', __( 'Use Icon Before' ) ),
    ) ),
  Field::make( 'text', 'iwt_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'about' ), __( 'about-one' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $iwt_content_box = $fields['iwt_content_box'] ?? '';
    $iwt_image = $fields['iwt_image'] ?? '';
    $iwt_experience_box = $fields['iwt_experience_box'] ?? [];
    $iwt_ctas = $fields['iwt_ctas'] ?? [];
    $iwt_image_url = wp_get_attachment_image_url($iwt_image, 'full') ?? [];
    $alt = get_post_meta($iwt_image, '_wp_attachment_image_alt', true);
    $image_title = get_the_title($iwt_image);
    $final_alt = !empty($alt) ? $alt : $image_title;
    ?>
      <!-- About Section -->
    <section id="about" class="about section <?php echo esc_attr($fields['iwt_extra_classes'] ?? '');?>">

      <!-- Section Title -->
      <!-- <div class="container section-title" data-aos="fade-up">
        <h2><?php //echo esc_html( $fields['iwt_top_heading'] ); ?></h2>
        <p><?php //echo  $fields['iwt_top_subheading']; ?></p>
      </div> -->
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 align-items-stretch">
          <?php if($iwt_image):?>
            <?php if (!empty($fields['iwt_image_side'])):?>
          <div class="col-lg-5 order-lg-1" data-aos="fade-left" data-aos-delay="200">
          <?php else: ?>
            <div class="col-lg-5 order-lg-2" data-aos="fade-left" data-aos-delay="200">
          <?php endif;?>
            <aside class="showcase">
              <figure class="showcase-main">
                <img src="<?php echo $iwt_image_url;?>" alt="<?php echo $final_alt;?>" class="img-fluid">
                <?php if($fields['iwt_image_caption_box']):?>
                <?php foreach($fields['iwt_image_caption_box'] as $boxvalue):?>
                  
                <figcaption class="badge-note" data-aos="zoom-in" data-aos-delay="350">
                  <i class="bi <?php echo $boxvalue['iwt_ic_icon'];?>"></i>
                  <div>
                    <strong><?php echo $boxvalue['iwt_ic_text'];?></strong>
                    <small><?php echo $boxvalue['iwt_ic_small_text'];?></small>
                  </div>
                </figcaption>
                <?php endforeach;?>
              <?php endif;?>
              </figure>
            </aside>
          </div>
        <?php endif;?>
          <?php if($iwt_content_box):?>
            <?php if (!empty($fields['iwt_image_side'])):?>
          <div class="col-lg-7 order-lg-2" data-aos="fade-right" data-aos-delay="200">
            <?php else: ?>
              <div class="col-lg-7 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                <?php endif;?>
            <article class="intro-card">
              <div class="intro-head">
                <?php if($fields['iwt_featured_text']):?>
                <span class="kicker"><i class="bi <?php echo esc_html( $fields['iwt_featured_text_icon'] ); ?> me-1"></i><?php echo esc_html( $fields['iwt_featured_text'] ); ?></span>
              <?php endif;?>
                <h2><?php echo esc_html( $fields['iwt_item_heading'] ); ?></h2>
              </div>

              <div class="intro-body">
                <div class="feature-list row gy-3">
                  <?php //foreach($iwt_items as $wkey => $iwt_item):?>
                  <div class="col-md-12" data-aos="fade-up" data-aos-delay="250">
                    <div class="feature-item align-items-center">
                      <!-- <i class="bi <?php //echo esc_html($iwt_item['iwt_icon']);?>"></i> -->
                      <div class="text">
                        <!-- <h6><?php //echo esc_html($iwt_item['iwt_heading']);?></h6> -->
                        <!-- <p>Index & Stock Options Research with defined strategy framework and risk parameters</p> -->
                        <?php echo  $fields['iwt_content_box']; ?>
                      </div>
                    </div>
                  </div>
                <?php //endforeach;?>
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
                <?php //if($fields['iwt_lead_text']):?>
                <!-- <p class="lead_text"><?php //echo esc_html( $fields['iwt_lead_text'] ); ?></p> -->
              <?php  //endif;?>
              <?php if($iwt_ctas):?>
                <div class="actions d-flex flex-wrap align-items-center gap-3" data-aos="fade-up" data-aos-delay="400">
                  <?php foreach( $iwt_ctas as $key => $iwt_cta):
                    if (!empty($iwt_cta['iwt_cta_icon_before'])):?>
                  <a href="<?php echo esc_html($iwt_cta['iwt_cta_url']);?>" class="btn <?php echo esc_html($iwt_cta['iwt_cta_class']);?>">
                    <i class="bi <?php echo esc_html($iwt_cta['iwt_cta_icon']);?> me-1"></i> <?php echo esc_html($iwt_cta['iwt_cta_text']);?>
                  </a>
                <?php else: ?>
                  <a href="<?php echo esc_html($iwt_cta['iwt_cta_url']);?>" class="btn <?php echo esc_html($iwt_cta['iwt_cta_class']);?>">
                    <?php echo esc_html($iwt_cta['iwt_cta_text']);?><i class="bi <?php echo esc_html($iwt_cta['iwt_cta_icon']);?>"></i>
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
