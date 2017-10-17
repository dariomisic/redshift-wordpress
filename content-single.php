r<?php
/**
 * @package redshift
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="blog-item">
    
    <?php
        $thumbnail_id = get_post_thumbnail_id(); 
        $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );

        if($thumbnail_id)
            {

    ?>

    <p><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbnail_url[0]; ?>" alt="<?php the_title();?> graphic"></a></p>
    <?php

     }

    ?>
        <div class="row">  
            <div class="col-xs-12 col-sm-2 text-center">
                <div class="entry-meta">


	<?php
		$time=get_the_time('M d');
		$author=get_the_author();

		$perm=get_permalink($id);

		$cont=get_the_content();
	?>



        <span id="publish_date"><?php echo $time; ?></span>
        <span><i class="fa fa-user"></i> <a href="#"><?php echo $author; ?></a></span>
        <span><i class="fa fa-comment"></i> <a href="<?php echo $perm; ?>#comments"><?php comments_number(); ?></a></span>
</div> <!-- .entry-meta -->
    </div> <!-- .col-xs-12 .col-sm-10 .blog-content -->
<div class="col-xs-12 col-sm-10 blog-content">
<h2 class="page-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <p>
                                    	

        </p>

<div class="post-tags">
    <?php
        echo get_the_tag_list('<p>Tags: ',', ','</p>');
    ?>

    <?php
        echo '<p>Categories: '.get_the_category_list(', ').'</p>';
    ?>

    <?php social_media(); ?>
                                    
            </div> <!-- .post-tags -->
        </div> <!-- .col-xs-12 .col-sm-10 .blog-content -->
    </div> <!-- .row -->
</div> <!-- #post-## -->






