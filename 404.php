<?php
/**
 * Template name: Displaying 404 pages (Not Found).
 *
 * @package redshift
 */

get_header('page'); ?>

<div style="height:100px; width:100%; z-index: 1000; background-color:#f4543c; position:relative; top:0; text-align:center; margin-top: 20px; border-bottom:"><h5 class="page-title">404 Not Found</h5>

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

<div>
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container">
		<div class="row">

	    <?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
	<section class="content-padder error-404 not-found">

	<div class="center wow fadeInUp">
                <h1>404</h1>
        <div class="divider"></div> <!-- .divider -->
    </div> <!-- .center -->
		<header>
			<h2 class="page-title"><?php _e( 'Oops! Something went wrong here.', 'redshift' ); ?></h2>
		</header><!-- .page-header -->

		<div class="page-content">

			<p><?php _e( 'Nothing could be found at this location. Maybe try a search?', 'redshift' ); ?></p>

			<?php get_search_form(); ?>

		</div><!-- .page-content -->

	</section><!-- .content-padder -->
</div> <!-- .row -->
</div> <!-- .container -->
</div>

<?php get_footer(); ?>