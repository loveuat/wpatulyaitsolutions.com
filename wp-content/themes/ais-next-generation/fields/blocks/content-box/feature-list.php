<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_feature_list_block' );
  function register_feature_list_block() {
Block::make( __( 'Feature Lists' ) )
  ->add_fields( array(
    Field::make( 'rich_text', 'fl_content_text', __( 'Content' ) ),
     Field::make( 'text', 'fl_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
        Field::make( 'complex', 'fl_feature_lists', __( 'Content Items' ) )
      ->set_layout( 'tabbed-vertical' )
      ->add_fields( array(
        Field::make('rich_text', 'feature_text', 'Headings')
      ) )
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'hero' ), __( 'slider' ), __( 'banner' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $fl_feature_lists = $fields['fl_feature_lists'];
    ?>
    <!-- Hero Section -->
    <section class="content section">

  <div class="container" data-aos="fade-up">

       <!-- Content -->
    <div class="content-body">
  <?php if($fl_feature_lists):?>
    <?php foreach($fl_feature_lists as $key => $fl_feature_list):?>
    <div class="feature-list row gy-3">
                  <div class="col-md-12" data-aos="fade-up" data-aos-delay="250">
                    <div class="feature-item align-items-center">
                      <i class="bi bi-check-circle"></i>
                      <div class="text">
                        <p><?php echo $fl_feature_list['feature_text'];?></p>
                      </div>
                    </div>
                  </div>
                </div>
          <?php endforeach;?>
  <?php endif;?>

    </div>

  </div>

</section>
   
    <?php
  } );
  }
