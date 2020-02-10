<?php

function university_theme_setup() {
	//To add title tag in header section
	add_theme_support( 'title-tag' );
	//Enable excerpt field for pages to show in sub heading for sub pages.
	add_post_type_support( 'page', 'excerpt' );

	// Register primary menu for our theme
	register_nav_menu( 'primary',  esc_attr__( 'Main Menu'));
}

add_action( 'after_setup_theme', 'university_theme_setup' );

function load_theme_assets() {
	// To load style and scripts for only front end views
	if( !is_admin() ) {		
		//to include font awesome stylesheet to theme header section
		wp_enqueue_style('university-font-awsome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		//to include google font sytle to theme header section
		wp_enqueue_style('university-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
		//to include style.css to theme header section
		wp_enqueue_style('university-style', get_stylesheet_uri());
		//to include the main script to theme footer
		wp_enqueue_script('university-script', get_theme_file_uri('/js/scripts-bundled.js'), NULL, strtotime(''), true);
	}
}

// Hook to add style and script for the theme
add_action('wp_enqueue_scripts', 'load_theme_assets');



// register events post type

require_once('includes/admin/events.php')

?>