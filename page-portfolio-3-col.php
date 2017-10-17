<?php
/**
 * Template name: Portfolio Page 3-col.
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


</div> <!-- page title -->
      
<div class="container" style="margin-top:30px;">
<div class="col-md-12 col-xs-12 col-sm-12">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <!-- page-header -->


          <div class="portfolio-filter text-center">

          <li><a data-filter="*" href="#" class="btn btn-default active">All</a>
          </li>
          <?php 
            $cats = get_post_meta($post->ID, "_page_portfolio_cat", $single = true);                                                 
            $MyWalker = new PortfolioWalker();
            $args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'show_count' => '1');
            $categories = wp_list_categories ($args);
          ?>

        </div> <!-- .portfolio-filter .text-center -->

          <?php the_content(); ?>

        <?php endwhile; else: ?>
          
          <div class="page-header">
            <h1>Oh no!</h1>
          </div> <!-- page-header -->

          <p>No content is appearing for this page!</p>

        <?php endif; ?>




<div class="row">

  <div class="portfolio-items" style="position: relative; overflow: show; height: 440px;">

      <?php
        $args = array( 
          'post_type' => 'portfolio',
          'nopaging' => true
        );
        $the_query = new WP_Query( $args );

      ?>

      <?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

          <?php
            $thumbnail_id = get_post_thumbnail_id(); 
            $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );
            $cats = wp_get_object_terms($post->ID, 'portfolio_category');
                           
                          
              if ($cats):
                $cat_slugs = '';
                foreach( $cats as $cat ) {$cat_slugs .= $cat->slug . " ";}
              endif
      ?>


         
    <div class="portfolio-item <?php echo $cat_slugs; ?> col-xs-12 col-sm-6 col-md-4">
        <div class="recent-work-wrap wow fadeIn">
            <a href="<?php the_permalink(); ?>">
                <img alt="<?php the_title();?>" src="<?php echo $thumbnail_url[0]; ?>" class="img-responsive">
                  </a>
        <div class="overlay">
            <div class="recent-work-inner wow fadeIn">
                <div class="p-title"><a href="<?php echo get_permalink($id); ?>"><?php the_title();?></a></div>
                      <p>
            <?php 
                $c=get_the_content('');

                echo substr($c,0,90)." ...";


            ?></p>



      <?php if (has_post_thumbnail( $post->ID ) ): 
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 

      endif; ?>

      <a rel="magnific" href="<?php echo $image[0]; ?>" class="preview"><div class="team team-search"></div></a>
                                </div> <!-- .recent-work-inner -->
                            </div> <!-- .overlay -->
                        </div> <!-- .recent-work-wrap -->
                    </div><!--/.portfolio-item-->
      

      <?php endwhile; endif; ?>

</div> <!-- .portfolio-items -->
    </div> <!-- .row -->
  </div> <!-- .container -->


<?php get_footer(); ?>
