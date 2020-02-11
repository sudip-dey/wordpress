<?php

require get_theme_file_path('./inc/search-route.php');

function university_files() {
  wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);

  //wp_enqueue_script('traidiontal_js', get_theme_file_uri('/js/traditional_scripts.js'), array('jquery'), '1.0', true);

  wp_localize_script('main-university-js', 'myScript', array(
    'customVal' => site_url(),
  ));
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'university_files');

add_action('after_setup_theme', 'university_features');

function university_features() {
  add_theme_support('title-tag');
}

add_action('init', 'university_event_post');
add_action('init', 'university_program_post');

function university_event_post(){
  register_post_type( 'event', array(
    'show_in_rest' => true, // enable the Post type in REST
    'supports' => array(
      'title', 'editor', 'excerpt'
    ),
    'has_archive' => TRUE,
    'rewrite' => array( 'slug' => 'event' ),
    'public' => true,
    'label'  => 'Events',
    'menu_icon' => 'dashicons-calendar',
    'labels' => array(
      'add_new' => "Add New Events",
      'add_new_item' => "Add New Events"
    )
    )
  );
}

function university_program_post(){
  register_post_type( 'program', array(
    'supports' => array(
      'title', 'editor', 'excerpt'
    ),
    'has_archive' => TRUE,
    'rewrite' => array( 'slug' => 'program' ),
    'public' => true,
    'label'  => 'Programs',
    'menu_icon' => 'dashicons-calendar',
    'labels' => array(
      'add_new' => "Add New Programs",
      'add_new_item' => "Add New Programs"
    )
    )
  );
}

// posts, pages, events, programs, campus


add_action ('pre_get_posts', 'university_pre_post_alter');

function university_pre_post_alter( $query ){
  if( is_post_type_archive('event') && is_main_query() ){
    $query->set( 'orderby', 'title' );
    $query->set( 'order', 'DESC' );
    // Add the alters as requirted
  }
}

add_action('rest_api_init', 'university_custom_rest');

function university_custom_rest(){
  register_rest_field('post', 'authorName', array(
      'get_callback' => function(){ //return 'Sudip Dey'; 
          return get_the_author();
        }
  ));
}



// 31.01.2020
//  Enable plugin JSON basic auth
// =====================================================================================================
$university = new WP_REST_university();
add_action('rest_api_init', $university->register_routes());

// REST API call from WordPress - GET
function university_wp_get_rest(){
  // REST API call from WordPress functions - GET
  $request = new WP_REST_Request( 'GET', '/wp/v2/posts' );
  $request->set_query_params( [ 'per_page' => 12 ] );
  $response = rest_do_request( $request );
  $server = rest_get_server();
  $data = $server->response_to_data( $response, false );
  $json = wp_json_encode( $data );
  return $json;
}

//print_r(university_wp_get_rest());

// REST API call from WordPress - POST
function university_wp_post_rest(){
  // REST API call from WordPress functions - GET
  $request = new WP_REST_Request( 'POST', '/university/v2/posts' );
  $request->set_header( 'content-type', 'application/x-www-form-urlencoded' );
  /*$wp_request_headers = array(
    'Authorization' => 'Basic ' . base64_encode( 'ad:admin' )
  );
  $request->add_header('Authorization', $wp_request_headers);*/
  $request->add_header('Cache-Control', 'no-cache');

  $request->set_query_params( [ 'title' => 'Testing '.rand(), 'content' => 'Content '. rand() ] );
  $response = rest_do_request( $request );
  $server = rest_get_server();
  $data = $server->response_to_data( $response, false );
  $json = wp_json_encode( $data );
  return $data;
}

function university_register_my_custom_menu_page() {
  add_menu_page(
      __( 'Custom Menu Title', 'textdomain' ),
      'custom menu',
      'manage_options',
      'customPage',
      'call_my_rest_client',
      '',
      6
  );
}

function call_my_rest_client (){
  $data = university_wp_post_rest();

  if ( $data['status'] == 200 ){
    echo 'Post created successfully. Post ID - '.$data['post_id']. 'Current USer - '.get_current_user_id();
  }else{
    print_r($data);
  }
}
//add_action('after_setup_theme', 'university_register_my_custom_menu_page');
add_action( 'admin_menu', 'university_register_my_custom_menu_page' );



function university_widget_init(){
  register_sidebar(
      array(
        'name' => 'Widegt Area One',
        'id' => 'widget_area_one',
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="headline headline--small widgetarea2">',
        'after_title' => '</h3>',
      )
  );
  register_sidebar(
      array(
        'name' => 'Widegt Area Two',
        'id' => 'widget_area_two',
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="headline headline--small widgetarea2">',
        'after_title' => '</h3>',
      )
  );
}

add_action( 'widgets_init', 'university_widget_init' );

/* Use of the Custom Hook */
// Plugin 1
add_action( 'university_custom_hook', 'university_custom_hook_one' );

function university_custom_hook_one(){
  $txt = "<h1>This is from the Custom Hook ONE</h1>";
  echo apply_filters( 'university_custom_filter_one', $txt );
}

// Plugin 2
add_action( 'university_custom_hook', 'university_custom_hook_two' );

function university_custom_hook_two(){
  echo "<h1>This is from the Custom Hook TWO</h1>";
}

// Plugin 3
add_filter( 'university_custom_filter_one', 'university_custom_filter_func_one' );
function university_custom_filter_func_one( $txt ){
  return "Modified using the filter. Old text - ". $txt;
}
