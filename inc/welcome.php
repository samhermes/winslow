<?php
/*
 * Functions for the welcome screen.
 */

function winslow_welcome_screen_activate() {
    set_transient( '_welcome_screen_activation_redirect', true, 30 );
}
add_action( 'after_switch_theme', 'winslow_welcome_screen_activate' );

function winslow_welcome_screen_do_activation_redirect() {
    // Bail if no activation redirect
    if ( ! get_transient( '_welcome_screen_activation_redirect' ) ) {
        return;
    }

    // Delete the redirect transient
    delete_transient( '_welcome_screen_activation_redirect' );

    // Bail if activating from network, or bulk
    if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
        return;
    }

    // Redirect to bbPress about page
    wp_safe_redirect(
        add_query_arg( array( 'page' => 'welcome' ),admin_url( 'index.php' ) )
    );
}
add_action( 'admin_init', 'winslow_welcome_screen_do_activation_redirect' );

function winslow_add_welcome_screen_page() {
    add_dashboard_page(
        'Welcome To Winslow',
        'Welcome To Winslow',
        'read',
        'welcome',
        'winslow_welcome_screen_content'
    );
}
add_action( 'admin_menu', 'winslow_add_welcome_screen_page' );

function winslow_welcome_screen_content() {
?>
    <div class="wrap">
        <h2>Welcome to Winslow</h2>

        <p>You can put any content you like here from columns to sliders - it's up to you</p>
    </div>
<?php
}

function winslow_welcome_screen_remove_menus() {
    remove_submenu_page( 'index.php', 'welcome' );
}
add_action( 'admin_head', 'winslow_welcome_screen_remove_menus' );
