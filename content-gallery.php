

<?php
/**
 * @package redshift
 */
?>


<?php // Styling Tip!

// Want to wrap for example the post content in blog listings with a thin outline in Bootstrap style?
// Just add the class "panel" to the article tag here that starts below.
// Simply replace post_class() with post_class('panel') and check your site!
// Remember to do this for all content templates you want to have this,
// for example content-single.php for the post single view. ?>

<?php if (has_post_thumbnail( $post->ID ) ): 
 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 

 endif; ?>


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="blog-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 text-center">

    <?php
        $time=get_the_time('M d');
		$author=get_the_author();

		$perm=get_permalink($id);

		$cont=get_the_content();
    ?>

<div class="entry-meta">

<?php if(ot_get_option('hide_date')=='off')

{

?>
        <span id="publish_date"><?php echo $time; ?></span>

<?php

}

if(ot_get_option('hide_author')=='off')
{

?>
       <span><i class="fa fa-user"></i> <a href="#"><?php echo $author; ?></a></span>

<?php

}

if(ot_get_option('hide_comment')=='off')

{

?>
        <span><i class="fa fa-comment"></i> <a href="<?php echo $perm; ?>#comments"><?php comments_number(); ?></a></span>

<?php

}

?>

</div> <!-- .entry-meta -->


</div> <!-- .col-xs-12 .col-sm-2 .text-cente -->
                                
<div class="col-xs-12 col-sm-9 blog-content">

 


<?php 


$images=get_post_gallery_images($post); 

echo '<div class="gallery_slider single-item">';

foreach ($images as $image) {

echo '<div><img src="'.$image.'" class="img-responsive img-blog"></div>';

}

echo '</div>';

?>



<h2 class="page-title" style="margin-top:-40px;"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>


<p>

<?php 


    if(is_home())
    {
    echo substr(preg_replace('#\s*\[.+\]\s*#U', ' ', $cont),0,298)." ...";
    }
    else
    {
    echo preg_replace('#\s*\[.+\]\s*#U', ' ', $cont);
    }

?>

        </p>

<div class="post-tags">
    <?php
        echo get_the_tag_list('<p>Tags: ',', ','</p>');
    ?>

    <?php
        echo '<p>Categories: '.get_the_category_list(', ').'</p>';
    ?>

    <?php social_media(); ?>

    <?php        

if(is_home())
echo '<a href="'.$perm.'" class="btn btn-primary readmore">Read More <i class="fa fa-angle-right"></i></a>';

?>
                                    
</div> <!-- .post-tags -->
</div> <!-- .col-xs-12 .col-sm-10 .blog-content -->
</div> <!-- .row --> 
</div> <!-- #post-## -->