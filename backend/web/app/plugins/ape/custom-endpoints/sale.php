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
        'sale/meta/(?P<id>\d+)',
        array(
            'methods' => 'GET',
            'callback' => 'ape_rest_sale_meta_handler',
            'permission_callback' => function () {
                return true;
            }
        )
    );
}
// custom post meta by post_id
function ape_rest_sale_meta_handler($request)
{
    global $wpdb;

    // get the parameter 'id' into request and sanitize it
    $id = sanitize_text_field($request->get_param('id'));


    // get the meta data 'date'
    $saleDate = $wpdb->get_results("
    SELECT meta_value FROM wp_postmeta
    WHERE meta_key = 'date' AND post_id = $id 
    ");
    // get the meta data 'lien'
    $saleLien = $wpdb->get_results("
     SELECT meta_value FROM wp_postmeta
     WHERE meta_key = 'lien' AND post_id = $id 
     ");

    // add the meta data to the post object
    return [
        'date' => $saleDate[0]->meta_value,
        'lien' => $saleLien[0]->meta_value
    ];
};

function ape_rest_add_sale_handler($request)
{

    // translate request with JSON
    $parameters = $request->get_json_params();
    $title = sanitize_text_field($parameters['title']);
    $content = sanitize_text_field($parameters['content']);
    $date = sanitize_text_field($parameters['date']);
    $lien = sanitize_url($parameters['lien']);

    // add to the database
    $post_id = wp_insert_post([
        'post_title' => $title,
        'post_content' => $content,
        'post_type' => 'sale'
    ]);
    add_post_meta($post_id, 'lien', $lien);
    add_post_meta($post_id, 'date', $date);

    // return post's id or false
    return $post_id ? ["id" => $post_id] : false;
};
