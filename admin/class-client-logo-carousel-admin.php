<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://owlpixel.com
 * @since      1.0.0
 *
 * @package    Client_Logo_Carousel
 * @subpackage Client_Logo_Carousel/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Client_Logo_Carousel
 * @subpackage Client_Logo_Carousel/admin
 * @author     Md Anowar Hossen <anrctg@gmail.com>
 */
class Client_Logo_Carousel_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Client_Logo_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Client_Logo_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/client-logo-carousel-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Client_Logo_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Client_Logo_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/client-logo-carousel-admin.js', array( 'jquery' ), $this->version, false );

	}




    /**
     * Generate custom post for Client Logo Carousel
     */
    public function clc_carousel_post_type()
    {

        $labels = array(
            'name'                  => _x( 'Client Logo Carousel', 'Post Type General Name', 'client-logo-carousel' ),
            'singular_name'         => _x( 'Client Logo Carousel', 'Post Type Singular Name', 'client-logo-carousel' ),
            'menu_name'             => __( 'Client Logo Carousel', 'client-logo-carousel' ),
            'name_admin_bar'        => __( 'Client Logo Carousel', 'client-logo-carousel' ),
            'archives'              => __( 'Carousel Archives', 'client-logo-carousel' ),
            'attributes'            => __( 'Carousel Attributes', 'client-logo-carousel' ),
            'parent_item_colon'     => __( 'Parent Carousel:', 'client-logo-carousel' ),
            'all_items'             => __( 'All Carousels', 'client-logo-carousel' ),
            'add_new_item'          => __( 'Add New Carousel', 'client-logo-carousel' ),
            'add_new'               => __( 'Add New Carousel', 'client-logo-carousel' ),
            'new_item'              => __( 'New Carousel', 'client-logo-carousel' ),
            'edit_item'             => __( 'Edit Carousel', 'client-logo-carousel' ),
            'update_item'           => __( 'Update Carousel', 'client-logo-carousel' ),
            'view_item'             => __( 'View Carousel', 'client-logo-carousel' ),
            'view_items'            => __( 'View Carousels', 'client-logo-carousel' ),
            'search_items'          => __( 'Search Carousel', 'client-logo-carousel' ),
            'not_found'             => __( 'Not found', 'client-logo-carousel' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'client-logo-carousel' ),
            'featured_image'        => __( 'Featured Image', 'client-logo-carousel' ),
            'set_featured_image'    => __( 'Set featured image', 'client-logo-carousel' ),
            'remove_featured_image' => __( 'Remove featured image', 'client-logo-carousel' ),
            'use_featured_image'    => __( 'Use as featured image', 'client-logo-carousel' ),
            'insert_into_item'      => __( 'Insert into Carousel', 'client-logo-carousel' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'client-logo-carousel' ),
            'items_list'            => __( 'Items list', 'client-logo-carousel' ),
            'items_list_navigation' => __( 'Items list navigation', 'client-logo-carousel' ),
            'filter_items_list'     => __( 'Filter items list', 'client-logo-carousel' ),
        );
        $args = array(
            'label'                 => __( 'Client Logo Carousel', 'client-logo-carousel' ),
            'description'           => __( 'Client Logo carousel post', 'client-logo-carousel' ),
            'labels'                => $labels,
            'supports'              => array( 'title' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'clc_carousel', $args );

    }


    public function adding_shortcode_column_to_table_view()
    {
        // Add the custom columns to the lorem carousel post type:
        add_filter( 'manage_clc_carousel_posts_columns', 'set_custom_shortcode_columns' );
        function set_custom_shortcode_columns($columns) {
            unset( $columns['author'] );
            $columns['shortcode'] = __( 'Shortcode', 'your_text_domain' );

            return $columns;
        }

        add_action( 'manage_clc_carousel_posts_custom_column' , 'custom_clc_shortcode_column', 10, 2 );
        function custom_clc_shortcode_column( $column, $post_id ) {
            switch ( $column ) {

                case 'shortcode' :
                    _e( '<input style="width:100%;border:none;box-shadow:none" value="[clc-carousel carousel_id='.$post_id.']" readonly>', 'your_text_domain' );
                    break;

            }
        }

    }

}
