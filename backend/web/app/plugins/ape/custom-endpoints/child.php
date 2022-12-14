<?php

add_action('rest_api_init', 'ape_rest_child_register');
add_action('rest_api_init', 'ape_rest_child_update');

// Route get all childs
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', 'child', array(
        'methods' => 'GET',
        'callback' => 'ape_rest_child_all',
        'permission_callback' => function () {
            return true;
        }
    ));
});

// return list of all childs
function ape_rest_child_all()
{
    global $wpdb;
    $rows = $wpdb->get_results("SELECT * FROM wp_ape_user_child");
    return $rows;
};

// Route get child by id
add_action('rest_api_init', function () {
    register_rest_route(
        'wp/v2',
        'child/(?P<id>\d+)',
        array(
            'methods' => 'GET',
            'callback' => 'ape_rest_child_by_user',
            'permission_callback' => function () {
                return true;
            }
        )
    );
});

// return childs to user 
function ape_rest_child_by_user($request)
{
    global $wpdb;
    $id = sanitize_text_field($request->get_param('id'));
    $rows = $wpdb->get_results(
        "SELECT *
        FROM `wp_ape_user_child` 
        INNER JOIN `wp_ape_link_child` ON child_id = wp_ape_user_child.id
        WHERE  user_id = $id"
    );
    return $rows;
};


// ROUTE POST NEW CHILD
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



//ROUTE UPDATE  CHILD
function ape_rest_child_update()
{
    // WE DEFINE NEW ROAD FOR Update NEW CHILD
    register_rest_route('wp/v2', 'child/update/(?P<id>\d+)', array(
        'methods' => 'POST',
        'callback' => 'ape_rest_update_child_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}


function ape_rest_update_child_handler($request)
{
    $parameters = $request->get_json_params();
    $child_firstname = sanitize_text_field($parameters['child_firstname']);
    $child_lastname = sanitize_text_field($parameters['child_lastname']);
    $child_class = sanitize_text_field($parameters['child_class']);
    $id = $parameters['id'];
    global $wpdb;

    $rows = $wpdb->get_results(" UPDATE wp_ape_user_child
        SET child_firstname = '$child_firstname', child_lastname = '$child_lastname', child_class = '$child_class'
        WHERE id = '$id' ");

    return $rows;
};


function ape_rest_user_child_handler($request)
{
    $response = [];
    $parameters = $request->get_json_params();
    $child_firstname = sanitize_text_field($parameters['child_firstname']);
    $child_lastname = sanitize_text_field($parameters['child_lastname']);
    $child_class = sanitize_text_field($parameters['child_class']);
    $user_id = sanitize_text_field($parameters['user_id']);

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
    return
        $response['code'] = 200;
};
