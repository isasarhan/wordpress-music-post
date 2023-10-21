<?php
get_header();


$featured = get_option("featured_album");
$album_slug = str_replace(" ", "-", $featured);
$url = '/albums' . '/' . $album_slug;
?>

<!-- Hero Section-->
<div class="p-5 text-center bg-image rounded-3" style="
    background-image: url('<?php echo get_template_directory_uri(); ?>/bg-image.jpg');
    height: 400px;
  ">
    <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-white">
                <h4 class="p-4">Featured Album</h4>
                <br />
                <h5>
                    <?php echo $featured; ?>
                </h5>
                <br />
                <a class="btn m-4 btn-outline-light btn-lg" href="<?php echo home_url($url) ?>" role="button">Show All
                    Music</a>
            </div>
        </div>
    </div>
</div>
<div class="row p-2 ">
    <?php
    $artists = get_categories('taxonomy=artists&type=music');
    $i = 1;
    foreach ($artists as $artist) {
        ?>
        <div class="col-md-4 col-xs-12 p-2">
            <div class="card m-1">
                <h5 class="card-header bg-secondary text-white ">
                    <?php echo $i; ?>
                </h5>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $artist->name ?>
                    </h5>
                    <p class="card-text">
                        <?php echo $artist->description ?>
                    </p>
                    <a href="<?php echo (get_category_link($artist)) ?>" class="btn btn-secondary ">Show Artist Music</a>
                </div>
            </div>
        </div>


        <?php
        $i++;
    } ?>
</div>
<?php
get_footer();
?>