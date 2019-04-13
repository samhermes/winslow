<nav id="site-navigation" class="main-navigation" role="navigation">
    <div class="main-navigation-contain">
        <button type="button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'winslow' ); ?></button>

        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'depth' => 1 ) ); ?>

        <button type="button" class="search-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="42.8" height="42.8" viewBox="0 0 42.8 42.8" id="search-icon">
                    <path class="glass" fill="#404040" d="M16.7 3c7.6 0 13.7 6.2 13.7 13.7s-6.2 13.7-13.7 13.7S3 24.3 3 16.7 9.2 3 16.7 3m0-3C7.5 0 0 7.5 0 16.7s7.5 16.7 16.7 16.7S33.5 26 33.5 16.7 26 0 16.7 0z"/>
                    <path class="handle" fill="none" stroke="#000" stroke-width="3" stroke-miterlimit="10" d="M27.9 27.9l13.8 13.8"/></svg>
            <span class="screen-reader-text"><?php esc_html_e( 'Search', 'winslow' ); ?></span>
        </button>
    </div>
</nav>