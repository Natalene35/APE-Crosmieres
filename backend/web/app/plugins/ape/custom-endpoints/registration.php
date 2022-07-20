<?php

add_action('rest_api_init', 'ape_rest_user_register');


function ape_rest_user_register()
{
    // Definit une nouvelle route pour notre inscription d'utilisateur
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
    // Preparation de la réponse HTTP
    $response = [];
    // Recuperation du formulaire sous un format JSON
    $parameters = $request->get_json_params();
    $pseudo = sanitize_text_field($parameters['pseudo']);
    $email = sanitize_text_field($parameters['email']);
    $password = sanitize_text_field($parameters['password']);
    $firstname = sanitize_text_field($parameters['firstname']);
    $lastname = sanitize_text_field($parameters['lastname']);
    $phone =    sanitize_text_field($parameters['phone']);
    $child_class = sanitize_text_field($parameters['child_class']);
    $child_firstname = sanitize_text_field($parameters['child_firstname']);
    $child_lastname =sanitize_text_field($parameters['child_lastname']);
    // Préparation des erreurs en cas de non validation des données
    $error = new WP_Error();
    // Verification du contenu du formulaire
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
    
    // Verification qu'un utilisateur avec le même username n'existe pas.
    $user_id = username_exists($pseudo);
    // Idem avec le mail
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
            add_user_meta( $user_id, 'phone', $phone ); 
            ape_child_handler($child_class, $child_firstname, $child_lastname);
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
function ape_child_handler($child_class, $child_firstname, $child_lastname)
{
    $response = [];
    global $wpdb;
    $rows = $wpdb->get_results("INSERT INTO wp_child(
        child_firstname, child_lastname, child_class
        )
VALUES ('$child_firstname',
        '$child_lastname',
        '$child_class')");
    
    return $rows;
};