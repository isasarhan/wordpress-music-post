<?php get_header(); ?>

<div class="post-grid p-3">

    <?php

if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
                <header class="entry-header">
                    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                </header>
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>
            </article>
            <?php
        }

    } else {
        echo "nothing found";
    }
    ?>
</div>

<?php get_footer(); ?>