<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_pricing_first_block' );
  function register_pricing_first_block() {
Block::make( __( 'Pricing Theme 1' ) )
  ->add_fields( array(
    Field::make( 'text', 'ptb_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'ptb_top_subheading', __( 'Block Sub Heading' ) ),
    Field::make('checkbox', 'ptb_disable_heading', 'Disable Headings'),
    // Repeater
    Field::make( 'complex', 'ptb_packages', __( 'Pricing Packages' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'ptb_name', __( 'Package Name' ) ),
        Field::make( 'textarea', 'ptb_description', __( 'Package Description' ) ),
        Field::make( 'rich_text', 'ptb_package_details', __( 'Package Details' ) )
        ->set_help_text( 'Example: service-list' ),
        Field::make( 'text', 'ptb_price_first', __( 'First Price' ) ),
        Field::make( 'text', 'ptb_price_second', __( 'Second Price' ) ),
        Field::make( 'text', 'ptb_price_duration', __( 'Duration' ) ),
        Field::make( 'text', 'ptb_cta_text', __( 'CTA Text' ) ),
        Field::make( 'text', 'ptb_cta_url', __( 'CTA Url' ) ),
        Field::make( 'text', 'ptb_cta_class', __( 'CTA Class' ) ),
  // ✅ INNER REPEATER
        Field::make( 'complex', 'ptb_details', __( 'Package Details' ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'ptb_detail_icon', __( 'Icon Class' ) ),
                Field::make( 'text', 'ptb_detail_text', __( 'Detail' ) ),
            ) )
      ) ),
    
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'pricing' ), __( 'packages' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $heading = $fields['ptb_top_heading'] ?? 'Pricing';
  $subheading = $fields['ptb_top_subheading'] ?? '';
  $packages = $fields['ptb_packages'] ?? [];
  //print_r($packages);
?>


<!-- Services Section -->
    <section id="services" class="services section">
      <?php if(empty($fields['ptb_disable_heading'])):?>
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <span class="description-title"><?php echo esc_html($heading); ?></span>
    <h2><?php echo esc_html($heading); ?></h2>
    <?php if ($subheading): ?>
      <p><?php echo esc_html($subheading); ?></p>
    <?php endif; ?>
  </div>
<?php endif;?>
     <?php if (!empty($packages)): ?>
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Services Grid -->
        <div class="row gy-5">
          <?php foreach ($packages as $key => $package):
            $price_first  = (float) preg_replace('/[^0-9.]/', '', $package['ptb_price_first']);
            $price_second = (float) preg_replace('/[^0-9.]/', '', $package['ptb_price_second']);?>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card">
              <div class="service-number"><?php echo $key+1;?></div>
              <div class="service-icon-wrapper">
                <div class="service-icon">
                  <i class="bi bi-laptop"></i>
                </div>
              </div>
              <div class="service-content">
                <h4><?php echo $package['ptb_name'];?></h4>
                <!-- <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam eaque ipsa.</p> -->
               <?php echo $package['ptb_package_details'];?>

                <div class="service-pricing mb-3">

    <?php if (!empty($package['ptb_price_second'])) : ?>

        <div class="price-wrap">

            <span class="original-price">
                ₹<?php echo $price_first; ?>
            </span>

            <span class="offer-price">
                ₹<?php echo $price_second; ?> 
            </span>
            <span class="offer-duration">
                / <?php echo $package['ptb_price_duration'];?>
            </span>
            <span class="discount-badge">
                OFFER
            </span>

        </div>

    <?php else : ?>

        <div class="price-wrap">
            <span class="offer-price">
                ₹<?php echo $price_first; ?> 
            </span>
            <span class="offer-duration">
                / <?php echo $package['ptb_price_duration'];?>
            </span>
        </div>

    <?php endif; ?>

    <a href="<?php echo esc_url($package['ptb_cta_url']); ?>" class="service-btn d-none">
        <span><?php echo esc_html($package['ptb_cta_text']); ?></span>
        <i class="bi bi-arrow-right"></i>
    </a>

</div>
                <p class="short_disclaimer"><strong>Disclaimer:</strong> Investments in the securities market are subject to market risks. Read all the related documents carefully before investing. Registration granted by SEBI and certification from NISM in no way guarantee performance of the intermediary or provide any assurance of returns to investors.</p>
              </div>
            </div>
          </div>
        <?php endforeach;?>
        </div>

      </div>
    <?php endif;?>
    </section><!-- /Services Section -->
<?php
});
  }
