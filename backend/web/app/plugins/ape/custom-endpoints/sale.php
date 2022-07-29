<?php

add_action('rest_api_init', 'ape_rest_sale_register');
add_action('rest_api_init', 'ape_rest_sale_meta');
add_action('rest_api_init', 'ape_rest_sale_update');
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
//FUNCTION POST UPDATE SALE BY ID 
function ape_rest_sale_update()
{
    // WE DEFINE NEW ROAD FOR GET ALL META BY USER ID
    register_rest_route(
        'wp/v2',
        'sale/update/(?P<id>\d+)',
        array(
            'methods' => 'POST',
            'callback' => 'ape_rest_sale_update_handler',
            'permission_callback' => function () {
                return true;
            }
        )
    );
}
// update sale by post_id
function ape_rest_sale_update_handler($request)
{
    // translate request with JSON
    $parameters = $request->get_json_params();
    $id = $parameters['id'];
    $title = sanitize_text_field($parameters['title']);
    $content = sanitize_text_field($parameters['content']);
    $date = sanitize_text_field($parameters['date']);
    $lien = sanitize_url($parameters['lien']);
    $lieu = sanitize_text_field($parameters['lieu']);

    // add to the database
    $post_id = wp_update_post([
        'post_title' => $title,
        'post_content' => $content,
        'post_type' => 'sale',
        'ID' => $id,
        'meta_input' => array(
            'lien' => $lien,
            'date' => $date,
            'lieu' => $lieu
        )
    ]);
    // return post's id or false
    return $post_id ? ["id" => $post_id] : false;
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
    // get the meta data 'lieu'
    $saleLieu = $wpdb->get_results("
     SELECT meta_value FROM wp_postmeta
     WHERE meta_key = 'lieu' AND post_id = $id 
     ");
    // get the meta data 'lien'
    $saleLien = $wpdb->get_results("
     SELECT meta_value FROM wp_postmeta
     WHERE meta_key = 'lien' AND post_id = $id 
     ");
    // add the meta data to the post object
    return [
        'date' => $saleDate[0]->meta_value,
        'lieu' => $saleLieu[0]->meta_value,
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
    $lieu = sanitize_text_field($parameters['lieu']);


    // add to the database
    $post_id = wp_insert_post([
        'post_title' => $title,
        'post_content' => $content,
        'post_type' => 'sale',
        'post_status' => 'publish',
    ]);
    add_post_meta($post_id, 'lien', $lien);
    add_post_meta($post_id, 'date', $date);
    add_post_meta($post_id, 'lieu', $lieu);

    // return post's id or false
    return $post_id ? ["id" => $post_id] : false;
};