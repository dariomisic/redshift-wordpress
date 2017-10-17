<?php
/**
 * redshift functions and definitions
 *
 * @package redshift
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( 'redshift_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function redshift_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	if ( function_exists( 'add_theme_support' ) ) {

		/**
		 * Add default posts and comments RSS feed links to head
		*/
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable support for Post Formats
		*/
		add_theme_support( 'post-formats', array( 'video','gallery') );

		/**
		 * Enable social icons
		*/
		function social_media() {
 
            if (is_single()) {
            global $post;
            echo '<div class="social-post">
                    <div class="counter-twitter"><a data-related="DIY_WP_Blog" href="http://twitter.com/share" class="twitter-share-button" data-text="' . get_the_title($post->ID) . ' —" data-url="' . get_permalink($post->ID) . '" data-count="vertical">Tweet</a></div>' . "\n";
         ?>
        <div class="counter-fb-like">
        <div id="fb-root"></div><fb:like layout="box_count" href="<?php the_permalink(); ?>" send="false" width="50" show_faces="false"></fb:like>
        </div>
        <div class="counter-google-one"><g:plusone size="tall" href="<?php the_permalink(); ?>"></g:plusone></div>
        </div>
        <?php }
        }
 
        function java_to_bottom() {
          
            if (is_single(array())) { // Change the name to match the name(s) of the pages using the form ?>
            <script>(function(d, s) {
            var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.src = url; js.id = id;
                fjs.parentNode.insertBefore(js, fjs);
                };
				  load('//connect.facebook.net/en_US/all.js#xfbml=1', 'fbjssdk');
				  load('https://apis.google.com/js/plusone.js', 'gplus1js');
				  load('//platform.twitter.com/widgets.js', 'tweetjs');
                }(document, 'script'));</script>
 
        <?php } }
        add_action('wp_footer', 'java_to_bottom');

		
		/**
		 * Setup the WordPress core custom background feature.
		*/
		/*add_theme_support( 'custom-background', apply_filters( 'redshift_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );*/

	}

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on redshift, use a find and replace
	 * to change 'redshift' to the name of your theme in all the template files
	*/
	load_theme_textdomain( 'redshift', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header bottom menu', 'redshift' ),
	) );

}
endif; // redshift_setup
add_action( 'after_setup_theme', 'redshift_setup' );


/**
 * Set the theme options admin area.
 */

/**
 * Load font.
 */

function load_fonts() {
            wp_register_style('et-googleFonts', 'http://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900&subset=latin,latin-ext');
            wp_enqueue_style( 'et-googleFonts');
        }
    add_action('wp_print_styles', 'load_fonts');

//social
function gk_social_buttons($content) { global $post; $permalink = get_permalink($post->ID); $title = get_the_title(); if(!is_feed() && !is_home() && !is_page()) { $content = $content . '
Twitter Facebook Google+
'; } return $content; } add_filter('blog', 'gk_social_buttons');

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

/**
 * Loads Theme Options
 */
require( trailingslashit( get_template_directory() ) . 'includes/theme-options.php' );

// Remove Option Tree Settings Menu and Layout Menu

add_filter( 'ot_show_pages', '__return_false' );

add_filter( 'ot_show_new_layout', '__return_false' );


// Numbered Pagination
	if ( !function_exists( 'redshift_pagination' ) ) {
	     
	    function redshift_pagination() {
	         
	        $prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
	        $next_arrow = is_rtl() ? '&larr;' : '&rarr;';
	         
	        global $wp_query;
	        $total = $wp_query->max_num_pages;
	        $big = 999999999; // need an unlikely integer
	        if( $total > 1 )  {
	             if( !$current_page = get_query_var('paged') )
	                 $current_page = 1;
	             if( get_option('permalink_structure') ) {
	                 $format = 'page/%#%/';
	             } else {
	                 $format = '&paged=%#%';
	             }
	            echo paginate_links(array(
	                'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	                'format'        => $format,
	                'current'       => max( 1, get_query_var('paged') ),
	                'total'         => $total,
	                'mid_size'      => 3,
	                'type'          => 'list',
	                'prev_text'     => $prev_arrow,
	                'next_text'     => $next_arrow,
	             ) );
	        }
	    }
	     
	}



/**
 * Register widgetized area and update sidebar with default widgets
 */
function redshift_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'redshift' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Blog', 'redshift' ),
		'id'            => 'blog',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',

	) );

}
add_action( 'widgets_init', 'redshift_widgets_init' );


/**
 * Enqueue categories postcount
 */


function categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="badge"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
add_filter('wp_list_categories','categories_postcount_filter');



/**
 * Implement the class tgm plugin activation.
 */
require get_template_directory() . '/includes/class-tgm-plugin-activation.php';


add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
             'name' => 'Redshift Shortcodes', // The plugin name.
            'slug' => 'redshift-shortcodes', // The plugin slug (typically the folder name).
            'source' => 'http://kub-it.com/plugins/Redshift_shortcodes.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
        ),
         
          array(
            'name' => 'CPT Bootstrap Carousel',
            'slug' => 'cpt-bootstrap-carousel',
            'required' => true,
)

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins for RedShift Theme', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}


/**
 * Enqueue scripts and styles
 */
function redshift_scripts() {

	// load bootstrap css
	wp_enqueue_style( 'redshift-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	wp_enqueue_style( 'redshift-font-awesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.1.0' );

	// load magnific-popup css
	wp_enqueue_style( 'redshift-magnific-popup', get_template_directory_uri() . '/includes/css/magnific-popup.css', false, '4.1.0' );

	// load animate.min css
	wp_enqueue_style( 'redshift-animate', get_template_directory_uri() . '/includes/css/animate.css', false, '4.1.0' );

	// load moon css
	wp_enqueue_style( 'redshift-moon', get_template_directory_uri() . '/includes/moon.css', false, '4.1.0' );

	// load slick min css
	wp_enqueue_style( 'redshift-slick', get_template_directory_uri() . '/includes/css/slick.css', false, '4.1.0' );

    // load stylessheet
	wp_enqueue_style( 'redshift-style', get_stylesheet_uri() );

	// load style-s css
	
	if(ot_get_option('redshift_color')!="default")
	{
	
	wp_enqueue_style( 'redshift-color', get_template_directory_uri() . '/includes/skins/style-'.ot_get_option('redshift_color').'.css', false, '4.1.0' );

	}

	// load bootstrap js
	wp_enqueue_script('redshift-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load jquery.easing.min js
	wp_enqueue_script( 'jquery.easing_js', get_template_directory_uri() . '/includes/js/jquery.easing.min.js', array('jquery'), '', true );


	// load jquery.scrollTo js
	wp_enqueue_script( 'redshift-jquery.scrollTo', get_template_directory_uri() . '/includes/js/jquery.scrollTo.js', array('jquery'), '', true );


	// load wow.min js
	wp_enqueue_script( 'redshift-wow', get_template_directory_uri() . '/includes/js/wow.min.js', array('jquery'), '', true );


	// load custom js
	wp_enqueue_script( 'redshift-custom', get_template_directory_uri() . '/includes/js/custom.js', array('jquery'), '', true );

	// load jquery.isotope.min js
	wp_enqueue_script( 'redshift-jquery.isotope', get_template_directory_uri() . '/includes/js/jquery.isotope.min.js', array('jquery'), '', true );

	// load main js
	wp_enqueue_script( 'redshift-main', get_template_directory_uri() . '/includes/js/main.js', array('jquery'), '', true );

	// load jquery.magnific-popup.min js
	wp_enqueue_script( 'redshift-jquery.magnific-popup', get_template_directory_uri() . '/includes/js/jquery.magnific-popup.min.js', array('jquery'), '', true );

	// load bootstrap wp js
	wp_enqueue_script( 'redshift-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	// load googlemaps
	wp_register_script('googlemaps', 'http://maps.googleapis.com/maps/api/js?key=' . 'AIzaSyCGnh_AbRpBwLsIVmiW6npfBNvBH2B1gCw' . '&sensor=false', false, '3');
    wp_enqueue_script('googlemaps');

	// load jquery.easing.min js
	wp_enqueue_script( 'redshift-jquery.easing', get_template_directory_uri() . '/includes/js/jquery.easing.1.3.min.js', array('jquery'), '', true );

	// load jquery.easing.compatibility
	wp_enqueue_script( 'redshift-jquery.easing.compatibility', get_template_directory_uri() . '/includes/js/jquery.easing.compatibility.js', array('jquery'), '', true );

	// load elements js
	wp_enqueue_script( 'redshift-elements', get_template_directory_uri() . '/includes/js/elements.js', array('jquery'), '', true );

	// load slick js
	wp_enqueue_script( 'redshift-slick_min', get_template_directory_uri() . '/includes/js/slick.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'redshift-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'redshift-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', 'redshift_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/includes/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';

/**
 * Register Portfolio
 */

require get_template_directory() . '/includes/portfolio_walker.php';

require get_template_directory() . '/includes/post-types.php';


function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('post','portfolio'));
    }

return $query;
}

add_filter('pre_get_posts','searchfilter');

/**************************************
Get Embed Video for post format video
**************************************/
function the_featured_video( &$content ) {
 $url = trim( array_shift( explode( "\n", $content ) ) );

if ( 0 === strpos( $url, 'http://' )|| 0 === strpos( $url, 'https://' ) ) {
 echo apply_filters( 'the_content', $url );
 $content = trim( str_replace( $url, '', $content ) ); 
 } else if ( preg_match ( '#^<(script|iframe|embed|object)#i', $url ) ) {
 $h = get_option( 'embed_size_h' );
 if ( !empty( $h ) ) {
 if ( $w === $h ) $h = ceil( $w * 0.75 );

$url = preg_replace( 
 array( '#height="[0-9]+?"#i', '#height=[0-9]+?#i' ), 
 array( sprintf( 'height="%d"', $h ), sprintf( 'height=%d', $h ) ), 
 $url 
 );
 }

 $content = trim( str_replace( $url, '', $content ) ); 
 }

return $content;
}