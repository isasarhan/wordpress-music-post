<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">Issa Serhan Project</p>

    <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="navbar-nav">
                <?php
                wp_nav_menu( array(
                    'theme_location'  => 'footerMenu',
                    'depth'           => 2, 
                    'container'       => 'div',
                    'container_class' => 'navbar navbar-expand-lg navbar-light',
                    'container_id'    => 'navbarNavAltMarkup',
                    'menu_class'      => 'navbar-nav mr-auto',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                ) );
                    ?>
            </div>
    </nav>
     
  </footer>
</div>

<?php wp_footer() ?>
</body>

</html>