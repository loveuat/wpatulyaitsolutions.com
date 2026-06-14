<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_contact_first_block' );
  function register_contact_first_block() {
Block::make( __( 'Contact Theme 1' ) )
  ->add_fields( array(
    Field::make( 'text', 'cfb_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'cfb_top_subheading', __( 'Block Sub Heading' ) ),
    Field::make('checkbox', 'cfb_disable_heading', 'Disable Headings'),
    Field::make( 'text', 'cfb_section_heading', __( 'Block Section Heading' ) ),
    Field::make( 'text', 'cfb_section_subheading', __( 'Block Section Sub Heading' ) ),
    Field::make('image', 'cfb_image', 'Image'),
    // Repeater
    Field::make( 'complex', 'cfb_items', __( 'Contact Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'cfb_icon', __( 'Icon' ) ),
        Field::make( 'text', 'cfb_heading', __( 'Heading' ) ),
        Field::make( 'text', 'cfb_text', __( 'Description' ) ),
      ) ),
      // Contact Social Icons
    Field::make( 'complex', 'cfb_social_social_items', __( 'Social Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'cfb_social_icon', __( 'Icon' ) ),
        Field::make( 'text', 'cfb_social_link', __( 'Links' ) ),
      ) ),
   Field::make('checkbox', 'cfb_enable_map', 'Show Map'),
   Field::make('textarea', 'cfb_map_code', 'Map Code'),
   Field::make( 'text', 'cfb_form_heading', __( 'Form Heading' ) ),
    Field::make( 'text', 'cfb_form_subheading', __( 'Form Sub Heading' ) ),
   Field::make('text', 'cfb_form_shortcode', 'Choose Form'),
 Field::make( 'text', 'cfb_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'contact' ), __( 'form' ), __( 'address' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
     $cfb_items = $fields['cfb_items'] ?? [];
     $cfb_social_social_items = $fields['cfb_social_social_items'] ?? '';
    // $cfb_experience_box = $fields['cfb_experience_box'] ?? [];
    // $cfb_ctas = $fields['cfb_ctas'] ?? [];
    // $cfb_image_url = wp_get_attachment_image_url($cfb_image, 'full') ?? [];
    // $alt = get_post_meta($cfb_image, '_wp_attachment_image_alt', true);
    // $image_title = get_the_title($cfb_image);
    // $final_alt = !empty($alt) ? $alt : $image_title;
    ?>
     <!-- Contact Section -->
    <section id="contact" class="contact section <?php echo esc_attr($fields['cfb_extra_classes'] ?? '');?>">
      <?php if(empty($fields['cfb_disable_heading'])):?>
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <!-- <span class="description-title"><?php echo $fields['serf_top_heading'];?></span>-->
        <h2><?php echo $fields['cfb_top_heading'];?></h2> 
        <p><?php echo $fields['cfb_top_subheading'];?></p>
      </div><!-- End Section Title -->
    <?php endif;?>
      <div class="container">
        <?php if (!empty($fields['cfb_items'])):?>
        <div class="contact-wrapper layout-two">
        <?php else:?>
          <div class="contact-wrapper layout-one">
        <?php endif;?>
          <?php if (!empty($fields['cfb_items'])):?>
          <div class="contact-info-panel">
            <div class="contact-info-header">
              <h3><?php echo $fields['cfb_section_heading'];?></h3>
              <p><?php echo $fields['cfb_section_subheading'];?></p>
            </div>
            <?php if($cfb_items):?>
            <div class="contact-info-cards">
              <?php foreach($cfb_items  as $cfb_item):?>
              <div class="info-card">
                <div class="icon-container">
                  <i class="bi <?php echo $cfb_item['cfb_icon'];?> "></i>
                </div>
                <div class="card-content">
                  <h4><?php echo $cfb_item['cfb_heading'];?></h4>
                  <p><?php echo $cfb_item['cfb_text'];?></p>
                </div>
              </div>
            <?php endforeach;?>
            </div>
          <?php endif;?>
          <?php if($cfb_social_social_items):?>
            <div class="social-links-panel">
              <h5>Follow Us</h5>
              <div class="social-icons">
                <?php foreach($cfb_social_social_items as $cfb_social_social_item):?>
                <a href="<?php echo $cfb_social_social_item['cfb_social_link'];?>"><i class="bi <?php echo $cfb_social_social_item['cfb_social_icon'];?>"></i></a>
              <?php endforeach;?>
              </div>
            </div>
          <?php endif;?>
          </div>
        <?php endif;?>
          <div class="contact-form-panel">
            <?php if (!empty($fields['cfb_enable_map'])):?>
            <div class="map-container">
              <?php echo $fields['cfb_map_code'];?>
            </div>
          <?php endif;?>
            <div class="form-container">
              <h3><?php echo $fields['cfb_form_heading'];?></h3>
              <p><?php echo $fields['cfb_form_subheading'];?></p>
              <?php echo do_shortcode($fields['cfb_form_shortcode']);?>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Contact Section -->
    <?php
  } );
  }


