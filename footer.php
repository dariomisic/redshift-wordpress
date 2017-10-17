<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package redshift
 */
?>
			</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
		</div><!-- close .row -->
	</div><!-- close .container -->
</div><!-- close .main-content -->


<footer style="width:100%; margin-top:50px;" role="contentinfo">
<?php // substitute the class "container-fluid" below if you want a wider content area ?>

			

<div style="position: relative;   top:-129px;    left: 0;    right:0;    z-index: 1;    pointer-events:none;">
<svg style="fill:#222; position:relative; left:0;" fill-opacity="1" height="80px" shape-rendering="geometricPrecision" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="100%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path> 
</svg>
</div> <!-- svg black image -->

<div class="container">
	<div class="row">
	<div class="col-md-12">

<?php

if(ot_get_option('redshift_top')=="on")
{


?>

	<div style="position:absolute; top:-150px; left:50%;" class="su">
	<div class="animate"><a href="javascript:scroll_top()" class="team team-rs-right" style="margin-left:-30px; font-size:60px; line-height:60px; color:#f4543c; -ms-transform: rotate(-90deg);
    -webkit-transform: rotate(-90deg); transform: rotate(-90deg);"></a></div> <!-- .animate button scroll_top -->
	</div> <!-- .su -->


<?php

}


?>


	<ul class="social wow flipInX">


<?php

$social=array("dribbble","twitter","facebook","pinterest","flickr","google-plus","tumblr","github");

foreach($social as $icon)
{

if(ot_get_option($icon))
echo '<li><a href="'.ot_get_option($icon).'" aria-hidden="true" class="icon-'.$icon.'" target="_blank"></a></li>';

}

?>

	</ul>
</div> <!-- .col-md-12 .col-xs-12 .col-sm-12 -->
</div> <!-- .row -->
</div> <!-- .container -->


		<div class="site-info">
					<?php do_action( 'redshift_credits' );

					echo ot_get_option('redshift_copyright');

					 ?>
					
				</div> <!-- close .site-info -->
</footer><!-- close #colophon -->
<?php wp_footer(); ?>


<?php echo ot_get_option('redshift_code'); ?>

</body>
</html>
