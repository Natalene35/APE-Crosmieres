<?php

add_action('rest_api_init', 'ape_rest_event_detail_register');
function ape_rest_event_detail_register()
{
    // custom route for event detail
    // '(?P<id>\\d+)' // the full argument (parathenses are to group it)
    // '?P' // denotes that this is a parameter
    // '<id>' // the name of the parameter
    // '\\d+' // indicates the paramter should be an integer

    register_rest_route('wp/v2', 'event/meta/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'ape_rest_get_event_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

// add request content to the custom post and add custom post meta
function ape_rest_get_event_handler($request)
{
    global $wpdb;

    // get the parameter 'id' into request and sanitize it
    $id = sanitize_text_field($request->get_param('id'));

    // get the require post 
    $post[] = get_post($id);

    // get the meta data 'lieu'
    $lieu = $wpdb->get_results("
    SELECT meta_value FROM wp_postmeta
    WHERE meta_key = 'lieu' AND post_id = $id 
    ");

    // get the meta data 'date'
    $eventDate = $wpdb->get_results("
    SELECT meta_value FROM wp_postmeta
    WHERE meta_key = 'date' AND post_id = $id 
    ");

    // add the meta data to the post object
    $post[] = ['lieu' => $lieu[0]->meta_value];
    $post[] = ['date' => $eventDate[0]->meta_value];

    return $post;
};