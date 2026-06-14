<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_step_card_block' );
  function register_step_card_block() {
Block::make( __( 'Step Boxes' ) )
  ->add_fields( array(
     Field::make( 'text', 'sc_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'sc_top_subheading', __( 'Block Sub Heading' ) ),
    Field::make('checkbox', 'sc_disable_heading', 'Disable Headings'),
    Field::make( 'rich_text', 'content_text', __( 'Content' ) ),
     Field::make( 'text', 'sc_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
        Field::make( 'complex', 'step_boxes', __( 'Content Items' ) )
      ->set_layout( 'tabbed-vertical' )
      ->add_fields( array(
        Field::make('text', 'step_headings', 'Headings'),
        Field::make( 'rich_text', 'step_content', __( 'Content' ) ),
      ) ),
      // 🔥 CALL YOUR GLOBAL FUNCTION HERE
                    Field::make('select', 'sc_padding', __('Padding'))
                    ->set_options(get_padding_options()),

            Field::make('select', 'sc_margin', __('Margin'))
                ->set_options(get_margin_options()),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'hero' ), __( 'slider' ), __( 'banner' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $step_boxes = $fields['step_boxes'];
     $padding = $fields['dli_padding'];
$margin  = $fields['dli_margin'];
    $pmclass = trim($padding . ' ' . $margin);
    ?>
    <!-- Hero Section -->
    <section class="content section <?php echo esc_attr($fields['sc_extra_classes'] ?? '');?> <?php echo esc_attr($pmclass); ?>">

  <div class="container" data-aos="fade-up">

    <?php if(empty($fields['sc_disable_heading'])):?>
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2><?php echo $fields['sc_top_heading'];?></h2> 
        <p><?php echo $fields['sc_top_subheading'];?></p>
      </div><!-- End Section Title -->
    <?php endif;?>

    <!-- Content -->
    <div class="content-body">
  <?php if($step_boxes):?>
    <?php foreach($step_boxes as $key => $step_box):?>
    <div class="step-card mb-4">
              <span class="step-number"><?php echo $key+1;?></span>
              <h5 class="fw-bold mb-1"><?php echo $step_box['step_headings'];?></h5>
              <p class="mb-0"><?php echo $step_box['step_content'];?></p>
            </div>
          <?php endforeach;?>
  <?php endif;?>

    </div>

  </div>

</section>
   
    <?php
  } );
  }
