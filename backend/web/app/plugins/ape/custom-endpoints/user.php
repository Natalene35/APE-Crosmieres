<?php

// add function to the init hook
add_action('rest_api_init', 'ape_rest_user_delete_personnal_account');
add_action('rest_api_init', 'ape_rest_user_update_personnal_meta');


// create route WP for customize
function ape_rest_user_delete_personnal_account()
{
    register_rest_route('wp/v2', 'user', array(
        'methods' => 'DELETE',
        'callback' => 'ape_rest_user_delete_personnal_account_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}


function ape_rest_user_delete_personnal_account_handler($request)
{
    $parameters = $request->get_json_params();
    $user = wp_get_current_user();
    $user_id = $user->ID;
    $name = $user->user_nicename;

    require_once(ABSPATH . 'wp-admin/includes/user.php');

    if (is_user_logged_in()) {
        wp_logout();
        $response = wp_delete_user($user_id, 1);
        return [
            'name' => $name,
            'remove_user' => $response
        ];
    } else if (is_user_logged_in() === false) {
        return ["error" => "Vous devez être connecté"];
    } else {
        return ["error" => "Une erreur s'est produite, veuillez réessayer svp..."];
    }
};

// create route WP for update meta user 
function ape_rest_user_update_personnal_meta()
{
    register_rest_route('wp/v2', 'users/meta/(?P<id>\d+)', array(
        'methods' => 'PUT',
        'callback' => 'ape_rest_user_update_personnal_meta_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

function ape_rest_user_update_personnal_meta_handler($request)
{
    //get logged in user id
    $user = wp_get_current_user();
    $user_id = $user->ID;

    //parameter transmission of the new phone
    $parameters = $request->get_json_params();
    $phone = sanitize_text_field($parameters['phone']);

    //Update the mata data phone
    $new_Phone = update_user_meta(
        $user_id,
        'phone',
        $phone
    );

    return $new_Phone;
}