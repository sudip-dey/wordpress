<?php
/**
 * Register a custom post type called "Event".
 *
 * @see get_post_type_labels() for label keys.
 */
function register_event_post_type() {
    $labels = array(
        'name'                  => _x( 'Events', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Event', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Events', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Event', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Event', 'textdomain' ),
        'new_item'              => __( 'New Event', 'textdomain' ),
        'edit_item'             => __( 'Edit Event', 'textdomain' ),
        'view_item'             => __( 'View Event', 'textdomain' ),
        'all_items'             => __( 'All Events', 'textdomain' ),
        'search_items'          => __( 'Search Events', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Events:', 'textdomain' ),
        'not_found'             => __( 'No Events found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No Events found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Event Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Event archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into Event', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Event', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter Events list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Events list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Events list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'events' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
 
    register_post_type( 'events', $args );
}
 
add_action( 'init', 'register_event_post_type' );


//register metabox for Event post type

function event_metabox(){
    add_meta_box('event-metabox', 'Event details', 'event_metabox_content','events', 'normal', 'default');
}


add_action('add_meta_boxes_events', 'event_metabox');


function event_metabox_content($post){
    // Nonce field to validate form request came from current site
    wp_nonce_field( basename( __FILE__ ), 'event_fields' );

    // Get the event date if it's already been entered
	$date = get_post_meta( $post->ID, 'date', true );

	// Get the location data if it's already been entered
	$location = get_post_meta( $post->ID, 'location', true );
    ?>
    <div>
        <label> Event Date </label>
        <input type="date" name="date" value="<?php echo esc_textarea( $date )  ?>" class="widefat">';
    </div>
    <div>
        <label> Event Location </label>
        <input type="text" name="location" value="<?php echo esc_textarea( $location )   ?>" class="widefat">
    </div>
    <?php
}


/**
 * Save the metabox data
 */
function save_events_meta( $post_id, $post ) {

	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['location'] ) || ! wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}

    // Don't store custom data twice
    if ( 'revision' === $post->post_type ) {
        return;
    }

	// Now that we're authenticated, time to save the data.
    // This sanitizes the data from the field and saves it into an array $events_meta.
    $date = esc_textarea( $_POST['date'] );
    $location = esc_textarea( $_POST['location'] );   

    // update location data in post meta table
    update_post_meta( $post_id, 'date', $date );
    
    // update location data in post meta table
	update_post_meta( $post_id, 'location', $location );

}
add_action( 'save_post', 'save_events_meta', 1, 2 );


?>