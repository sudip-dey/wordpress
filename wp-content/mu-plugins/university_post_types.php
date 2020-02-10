<?php
class WP_REST_university extends WP_REST_Controller {

	/**
	 * Instance of a comment meta fields object.
	 *
	 * @since 4.7.0
	 * @var WP_REST_Comment_Meta_Fields
	 */
	protected $meta;

	/**
	 * Constructor.
	 *
	 * @since 4.7.0
	 */
	public function __construct() {
		$this->namespace = 'university/v2';
		$this->rest_base = 'posts';

		//$this->meta = new WP_REST_Comment_Meta_Fields();
	}


	public function register_routes() {

		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'create_item' ),
					'permission_callback' => array( $this, 'create_item_permissions_check' ),
					'args'                => array(
                                                'title' => array(
                                                    'description' => __( 'Title' ),
                                                    'type'        => 'string',
                                                ),
                                                'content' => array(
                                                    'description' => __( 'Main content Body' ),
                                                    'type'        => 'string',
                                                ),
				),
				//'schema' => array( $this, 'get_public_item_schema' ),
			)
		));
    }
    

	function create_item( $request ) { 

        // Create post object
        $my_post = array(
            'post_title'    => wp_strip_all_tags( $request->get_param('title') ),
            'post_content'  => wp_strip_all_tags( $request->get_param('content') ),
            'post_status'   => 'publish',
            'post_author'   => 1
        );
   
        // Insert the post into the database
        $post_id = wp_insert_post( $my_post );

        return array('post_id' => $post_id);
    }

    function create_item_permissions_check($request){ 
		
		if ( current_user_can( 'administrator' ) ) return TRUE;

        if ( ! current_user_can( 'manage options' ) ) {
            return new WP_Error( 'rest_forbidden',  'OMG you can not view private data.'.get_current_user_id(), array( 'status' => 401 ) );
        }
    
        // This is a black-listing approach. You could alternatively do this via white-listing, by returning false here and changing the permissions check.
        return true;
    }
}