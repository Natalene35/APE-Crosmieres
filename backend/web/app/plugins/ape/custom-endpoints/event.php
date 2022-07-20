<?php

add_action('rest_api_init', 'ape_rest_event_register');
function ape_rest_event_register()
{
    // Definit une nouvelle route pour notre inscription d'utilisateur
    register_rest_route('wp/v2', 'event', array(
        'methods' => 'POST',
        'callback' => 'ape_rest_add_event_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

function ape_rest_add_event_handler($request)
{
    // Preparation de la réponse HTTP
    $response = [];
    // Recuperation du formulaire sous un format JSON
    $parameters = $request->get_json_params();
    $title = sanitize_text_field($parameters['title']);
    $content = sanitize_text_field($parameters['content']);
    $date = sanitize_text_field($parameters['date']);
    $lieu = sanitize_text_field($parameters['lieu']);
    
    
        $post_id = wp_insert_post([
            'post_title' => $title,
            'post_content' => $content,
            'post_type' => 'event'
        ]);
        add_post_meta($post_id, 'lieu', $lieu);
        add_post_meta($post_id, 'date', $date);
    return new WP_REST_Response($response, 123);
};