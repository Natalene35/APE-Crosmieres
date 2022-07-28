<?php

// add function to the init hook
add_action('rest_api_init', 'ape_rest_user_delete_personnal_account');


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
    $confirm = sanitize_text_field($parameters['confirm']);
    $user = wp_get_current_user();
    $user_id = $user->ID;
    $name = $user->user_nicename;

    require_once(ABSPATH . 'wp-admin/includes/user.php');

    if (is_user_logged_in()) {
        wp_logout();
        $response = wp_delete_user($user_id);
        return [
            'name' => $name,
            'remove_user' => $response
        ];
    } else if (is_user_logged_in() === false) {
        return ["error" => "Vous devez être connecté"];
    } else if (!$parameters['confirm']) {
        return ["error" => "Vous n'avez pas les droits necéssaire pour supprimer ce compte"];
    } {
        return ["error" => "Une erreur s'est produite, veuillez réessayer svp..."];
    }
};
