<?php

add_action('rest_api_init', 'ape_rest_user_register');


function ape_rest_user_register()
{
    // WE DEFINE NEW ROAD FOR POST NEW USERS
    register_rest_route('wp/v2', 'users/register', array(
        'methods' => 'POST',
        'callback' => 'ape_rest_user_register_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

function ape_rest_user_register_handler($request)
{
    $response = [];
    $parameters = $request->get_json_params();
    $pseudo = sanitize_text_field($parameters['pseudo']);
    $email = sanitize_text_field($parameters['email']);
    $password = sanitize_text_field($parameters['password']);
    $firstname = sanitize_text_field($parameters['firstname']);
    $lastname = sanitize_text_field($parameters['lastname']);
    $phone =    sanitize_text_field($parameters['phone']);
    // $child_class = sanitize_text_field($parameters['child_class']);
    // $child_firstname = sanitize_text_field($parameters['child_firstname']);
    // $child_lastname = sanitize_text_field($parameters['child_lastname']);
    $error = new WP_Error();
    if (empty($pseudo)) {
        $error->add(400, __("Pseudo field 'pseudo' is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    if (empty($email)) {
        $error->add(401, __("Email field 'email' is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    if (empty($password)) {
        $error->add(404, __("Password field 'password' is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }

    if (empty($firstname)) {
        $error->add(404, __("firstname field 'firstname' is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    if (empty($lastname)) {
        $error->add(404, __("lastname field 'lastname' is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    $user_id = username_exists($pseudo);
    if (!$user_id && email_exists($email) == false) {
        $user_id = wp_insert_user([
            'user_pass' => $password,
            'user_login' => $pseudo,
            'user_email' => $email,
            'first_name' => $firstname,
            'last_name' => $lastname
        ]);
        if (!is_wp_error($user_id)) {
            $user = get_user_by('id', $user_id);
            // add_user_meta($user_id, 'phone', $phone);
            // ape_child_handler($child_class, $child_firstname, $child_lastname, $user_id);

            $response['code'] = 200;
            $response['message'] = __("User '" . $pseudo . "' Registration was Successful", "wp-rest-user");
        } else {
            return $user_id;
        }
    } else {
        $error->add(406, __("Email already exists, please try 'Reset Password'", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    return new WP_REST_Response($response, 123);
};
//When User Register updating the child table
// function ape_child_handler($child_class, $child_firstname, $child_lastname, $user_id)
// {
//     $response = [];
//     global $wpdb;
//     $row = $wpdb->get_results("INSERT INTO wp_ape_user_child(
//         child_firstname, child_lastname, child_class
//         )
//     VALUES ('$child_firstname',
//         '$child_lastname',
//         '$child_class')");
//     // USE THE FUNCTION LINK CHILD FOR CREATE NEW LINK WITH USER_id
//     ape_rest_link_child_handler($user_id);
//     return $row;
// };
// function ape_rest_link_child_handler($user_id)
// {
//     global $wpdb;
//     //REQUEST ID OF THE LAST ADD CHILD
//     $last_child = $wpdb->get_results("SELECT * FROM wp_ape_user_child ORDER BY id DESC LIMIT 1");
//     $select_child = $last_child[0];
//     $child_id = $select_child->id;
//     $response = [];
//     //REQUEST SQL CREATE NEW LINK
//     $rowss = $wpdb->get_results("INSERT INTO wp_ape_link_child(
//         user_id, child_id
//          )
//         VALUES ('$user_id', '$child_id')");
//     return $rowss;
// };