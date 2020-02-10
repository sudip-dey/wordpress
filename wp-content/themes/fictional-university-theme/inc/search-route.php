<?php
add_action('rest_api_init', 'university_custom_route');

function university_custom_route(){
    register_rest_route('university/v1', 'search', array(
        'methods' => 'GET',
        'callback' => 'university_search_results'
    ));

    // 31.01.2020
    register_rest_route('university/v1', 'posts', array(
        'methods' => 'POST',
        'callback' => 'university_create_posts',
        'args' => array(
            'title' => array(
                'description' => __( 'Title' ),
                'type'        => 'string',
            ),
            'content' => array(
                'description' => __( 'Main content Body' ),
                'type'        => 'string',
            ),
        )

    ));
}

function university_create_posts( $request ){
    //return array($request->get_param('title'));
    return array($request->get_params());
}



function university_search_results( $data ){
    //return array('Congratulations');

    $searchResults = new WP_Query(array(
        'post_type' => array('posts', 'event', 'pages', 'program'),
        's' => $data['keyword'], // Passing the search value from API
        
    ));
    
    //return $searchResults;

    $mainResult = array(
        'posts' => array(),
        'pages' => array(),
        'programs' => array(),
        'events' => array()
    );

    /*while ($searchResults->have_posts()){
        $searchResults->the_post();
       /* if get_post_type() equals posts
            array_push(posts, array('' => ''),)
        if get_post_type() equals events
            array_push(posts, array('' => ''),)

    }*/

    return $mainResult;
}



