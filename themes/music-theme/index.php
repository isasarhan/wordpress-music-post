
<?php
$args = array(
    'post_type' => 'music',
    'category_name' => 'albums',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
);

$query = new WP_Query( $args );
    get_header();
    while(have_posts()){
        the_post();
        the_title();
    }
    get_footer();
?>