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
if ( plugin_dir_path( dirname( __FILE__ ) ) . 'inc/cmb2/init.php' ) {
   require_once plugin_dir_path( dirname( __FILE__ ) ) . 'inc/cmb2/init.php';
}

add_action( 'cmb2_admin_init', 'clc_metaboxes_init' );
/**
 * Define the metabox and field configurations.
 */
function clc_metaboxes_init() {

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'clc_images_section',
        'title'         => __( 'Upload Carousel Images', 'cmb2' ),
        'object_types'  => array( 'clc_carousel' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( array(
        'name' => 'Carousel Images',
        'desc' => '',
        'id'   => 'clc_carousel_images_group',
        'type' => 'file_list',
        'preview_size' => array( 200, 200 ), // Default: array( 50, 50 )
        // 'query_args' => array( 'type' => 'image' ), // Only images attachment
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => 'Add Image For Carousel', // default: "Add or Upload Files"
            'remove_image_text' => 'Replacement', // default: "Remove Image"
            'file_text' => 'Replacement', // default: "File:"
            'file_download_text' => 'Replacement', // default: "Download"
            'remove_text' => 'Replacement', // default: "Remove"
        ),
    ) );


    $cmb = new_cmb2_box( array(
        'id'            => 'clc_settings',
        'title'         => __( 'Settings for this carousel', 'cmb2' ),
        'object_types'  => array( 'clc_carousel' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );


    $cmb->add_field( array(
        'name'    => 'Show logo per slide',
        'desc'    => 'How many logo to show on per slide',
        'default' => '5',
        'id'      => 'clc_logo_count',
        'type'    => 'text_small'
    ) );
    $cmb->add_field( array(
        'name'             => 'Carousel Loop',
        'id'               => 'clc_loop',
        'type'             => 'radio_inline',
        'options'          => array(
            '1' => __( 'Loop Carousel', 'cmb2' ),
            '0'   => __( 'Do not loop carousel', 'cmb2' )
        ),
        'default' =>1
    ) );
    $cmb->add_field( array(
        'name'             => 'Nav',
        'id'               => 'clc_nav',
        'type'             => 'radio_inline',
        'options'          => array(
            '1' => __( 'Show Nav', 'cmb2' ),
            '0'   => __( 'Hide Nav', 'cmb2' )
        ),
        'default' =>1
    ) );
    $cmb->add_field( array(
        'name'             => 'Nav Position',
        'id'               => 'clc_nav_position',
        'type'             => 'radio_inline',
        'options'          => array(
            'left' => __( 'Left', 'cmb2' ),
            'right'   => __( 'Right', 'cmb2' )
        ),
        'default' =>'right'
    ) );
    $cmb->add_field( array(
        'name'             => 'Dots',
        'id'               => 'clc_dots',
        'type'             => 'radio_inline',
        'options'          => array(
            '1' => __( 'Show Dots', 'cmb2' ),
            '0'   => __( 'Hide Dots', 'cmb2' )
        ),
        'default' =>0,
        'desc' => 'Hide or show the dots on navigations. Default hidden',
    ) );
    $cmb->add_field( array(
        'name'             => 'Border on logo?',
        'id'               => 'clc_border',
        'type'             => 'radio_inline',
        'options'          => array(
            '1' => __( 'Show Border', 'cmb2' ),
            '0'   => __( 'Hide Border', 'cmb2' )
        ),
        'default' =>0,
        'desc' => 'This will add a border on around the logo',
    ) );
    $cmb->add_field( array(
        'name'             => 'Grayscale image?',
        'id'               => 'clc_grayscale',
        'type'             => 'radio_inline',
        'options'          => array(
            '1' => __( 'Show Grayscale', 'cmb2' ),
            '0'   => __( 'Hide Grayscale', 'cmb2' )
        ),
        'default' =>0,
        'desc' => 'This will add a grayscale effect on logos',
    ) );



}



// Add Shortcode
function client_logo_carousel_shortcode( $atts ) {
    global $nav,$dots,$loops,$clc_id,$clc_logo_count;
    // Attributes
    $atts = shortcode_atts(
        array(
            'carousel_id' => '105',
        ),
        $atts
    );




    //$text = get_post_meta( $atts->carousel_id, 'carousel_images_group', true );
    // Get the list of files
    $files = get_post_meta( $atts['carousel_id'], 'clc_carousel_images_group', 1 );
    $nav = get_post_meta( $atts['carousel_id'], 'clc_nav', 1 );
    $dots = get_post_meta( $atts['carousel_id'], 'clc_dots', 1 );
    $loops = get_post_meta( $atts['carousel_id'], 'clc_loop', 1 );
    $border = get_post_meta( $atts['carousel_id'], 'clc_border', 1 );
    $grayscale = get_post_meta( $atts['carousel_id'], 'clc_grayscale', 1 );
    $nav_position = get_post_meta( $atts['carousel_id'], 'clc_nav_position', 1 );
    $clc_logo_count = get_post_meta( $atts['carousel_id'], 'clc_logo_count', 1 );
    $clc_id = "clc_carousel_".$atts['carousel_id'];

    $data = "";

        $data.='<style>';
        if ($nav ==0){
            $data.='#'.$clc_id.' .owl-nav{display:none}';
        }
        if ($border ==1){
            $data.='#'.$clc_id.' .item{border:5px solid #ddd}';
        }
        if ($grayscale ==1){
            $data.='#'.$clc_id.' .item img{filter: grayscale(100%);-webkit-filter: grayscale(100%)}';
        }
        if ($nav_position == 'left'){
            $data.='#'.$clc_id.' .owl-nav {left:0}';
            $data.='#'.$clc_id.' .owl-nav .owl-next {float:none}';
        }

        $data.='<style>';
        $data.='<style>';
        $data.='</style>';



    $data.= '<div class="owl-carousel owl-theme" id="'.$clc_id.'">';
    // Loop through them and output an image
    foreach ( (array) $files as $attachment_id => $attachment_url ) {
        $data.= '<div class="item">';
        $data.= '<div class="clc_logo_container">';
        $data.= wp_get_attachment_image( $attachment_id, 'full' );
        $data.= '</div>';
        $data.= '</div>';
    }
    $data.= '</div>';



            if ($nav == '1'){
                $showNav = 'true';
            }elseif($nav == '0'){
                $showNav = 'false';
            }
            if ($dots == '1'){
                $showDots = 'true';
            }elseif($dots == '0'){
                $showDots = 'false';
            }
            if($loops == '1'){
                $showLoop = 'true';
            }elseif($loops == '0'){
                $showLoop = 'false';
            }

    ob_start();
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $("#<?php echo $clc_id; ?>").owlCarousel({
                    dots:<?php echo $showDots;  ?>,
                    loop:<?php echo $showLoop;  ?>,
                    margin:10,
					autoplay:true,
                    nav:<?php echo $showNav;  ?>,
                    //autoHeight:true,
                    navText: ["<strong>◀ </strong> "," <strong>▶</strong> "],
                    responsive : {
                        0:{
                            items:1,
                            nav:true
                        },
                        600:{
                            items:3,
                            nav:false
                        },
                        1000:{
                            items:<?php echo $clc_logo_count;  ?>,
                            nav:true,
                            loop:false
                        }
                    }
                });


            })


        </script>
        <?php

    $data.= ob_get_contents();
    ob_end_clean();
       return $data;

    wp_reset_postdata();

}
add_shortcode( 'clc-carousel', 'client_logo_carousel_shortcode' );