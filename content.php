<?php
/**
 * @package redshift
 */
?>


<?php

$image[0]=null;


if (has_post_thumbnail( $post->ID ) ): 
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
        <a href=""><img width="100%" alt="" src="<?php echo $image[0]; ?>" class="img-responsive img-blog"></a>
        <h2 class="page-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<p>
							        	
	<?php 


    if(is_home())
    {
    echo substr($cont,0,298)." ...";
    }
    else
    {
    echo $cont;
    }

?>

	</p>

    <div class="post-tags">
    <?php
        echo get_the_tag_list('<p><span>Tags: ',', ','</span></p>');
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



