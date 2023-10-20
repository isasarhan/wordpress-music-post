<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <header class="page-header">
            <h1 class="page-title">
                <?php single_term_title('Artist: '); ?>
            </h1>
            <?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
        </header>
        <div class="container">

        <div class="post-grid p-3">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    ?>
                    <div class="card border-success mb-3" style="max-width: 18rem;">
                        <div class="card-header bg-transparent border-success"><?php  the_()?></div>
                        <div class="card-body text-success">
                            <h5 class="card-title">
                                <?php the_title() ?>
                            </h5>
                            <p class="card-text">
                                <?php the_excerpt(); ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-success">
                        <a href="<?php echo  esc_url(get_permalink())?>" class="btn text-success ">Show More</a>
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
    </main>
</div>

<?php get_footer(); ?>