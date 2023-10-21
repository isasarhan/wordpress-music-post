<?php get_header(); ?>

<div id="primary" class="p-1">
    <div class="container">
        <h1>
            <?php echo 'All ' . get_post_type(); ?>
        </h1>
        <div class="post-grid p-3">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    ?>
                    <div class="card  border-secondary mb-3" >
                        <div class="card-header bg-secondary text-white border-secondary">
                            <?php $custom_value = get_post_meta(get_the_ID(), '_music_date', true);
                            echo $custom_value;
                            ?>
                        </div>
                        <div class="card-body text-secondary">
                            <h5 class="card-title">
                                <?php the_title() ?>
                            </h5>
                            <p class="card-text">
                                <?php echo wp_trim_words(get_the_excerpt(), 22); ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-secondary">
                            <a href="<?php echo esc_url(get_permalink()) ?>" class="btn text-secondary ">Show More</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Display no content found message.
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>