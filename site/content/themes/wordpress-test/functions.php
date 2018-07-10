<?php

class WordPressTestTheme {

    protected static $_instance = null;

    public function __construct()
    {

        add_action('init', [ $this, 'init' ]);
        add_action('init', [ $this, 'register_menus' ]);
        add_action('wp_enqueue_scripts', [ $this, 'enqueue_scripts' ]);
        add_action('after_setup_theme', [ $this, 'add_image_sizes' ]);
        add_action('admin_menu', [ $this, 'modify_admin_menu' ]);

    }

    public function init()
    {

        remove_post_type_support( 'page', 'editor' );

    }

    public function register_menus()
    {

        register_nav_menus(
            [
                'main-menu' => 'Main Menu',
                'contact-menu' => 'Contact Menu'
            ]
        );

    }

    public function enqueue_scripts()
    {

        wp_enqueue_script('frame-app', $this->get_asset_url('scripts/app.js'), [ 'jquery' ], null, true);
        wp_enqueue_style('frame-app', $this->get_asset_url('styles/app.css'), false, null);

    }

    public function add_image_sizes()
    {

        add_image_size( 'square', 800, 800, true );

    }

    public function modify_admin_menu()
    {

        remove_menu_page('edit.php');

    }

    public function get_asset_url( $path ) {

        return get_template_directory_uri() . '/built/' . $path;

    }

    public function get_menu_items( $location ) {

        $locations = get_nav_menu_locations();

        if ( !$locations || !isset( $locations[$location] ) )
            return [];

        $menu = wp_get_nav_menu_object( $locations[$location] );

        $menu_items = wp_get_nav_menu_items($menu->term_id);

        return $menu_items;

    }

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}

function WordPressTestTheme() {

    return WordPressTestTheme::instance();

}


WordPressTestTheme();