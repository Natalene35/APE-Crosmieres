<?php

add_action('rest_api_init', 'ape_rest_link_register');
//ROUTE GET ALL LINK
function ape_rest_link_all() {
    global $wpdb;
    $rows = $wpdb->get_results("SELECT * FROM wp_ape_link_child");    
    return $rows;
};
add_action( 'rest_api_init', function () {
    register_rest_route( 'ape', 'wp_ape_link_child',array(
        'methods' => 'GET',
        'callback' => 'ape_rest_link_all'   
        
    ));
    });
//ROUTE POST NEW LINK
function ape_rest_link_register()
{
    // WE DEFINE NEW ROAD FOR POST NEW LINK
    register_rest_route('ape', 'wp_ape_link_child', array(
        'methods' => 'POST',
        'callback' => 'ape_rest_links_child_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}
function ape_rest_links_child_handler($request)
{
    $response = [];
    $parameters = $request->get_json_params();
    $user_id = $parameters['user_id'];
    $child_id= $parameters['child_id'];
    global $wpdb;
    $rows = $wpdb->get_results("INSERT INTO wp_ape_link_child(
        user_id, child_id
         )
        VALUES ('$user_id', '$child_id')");    
    return $rows;
}