<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_decorated_list_items_block' );
  function register_decorated_list_items_block() {
Block::make( __( 'Decorated List Items' ) )
  ->add_fields( array(
    Field::make( 'text', 'dli_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'dli_top_subheading', __( 'Block Sub Heading' ) ),
    Field::make('checkbox', 'dli_disable_heading', 'Disable Headings'),
   // Field::make( 'rich_text', 'dli_content_text', __( 'Content' ) ),
     Field::make( 'text', 'dli_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
        Field::make( 'complex', 'dli_step_boxes', __( 'Content Items' ) )
      ->set_layout( 'tabbed-vertical' )
      ->add_fields( array(
        Field::make('text', 'dli_step_headings', 'Headings'),
        Field::make( 'rich_text', 'dli_step_content', __( 'Content' ) ),
      ) ),
       // 🔥 CALL YOUR GLOBAL FUNCTION HERE
                    Field::make('select', 'dli_padding', __('Padding'))
                    ->set_options(get_padding_options()),

            Field::make('select', 'dli_margin', __('Margin'))
                ->set_options(get_margin_options()),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'decorated' ), __( 'list' ), __( 'lists' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $dli_step_boxes = $fields['dli_step_boxes'];
     $padding = $fields['dli_padding'];
$margin  = $fields['dli_margin'];
    $pmclass = trim($padding . ' ' . $margin);
    ?>
    <!-- Hero Section -->
    <section class="content section portfolio-details <?php echo esc_attr($fields['dli_extra_classes'] ?? '');?> <?php echo esc_attr($pmclass); ?>">

  <div class="container" data-aos="fade-up">

    <?php if(empty($fields['dli_disable_heading'])):?>
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <!-- <span class="description-title"><?php echo $fields['serf_top_heading'];?></span>-->
        <h2><?php echo $fields['dli_top_heading'];?></h2> 
        <p><?php echo $fields['dli_top_subheading'];?></p>
      </div><!-- End Section Title -->
    <?php endif;?>

    <!-- Content -->
    <div class="content-body">
  <?php if($dli_step_boxes):?>
    <?php foreach($dli_step_boxes as $key => $dli_step_box):?>
            <div class="project-challenges aos-init aos-animate" data-aos="fade-left" data-aos-delay="400">
              <?php if(!empty($dli_step_box['dli_step_headings'])):?>
                <h3><?php echo $dli_step_box['dli_step_headings'];?></h3>
              <?php endif;?>
                <?php echo $dli_step_box['dli_step_content'];?>
              </div>
          <?php endforeach;?>
  <?php endif;?>

    </div>

  </div>

</section>
   
    <?php
  } );
  }
