single
<?php

    while(have_posts()){
        the_post();
        echo the_title();
    }
?>
