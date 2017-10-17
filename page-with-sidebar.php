<?php
/**
 * Template name: Page With Sidebar
 *
 * @package redshift
 */

get_header('page'); ?>

<div class="page-red" style="height:100px; width:100%; z-index: 1000; background-color:#f4543c; position:relative; top:0; text-align:center; margin-top: 20px; border-bottom:"><h5 class="page-title"><?php the_title(); ?></h5>

<div style="position: absolute;   top: -99px;    left: 0;    right:0;    z-index: 1000;    pointer-events:none;">
<svg class="chevron-red" style="fill:#f4543c; position:relative; left:0;" fill-opacity="1" height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="30%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path>
</svg>
</div> <!-- svg red image -->


<div style="position: absolute;   bottom:-6px;    left: 0;    right:0;    z-index: 1000;    pointer-events:none;">
<svg style="fill:#fff; position:relative; left:0;" fill-opacity="1" height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="30%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path>
</svg>
</div> <!-- svg white image -->


</div> <!-- .page-title -->

<div class="container">
<div class="row">
<div class="col-md-9 col-xs-12 col-sm-8" style="margin-top:50px;">


	<?php while ( have_posts() ) : the_post(); ?>


		<?php get_template_part( 'content', 'page' ); ?>

		

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			//if ( comments_open() || '0' != get_comments_number() )
				//comments_template();
		//?>

	<?php endwhile; // end of the loop. ?>

	</div> <!-- .col-md-9 col-xs-12 col-sm-8 -->


<?php get_sidebar(); ?>
</div> <!-- .row -->
</div> <!-- .container -->


<?php get_footer(); ?>
