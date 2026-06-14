<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_colorful_stats_block' );
  function register_colorful_stats_block() {
Block::make( __( 'Colorful Stats' ) )
  ->add_fields( array(
    Field::make( 'text', 'clrs_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'clrs_top_subheading', __( 'Block Sub Heading' ) ),
    Field::make('checkbox', 'clrs_disable_heading', 'Disable Headings'),
   // Field::make( 'rich_text', 'clrs_content_text', __( 'Content' ) ),
     Field::make( 'text', 'clrs_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
        Field::make( 'complex', 'clrs_step_boxes', __( 'Content Items' ) )
      ->set_layout( 'tabbed-verticle' )
      ->add_fields( array(
        Field::make('text', 'clrs_step_headings', 'Headings'),
        Field::make( 'rich_text', 'clrs_step_content', __( 'Content' ) ),
      ) ),
       // 🔥 CALL YOUR GLOBAL FUNCTION HERE
                    Field::make('select', 'clrs_padding', __('Padding'))
                    ->set_options(get_padding_options()),

            Field::make('select', 'clrs_margin', __('Margin'))
                ->set_options(get_margin_options()),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'decorated' ), __( 'list' ), __( 'lists' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $clrs_step_boxes = $fields['clrs_step_boxes'];
     $padding = $fields['clrs_padding'];
$margin  = $fields['clrs_margin'];
    $pmclass = trim($padding . ' ' . $margin);
    ?>
    <!-- Hero Section -->
    <section class="content section portfolio-details <?php echo esc_attr($fields['clrs_extra_classes'] ?? '');?> <?php echo esc_attr($pmclass); ?>">

  <div class="container" data-aos="fade-up">

    <?php if(empty($fields['clrs_disable_heading'])):?>
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <!-- <span class="description-title"><?php echo $fields['serf_top_heading'];?></span>-->
        <h2><?php echo $fields['clrs_top_heading'];?></h2> 
        <p><?php echo $fields['clrs_top_subheading'];?></p>
      </div><!-- End Section Title -->
    <?php endif;?>

    <!-- Content -->
    <div class="content-body">
  <?php if($clrs_step_boxes):?>
    <?php foreach($clrs_step_boxes as $key => $clrs_step_box):?>
            <div class="project-challenges aos-init aos-animate" data-aos="fade-left" data-aos-delay="400">
              <?php if(!empty($clrs_step_box['clrs_step_headings'])):?>
                <h3><?php echo $clrs_step_box['clrs_step_headings'];?></h3>
              <?php endif;?>
                <?php echo $clrs_step_box['clrs_step_content'];?>
              </div>
          <?php endforeach;?>
  <?php endif;?>

    </div>

  </div>

</section>
   
    <?php
  } );
  }
