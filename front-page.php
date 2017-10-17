<?php
/**
 * The template file Front Page.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package redshift
 */

get_header("front-page"); ?>

   <?php echo do_shortcode('[image-carousel]'); ?>


<div class="header-title"><div class="wow fadeInUp"><h1><span><?php echo ot_get_option('main_header'); ?></span></h1></div> <!-- title -->



<div style="position: absolute;   top: -79px;    left: 0;    right:0;    z-index: 1000;    pointer-events:none;">
<svg class="chevron-red" style="fill:#f4543c; position:relative; left:0;" fill-opacity="1" height="80px" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="100%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path>
</svg>
</div> <!-- svg red image -->




<div style="position: absolute;   bottom:-6px;    left: 0;    right:0;    z-index: 1000;    pointer-events:none;">
<svg style="fill:#fff; position:relative; left:0;" fill-opacity="1" height="70px" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="100%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path>
</svg>
</div> <!-- svg white image -->

</div>

<div class="container-fluid">

<?php // substitute the class "container-fluid" below if you want a wider content area ?>


	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'front-page' ); ?>

		<?php endwhile; ?>

		<?php redshift_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'front-page' ); ?>

	<?php endif; ?>


<?php print_r(ot_get_option( 'demo_background' )) ?>


</div>

<?php get_footer(); ?>