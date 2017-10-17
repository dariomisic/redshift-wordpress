<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package redshift
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


	<?php if (ot_get_option('redshift_favicon')) {

		echo '<link rel="shortcut icon" href="'.ot_get_option('redshift_favicon').'" />';
	} ?>

	<?php wp_head(); ?>

<style>
.navbar-custom.top-nav-collapse .navbar-brand {
background-image: url("<?php echo ot_get_option('redshift_logo_collapsed'); ?>") !important;
}
</style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom" <?php body_class(); ?>>
  <!-- Preloader -->
  <div id="preloader">
    <div id="load"></div>
  </div>


<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>

					<!-- Your site title as branding in the menu -->
					<?php 

					if(ot_get_option('redshift_logo'))
					{
					?>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" style="background-image: url('<?php echo ot_get_option('redshift_logo'); ?>');">
					<?php
					}
					else
					{
					?>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">	
					<?php
					bloginfo( 'name' ); 
					}


					?></a>
				  </div> <!-- .navbar-header .page-scroll -->

				   <!-- Collect the nav links, forms, and other content for toggling -->
                     <div class="collapse navbar-collapse navbar-right navbar-main-collapse">

				<!-- The WordPress Menu goes here -->
			<?php wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
					'menu_class' => 'nav navbar-nav',
					'fallback_cb' => '',
					'menu_id' => 'main-menu',
					'walker' => new wp_bootstrap_navwalker()
				)
			); ?>

				</div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<div class="main-content">
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	
