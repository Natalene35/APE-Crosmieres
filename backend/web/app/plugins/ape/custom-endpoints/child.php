<?php

add_action('rest_api_init', 'ape_rest_child_register');

//ROUTE GET ALL CHILD
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', 'child', array(
        'methods' => 'GET',
        'callback' => 'ape_rest_child_all',
        'permission_callback' => function () {
            return true;
        }
    ));
});

function ape_rest_child_all()
{
    global $wpdb;
    $rows = $wpdb->get_results("SELECT * FROM wp_ape_user_child");
    return $rows;
};

//ROUTE POST NEW CHILD
function ape_rest_child_register()
{
    // WE DEFINE NEW ROAD FOR POST NEW CHILD
    register_rest_route('wp/v2', 'child', array(
        'methods' => 'POST',
        'callback' => 'ape_rest_user_child_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

function ape_rest_user_child_handler($request)
{
    $response = [];
    $parameters = $request->get_json_params();
    $child_firstname = sanitize_text_field($parameters['child_firstname']);
    $child_lastname = sanitize_text_field($parameters['child_lastname']);
    $child_class = sanitize_text_field($parameters['child_class']);
    $user_id = ($parameters['child_class']);

    //POST SQL REQUEST 
    global $wpdb;
    $rows = $wpdb->get_results("INSERT INTO wp_ape_user_child(
        child_firstname, child_lastname, child_class
         )
VALUES ('$child_firstname',
        '$child_lastname',
        '$child_class')");

    ape_rest_link_child_handler($user_id);

    return
        $response['code'] = 200;
};

function ape_rest_link_child_handler($user_id)
{
    global $wpdb;
    //REQUEST ID OF THE LAST ADD CHILD

    $last_child = $wpdb->get_results("SELECT * FROM wp_ape_user_child ORDER BY id DESC LIMIT 1");
    $select_child = $last_child[0];
    $child_id = $select_child->id;

    //REQUEST SQL CREATE NEW LINK
    $rowss = $wpdb->get_results("INSERT INTO wp_ape_link_child(
         user_id, child_id
          )

         VALUES ('$user_id', '$child_id')");
    return $rowss;
};