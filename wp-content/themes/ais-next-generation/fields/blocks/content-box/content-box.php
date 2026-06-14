<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_content_box_block' );
  function register_content_box_block() {
Block::make( __( 'Content Box' ) )
  ->add_fields( array(
    Field::make( 'rich_text', 'content_text', __( 'Content' ) ),
     Field::make( 'text', 'lh_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'hero' ), __( 'slider' ), __( 'banner' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    ?>
    <!-- Hero Section -->
    <section class="content section">

  <div class="container" data-aos="fade-up">

    <!-- Content -->
    <div class="content-body">
<?php echo $fields['content_text'];?>

    </div>

  </div>

</section>
   
    <?php
  } );
  }
