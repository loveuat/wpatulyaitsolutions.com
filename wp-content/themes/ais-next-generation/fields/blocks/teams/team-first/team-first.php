<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_team_first_block' );
  function register_team_first_block() {
Block::make( __( 'Teams Theme 1' ) )
  ->add_fields( array(
    Field::make( 'text', 'team_top_heading', __( 'Block Heading' ) ),
    Field::make( 'text', 'team_top_subheading', __( 'Block Sub Heading' ) ),
    // Repeater
    Field::make( 'complex', 'team_users', __( 'Content Items' ) )
      ->set_layout( 'tabbed-horizontal' )
      ->add_fields( array(
        Field::make( 'text', 'team_text', __( 'Text' ) ),
        Field::make( 'text', 'team_star', __( 'Rating' ) ),
        Field::make( 'image', 'team_user_image', __( 'User Image' ) ),
        Field::make( 'text', 'team_user_name', __( 'User Name' ) ),
        Field::make( 'text', 'team_user_designation', __( 'User Designation' ) ),
         // ✅ INNER REPEATER
        Field::make( 'complex', 'team_social_links', __( 'Social Links' ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'icon', __( 'Icon Class' ) ),
                Field::make( 'text', 'url', __( 'URL' ) ),
            ) )
      ) ),
    
  ) )
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'testimonials' ), __( 'reviews' ), __( 'section' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

  $teams = $fields['team_users'] ?? [];
  $heading = $fields['team_top_heading'] ?? 'Team';
  $subheading = $fields['team_top_subheading'] ?? '';

?>

<section id="team" class="team section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <span class="description-title"><?php echo esc_html($heading); ?></span>
    <h2><?php echo esc_html($heading); ?></h2>
    <?php if ($subheading): ?>
      <p><?php echo esc_html($subheading); ?></p>
    <?php endif; ?>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row g-4">

      <?php if (!empty($teams)): 
        $delay = 200;
        foreach ($teams as $team):

          $name = $team['team_user_name'] ?? '';
          $designation = $team['team_user_designation'] ?? '';
          $text = $team['team_text'] ?? '';
          $image_id = $team['team_user_image'] ?? '';
          $socials = $team['team_social_links'] ?? [];

          // Image
          $img_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';
          $alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
          $title = $image_id ? get_the_title($image_id) : '';
          $final_alt = $alt ?: $title;

      ?>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
        <div class="team-member">

          <div class="member-image">

            <?php if ($image_id): ?>
              <?php echo wp_get_attachment_image($image_id, 'medium', false, [
                'class' => 'img-fluid',
                'alt'   => esc_attr($final_alt),
                'loading' => 'lazy'
              ]); ?>
            <?php endif; ?>

            <?php if (!empty($socials)): ?>
            <div class="social-overlay">
              <div class="social-icons">

                <?php foreach ($socials as $social): 
                  $icon = $social['icon'] ?? '';
                  $url = $social['url'] ?? '#';
                ?>

                  <a href="<?php echo esc_url($url); ?>" target="_blank">
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                  </a>

                <?php endforeach; ?>

              </div>
            </div>
            <?php endif; ?>

          </div>

          <div class="member-info">
            <?php if ($name): ?>
              <h4><?php echo esc_html($name); ?></h4>
            <?php endif; ?>

            <?php if ($designation): ?>
              <span><?php echo esc_html($designation); ?></span>
            <?php endif; ?>

            <?php if ($text): ?>
              <p><?php echo esc_html($text); ?></p>
            <?php endif; ?>
          </div>

        </div>
      </div>

      <?php 
        $delay += 100;
        endforeach; 
      endif; ?>

    </div>

  </div>

</section>

<?php
});
  }
