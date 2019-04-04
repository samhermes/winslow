<?php
    $sticky_header_class = '';
    if ( ! is_admin_bar_showing() ) {
        $sticky_header_class = ' stick';
    }
?>

<nav id="site-navigation" class="main-navigation<?php echo $sticky_header_class; ?>" role="navigation">
    <div class="main-navigation-contain">
        <button type="button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'winslow' ); ?></button>

        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'depth' => 1 ) ); ?>

        <button type="button" class="search-toggle">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/img/search.svg' ); ?>" alt="">
            <span class="screen-reader-text"><?php esc_html_e( 'Search', 'winslow' ); ?></span>
        </button>
    </div>
</nav>