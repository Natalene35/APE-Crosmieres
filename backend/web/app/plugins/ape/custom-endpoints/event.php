<?php

// connexion the callback function to init hook for custom routes
add_action('rest_api_init', 'ape_rest_event_register');
add_action('rest_api_init', 'ape_rest_event_meta');
add_action('rest_api_init', 'ape_rest_event_update');

//<----------------------------------ROAD-------------------------->>

// to get the endpoint and add custom function
function ape_rest_event_register()
{
    // custom route when event added
    register_rest_route('wp/v2', 'event', array(
        'methods' => 'POST',
        'callback' => 'ape_rest_add_event_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

// FUNCTION GET CUSTOM META BY ID 
function ape_rest_event_meta()
{
    // WE DEFINE NEW ROAD FOR GET ALL META BY USER ID
    register_rest_route(
        'wp/v2',
        'event/meta/(?P<id>\d+)',
        array(
            'methods' => 'GET',
            'callback' => 'ape_rest_event_meta_handler',
            'permission_callback' => function () {
                return true;
            }
        )
    );
}
//FUNCTION POST UPDATE EVENT BY ID 
function ape_rest_event_update()
{
    register_rest_route(
        'wp/v2',
        'event/update/(?P<id>\d+)',
        array(
            'methods' => 'POST',
            'callback' => 'ape_rest_event_update_handler',
            'permission_callback' => function () {
                return true;
            }
        )
    );
}
// update event by post_id
function ape_rest_event_update_handler($request)
{    
    // translate request with JSON
    $parameters = $request->get_json_params();   
    $id=$parameters['id']; 
    $title = sanitize_text_field($parameters['title']);
    $content = sanitize_text_field($parameters['content']);
    $date = sanitize_text_field($parameters['date']);
    $lieu = sanitize_text_field($parameters['lieu']);
    $type=$parameters['type']; 
  
   // add to the database
    $post_id = wp_update_post([
        
        'post_title' => $title,
        'post_content' => $content,
        'post_type' => 'event',
        'ID'=> $id,
        'meta_input' => array(
            'date' => $date,
            'lieu' => $lieu
           )
    ]);   
    // return post's id or false
    return $post_id ? ["id" => $post_id] : false;
}
// custom post meta by post_id
function ape_rest_event_meta_handler($request)
{
    global $wpdb;

    // get the parameter 'id' into request and sanitize it
    $id = sanitize_text_field($request->get_param('id'));

    // get the meta data 'lieu'
    $lieu = $wpdb->get_results("
    SELECT meta_value FROM wp_postmeta
    WHERE meta_key = 'lieu' AND post_id = $id 
    ");

    // get the meta data 'date'
    $eventDate = $wpdb->get_results("
    SELECT meta_value FROM wp_postmeta
    WHERE meta_key = 'date' AND post_id = $id 
    ");

    // add the meta data to the post object
    return ['lieu' => $lieu[0]->meta_value, 'date' => $eventDate[0]->meta_value];
};

function ape_rest_add_event_handler($request)
{

    // translate request with JSON
    $parameters = $request->get_json_params();

    $title = sanitize_text_field($parameters['title']);
    $content = sanitize_text_field($parameters['content']);
    $date = sanitize_text_field($parameters['date']);
    $lieu = sanitize_text_field($parameters['lieu']);

    // add to the database
    $post_id = wp_insert_post([
        'post_title' => $title,
        'post_content' => $content,
        'post_type' => 'event',
        'post_status' => 'publish'
    ]);
    //add the meta key and value with the post id
    add_post_meta($post_id, 'lieu', $lieu);
    add_post_meta($post_id, 'date', $date);

    // return post's id or false
    return $post_id ? ["id" => $post_id] : false;
};