<?php get_header(); ?>


<div class="p-3 ">

    <h2 class="pb-3 ">
        <?php the_archive_title() ?>
    </h2>
    <div class="post-grid ">

        <?php

        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $post_id = get_the_ID();

                if (has_post_thumbnail($post_id)) {
                    $featured_image_url = get_the_post_thumbnail_url($post_id, 'medium');
                }
                ?>
               
                <div class="card m-3 " >
                    <img src="<?php echo esc_url($featured_image_url) ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php the_title()?></h5>
                        <p class="card-text">
                            <?php echo wp_trim_words(get_the_excerpt(), 10); ?>
                        </p>
                        <a href="<?php echo  esc_url(get_permalink())?>" class="btn btn-primary">Show More</a>
                    </div>
                </div>
                <?php
            }

        } else {
            echo "nothing found";
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>