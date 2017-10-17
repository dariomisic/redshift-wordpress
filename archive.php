<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package redshift
 */

get_header('page'); ?>

<div style="height:100px; width:100%; z-index: 1000; background-color:#f4543c; position:relative; top:0; text-align:center; margin-top: 20px; border-bottom:"><h5 class="page-title"><?php the_title(); ?></h5>


<div style="position: absolute;   top: -100px;    left: 0;    right:0;    z-index: 1000;    pointer-events:none;">
<svg style="fill:#f4543c; position:relative; left:0;" fill-opacity="1" height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="30%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path>
</svg>
</div> <!-- svg red image -->


<div style="position: absolute;   bottom:-5px;    left: 0;    right:0;    z-index: 1000;    pointer-events:none;">
<svg style="fill:#fff; position:relative; left:0;" fill-opacity="1" height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="30%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path>
</svg>
</div> <!-- svg white image -->

</div> <!-- .page-title -->

	<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
<div class="container">
<div class="row">
<div class="col-md-9 col-xs-12 col-sm-8">

		<?php if ( have_posts() ) : ?>

			<header>
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
							printf( __( 'Author: %s', 'redshift' ), '<span class="vcard">' . get_the_author() . '</span>' );
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'redshift' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'redshift' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'redshift' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'redshift' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'redshift');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'redshift' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'redshift' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'redshift' );

						else :
							_e( 'Archives', 'redshift' );

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php redshift_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

	</div> <!-- .col-md-9 .col-xs-12 .col-sm-8 -->


<?php get_sidebar(); ?>

</div> <!-- .row -->
</div> <!-- .container -->

<?php get_footer(); ?>
