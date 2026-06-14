<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

while ( have_posts() ) :
	the_post();
	$page_subheading = carbon_get_post_meta(get_the_ID(), 'page_subheading');
	?>

<main id="content" <?php post_class(['main']); ?>>
  <?php if(is_front_page()):?>
    <?php the_content(); ?>
  <?php else:?>
  	 <!-- Page Title -->
    <div class="page-title">
      <?php echo my_custom_breadcrumb();?>
      <div class="title-wrapper section-title">
        <h2><?php echo get_the_title();?></h2>
        <?php if($page_subheading):?> 
        <p><?php echo $page_subheading;?></p>
      <?php endif;?>
      </div>
    </div><!-- End Page Title -->
    <div class="wppages" data-aos="fade-up">
     <?php the_content(); ?>
   </div>
  <?php endif;?>
  
	
	
	<!-- <?php //if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<div class="page-header">
			<?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	<?php //endif; ?> -->

	<!-- <div class="page-content"> -->
		

		<?php //wp_link_pages(); ?>

		<?php //if ( has_tag() ) : ?>
		<!-- <div class="post-tags">
			<?php //the_tags( '<span class="tag-links">' . esc_html__( 'Tagged ', 'hello-elementor' ), ', ', '</span>' ); ?>
		</div> -->
		<?php //endif; ?>
	<!-- </div> -->

	<?php //comments_template(); ?>

</main>

	<?php
endwhile;
