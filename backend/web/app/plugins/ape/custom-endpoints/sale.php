<?php

add_action('rest_api_init', 'ape_rest_sale_register');
add_action('rest_api_init', 'ape_rest_sale_meta');
//<----------------------------------ROAD-------------------------->>
function ape_rest_sale_register()
{
    // custom route when sale added
    register_rest_route('wp/v2', 'sale', array(
        'methods' => 'POST',
        'callback' => 'ape_rest_add_sale_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

//FUNCTION GET CUSTOM META BY ID 
function ape_rest_sale_meta()
{
   // WE DEFINE NEW ROAD FOR GET ALL META BY USER ID
   register_rest_route( 
      'wp/v2',
      'sale/meta/(?P<id>\d+)', array(
       'methods' => 'GET',
       'callback' => 'ape_rest_sale_meta_handler',
       'permission_callback' => function () {
           return true;
       }
   ));
}
//<-----------------------------------METHOD------------------------------>
// custom post meta by post_id
function ape_rest_sale_meta_handler($request)
{   
    $response = [];
    $parameters = $request->get_json_params();
    $post_id= intval($request['id']);
    //POST SQL REQUEST 
    global $wpdb;
    $rows = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `post_id`=".$post_id);
    return $rows;
};

function ape_rest_add_sale_handler($request)
{

    // translate request with JSON
    $parameters = $request->get_json_params();
    $title = sanitize_text_field($parameters['title']);
    $content = sanitize_text_field($parameters['content']);
    $date = $parameters['date'];
    $lieu = sanitize_text_field($parameters['lieu']);
    $lien = sanitize_text_field($parameters['lien']);

    // add to the database
    $post_id = wp_insert_post([
        'post_title' => $title,
        'post_content' => $content,
        'post_type' => 'sale'
    ]);
    add_post_meta($post_id, 'lieu', $lieu);
    add_post_meta($post_id, 'lien', $lien);
    add_post_meta($post_id, 'date', $date);

    // return post's id or false
    return $post_id > 0 ? $post_id : false;
};
