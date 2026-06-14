<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_faq_first_block' );
  function register_faq_first_block() {
Block::make( __( 'FAQs Theme 1' ) )
  ->add_fields( array(
    Field::make( 'text', 'faq_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'faq_top_subheading', __( 'Block Sub Heading' ) ),
    // Repeater
    Field::make( 'complex', 'faq_items', __( 'Contact Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'faq_icon', __( 'Icon' ) ),
        Field::make( 'text', 'faq_heading', __( 'Heading' ) ),
        Field::make( 'text', 'faq_text', __( 'Description' ) ),
      ) ),
      Field::make( 'text', 'faq_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
    ))
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'contact' ), __( 'form' ), __( 'address' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $heading = $fields['faq_top_heading'] ?? 'FAQs';
  $subheading = $fields['faq_top_subheading'] ?? '';
  $faqs = $fields['faq_items'] ?? [];
    ?>
     <!-- Faq Section -->
    <section id="faq" class="faq section <?php echo esc_attr($fields['faq_extra_classes'] ?? '');?>">
       <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <!-- <span class="description-title"><?php echo $fields['serf_top_heading'];?></span>-->
        <h2><?php echo $fields['faq_top_heading'];?></h2> 
        <p><?php echo $fields['faq_top_subheading'];?></p>
      </div><!-- End Section Title -->
  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row justify-content-center">
      <div class="col-lg-10">

        <div class="faq-wrapper">

          <?php if (!empty($faqs)): 
            $i = 0;
            foreach ($faqs as $faq):

              $icon = $faq['faq_icon'] ?? 'bi bi-question-circle';
              $title = $faq['faq_heading'] ?? '';
              $desc = $faq['faq_text'] ?? '';

              // First item open by default
              $active_class = ($i === 0) ? 'faq-active' : '';
          ?>

          <div class="faq-item <?php echo $active_class; ?>">

            <div class="faq-header">
              
              <div class="faq-icon">
                <i class="<?php echo esc_attr($icon); ?>"></i>
              </div>

              <h4><?php echo esc_html($title); ?></h4>

              <div class="faq-toggle">
                <i class="bi bi-plus"></i>
                <i class="bi bi-dash"></i>
              </div>

            </div>

            <div class="faq-content">
              <div class="content-inner">
                <p><?php echo esc_html($desc); ?></p>
              </div>
            </div>

          </div><!-- End FAQ Item -->

          <?php 
            $i++;
            endforeach; 
          endif; ?>

        </div>

      </div>
    </div>

  </div>

</section>
<!-- /Faq Section -->
    <?php
  } );
  }
