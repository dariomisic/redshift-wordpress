<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package redshift
 */
?>

     <?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'redshift' ),
				'after'  => '</div>',
			) );
		?>












