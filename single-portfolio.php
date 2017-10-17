<?php
/**
 * Single Portfolio
 * 
 * @package redshift
 */


get_header('portfolio'); ?>



<div class="page-red" style="height:100px; width:100%; z-index: 1000; background-color:#f4543c; position:relative; top:0; text-align:center; margin-top: 20px; border-bottom:"><h5 class="page-title"><?php the_title(); ?></h5>

<div style="position: absolute;   top: -100px;    left: 0;    right:0;    z-index: 1000;    pointer-events:none;">
<svg class="chevron-red" style="fill:#f4543c; position:relative; left:0;" fill-opacity="1" height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="30%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path>
</svg>
</div> <!-- svg red image -->


<div style="position: absolute;   bottom:-5px;    left: 0;    right:0;    z-index: 1000;    pointer-events:none;">
<svg style="fill:#fff; position:relative; left:0;" fill-opacity="1" height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="30%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path>
</svg>
</div> <!-- svg white image -->


</div> <!-- page title -->

  <div class="container">   

    <div class="page-header">
      
      <div class="row" style="text-align:center;">


      </div>      

    </div>

    <div class="row">
      
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="col-sm-4 col-md-4 col-xs-12 portfolio-image">
          <?php
            $thumbnail_id = get_post_thumbnail_id(); 
            $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );
          ?>

          <p><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbnail_url[0]; ?>" alt="<?php the_title();?> graphic"></a></p>
         
        </div>

        <div class="col-sm-8 col-md-8 col-xs-12">

          <h2><?php the_title(); ?></h2>
          <?php the_content(); ?>


          

        </div> <!-- .col-sm-8 -->

        <div class="col-md-12">

        <?php redshift_content_nav( 'nav-below' ); ?>

        <?php
      // If comments are open or we have at least one comment, load up the comment template
      if ( comments_open() || '0' != get_comments_number() )
        comments_template();
              ?>


        </div>
            

      <?php endwhile; else: ?>
        
        <div class="page-header">
          <h1>Oh no!</h1>
        </div> <!-- .page-header -->

        <p>No content is appearing for this page!</p>

      <?php endif; ?>

      

    </div> <!-- .row -->
    </div> <!-- .container -->

    <?php

    echo '<div class="container"><div class="center wow fadeInDown">
                <h2>Other Items</h2>
<div class="divider"></div></div><div class="row"><div class="col-md-12"><div class="clients shortcode-portfolio">';

        $args = array( 
          'post_type' => 'portfolio'
        );
        $the_query = new WP_Query( $args );

      ?>

      <?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); 

  $thumbnail_id = get_post_thumbnail_id(); 
  $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );



      ?>



      <div class="recent-work-wrap">
          <a href="<?php the_permalink(); ?>">
              <img src="<?php echo $thumbnail_url[0]; ?>" class="img-responsive" style="height:300px; width:300px;">
                  </a>
      <div class="overlay">
          <div class="recent-work-inner">
              <div class="p-title-small"><a href="<?php echo get_permalink($id); ?>"><?php the_title();?></a></div>
                  <p class="p-small"><?php 
                      $c=get_the_content('');

                          echo substr($c,0,90)." ...";


                      ?></p>



   <?php if (has_post_thumbnail( $post->ID ) ): 
         $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 



  endif; ?>


      <a rel="magnific" href="<?php echo $image[0]; ?>" class="preview"><div class="team team-search" style="font-size:25px;"></div> <!-- .team .team-search --> </a>
          </div> <!-- .recent-work-inner -->
      </div> <!-- .overlay -->
  </div> <!-- .recent-work-wrap -->


      

      <?php endwhile; 

          echo '</div></div></div></div>';

      endif; ?>



<?php get_footer(); ?>