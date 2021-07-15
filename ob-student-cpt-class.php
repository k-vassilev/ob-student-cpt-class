<?php
/**
 * Plugin Name: Student CPT class version
 * Description: Adds student CPT and fields using classes
 * Author: Kristian Vassilev
 * Version: 1.0.0
 *
 * @package student-cpt-class
 */

require "includes/ob-cpt-student-class.php";
require "includes/ob-shortcode-student-class.php";
require "includes/ob-metaboxes-class.php";

function ob_add_checkbox_script() {
	wp_enqueue_script( 'checkbox', plugins_url( 'includes/checkbox.js', __FILE__ ), array( 'jquery' ), false, true );
	wp_localize_script( 'checkbox', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
};

add_action( 'admin_enqueue_scripts', 'ob_add_checkbox_script' );
add_action( 'wp_ajax_checkbox', 'checkbox' );



