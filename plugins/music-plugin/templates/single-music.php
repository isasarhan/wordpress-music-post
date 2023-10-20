<?php

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        if (have_posts()) {
            the_post();
            ?>
            <div>
                <?php
                $post_id = get_the_ID();

                if (has_post_thumbnail($post_id)) {
                    // Get the featured image HTML
                    $featured_image_url = get_the_post_thumbnail_url($post_id, 'medium');
                }

                ?>

                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">

                        <div class="col-md-4">
                            <img src='<?php echo esc_url($featured_image_url) ?>' class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php the_title(); ?>
                                </h5>
                                <p class="card-text">
                                    <?php the_content();
                                    $custom_value = get_post_meta(get_the_ID(), '_music_date', true);

                                    if (!empty($custom_value)) {
                                        echo '<p>Date: ' . esc_html($custom_value) . '</p>';
                                    }
                                    $archive_link = get_post_type_archive_link('music'); // 'post' is the default post type
                                
                                    ?>
                                </p>
                                <a href="<?php echo $archive_link ?>" class="btn btn-primary">all music</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <?php } ?>
    </main>
</div>

<?php get_footer(); ?>