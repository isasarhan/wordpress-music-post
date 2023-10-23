<?php
// Include WordPress header
get_header();

// Check if there is a single post available
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="container my-5">
            <div class="p-5 text-center bg-body-tertiary rounded-3">
                
                <h1 class="text-body-emphasis">
                    <?php the_title(); ?>
                </h1>
                <p class="col-lg-8 mx-auto fs-5 text-muted">
                    <?php the_content(); ?>

                </p>
                <div class="d-inline-flex gap-2 mb-5">
                    <a href="<?php echo site_url()?>" class="d-inline-flex align-items-center btn btn-secondary btn-lg px-4 rounded-pill" type="button">
                        Go Home
                    </a>

                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo 'No posts found';
}
?>

<?php
// Include WordPress footer
get_footer();
