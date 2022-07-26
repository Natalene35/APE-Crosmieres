<?php 

add_action('rest_api_init', 'ape_rest_meta_update');
//<----------------------------------ROAD-------------------------->>
function ape_rest_meta_update()
{
    // custom route when sale added
    register_rest_route('wp/v2', 'meta/(?P<id>\d+)', array(
        'methods' => 'POST',
        'callback' => 'ape_rest_update_meta_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}


function ape_rest_update_meta_handler($request)
{
    global $wpdb;
    // translate request with JSON
    $parameters = $request->get_json_params();
    // $date = sanitize_text_field($parameters['date']);
    
    $id=$parameters['id'];
    $location = sanitize_text_field($parameters['lieu']);
 
    // $lien = sanitize_text_field($parameters['lien']);
    // if($location!=null){
    // get the meta data 'lieu'
    $lieu = $wpdb->get_results("
    UPDATE wp_postmeta 
    SET meta_value= $location WHERE meta_key = lieu AND post_id = 116 ");
    
    // }
    // add_post_meta($id, 'lieu', $location);
    // add_post_meta($id, 'date', $date);
    // add_post_meta($id, 'lien', $lien);

    // if($date!=null){
    // // get the meta data 'date'
    // $eventDate = $wpdb->get_results("
    // SELECT meta_value FROM wp_postmeta
    // WHERE meta_key = 'date' AND post_id = $id 
    // ");
    // }
    
    // if($link!=null){
    // // get the meta data 'lien'
    // $link = $wpdb->get_results("
    // SELECT meta_value FROM wp_postmeta
    // WHERE meta_key = 'lien' AND post_id = $id 
    // ");
    // }

};

// // update request content to the custom post and update custom post meta
// function ape_rest_update_sale_handler($request)
// {
//     global $wpdb;

//     // get the parameter 'id' into request and sanitize it
//     $id = $request->get_param('id');
//     $title = sanitize_text_field($request->get_param('title'));
//     $content = sanitize_text_field($request->get_param('content'));
//     $date = sanitize_text_field($request->get_param('date'));
//     $link = sanitize_text_field($request->get_param('link'));
//     $place = sanitize_text_field($request->get_param('place'));
//     // update the require post 
//     $data = array(
//         'ID' => $id,
//         'post_content' => $title,
//         'post_content' => $content,
//         'meta_input' => array(
//           'date' => $date,
//           'lieu' => $place,
//           'lien' => $link
//          ));
       
//        $post[] = wp_update_post( $data );
    

//     var_dump($wp_update_post( $data ));die;
//     // update the meta data 'lieu'
//     $salePlace = $wpdb->get_results("
//     UPDATE wp_postmeta
//     SET meta_value= $place WHERE meta_key = 'lieu' AND post_id =$id");

//     // update the meta data 'date'
//     $eventDate = $wpdb->get_results("
//     UPDATE `wp_postmeta` 
//     SET `meta_value`= '$date' WHERE `meta_key` = date AND `post_id` =".$id);
//      // update the meta data 'lien'
//      $eventLink = $wpdb->get_results("
//      UPDATE `wp_postmeta` 
//      SET `meta_value`= '$link' WHERE `meta_key` = lien AND `post_id` =".$id);

//     // add the meta data to the post object
//     $post[] = ['lieu' => $salePlace[0]->meta_value];
//     $post[] = ['date' => $eventDate[0]->meta_value];
//     $post[] = ['lien' => $eventLink[0]->meta_value];
//     return $post;
// };