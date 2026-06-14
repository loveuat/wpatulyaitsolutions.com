<?php
/* Template Name: Service Agreement Template */ 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

while ( have_posts() ) :
	the_post();
	?>

<main id="content" <?php post_class(['main']); ?>>
  <?php if(is_front_page()):?>
    <?php the_content(); ?>
  <?php else:?>
     <?php the_content(); ?>
  <?php endif;?>
  
	
	
	<!-- <?php //if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<div class="page-header">
			<?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	<?php //endif; ?> -->

	<div class="page-content">
		

		<?php //wp_link_pages(); ?>

		<?php //if ( has_tag() ) : ?>
		<!-- <div class="post-tags">
			<?php //the_tags( '<span class="tag-links">' . esc_html__( 'Tagged ', 'hello-elementor' ), ', ', '</span>' ); ?>
		</div> -->
		<?php //endif; ?>
	</div>

	<?php //comments_template(); ?>

</main>

	<?php
endwhile;
