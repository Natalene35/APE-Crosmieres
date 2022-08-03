<?php
// var_dump("coucou");

// @ini_set('upload_max_size', '256M');
// @ini_set('post_max_size', '256M');
// @ini_set('max_execution_time', '300');


// source : https://stackoverflow.com/questions/17751779/increase-max-upload-limit-in-wordpress

// var_dump(
//     // Determines the maximum upload size allowed in php.ini.
//     wp_max_upload_size()
// );


// connexion the callback function to init hook for custom routes
add_action('rest_api_init', 'ape_rest_upload_resize_media');

// to get the endpoint and add custom function
function ape_rest_upload_resize_media()
{
    // custom route when event added
    register_rest_route('wp/v2', 'mediaresize', array(
        'methods' => 'POST',
        'callback' => 'ape_rest_resize_media_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}


// sources : https://cloudinary.com/blog/image_optimization_in_php#:~:text=Compressing%20Images%20With%20PHP&text=You%20can%20compress%20images%20in,the%20PHP's%20GD%20Graphics%20Library.


function ape_rest_resize_media_handler($request)
{


    // // translate request with JSON
    // $parameters = $request->get_json_params();

    // $title = sanitize_text_field($parameters['title']);
    // $content = sanitize_text_field($parameters['content']);
    // $date = sanitize_text_field($parameters['date']);
    // $lieu = sanitize_text_field($parameters['lieu']);
    // $terms = sanitize_text_field($parameters['terms']);


    // // add to the database
    // $post_id = wp_insert_post([
    //     'post_title' => $title,
    //     'post_content' => $content,
    //     'post_type' => 'event',
    //     'post_status' => 'publish'
    // ]);
    // //add the meta key and value with the post id
    // add_post_meta($post_id, 'lieu', $lieu);
    // add_post_meta($post_id, 'date', $date);

    // wp_set_post_terms($post_id, $terms, "eventtype");

    // // return post's id or false
    // return $post_id ? ["id" => $post_id] : false;
};




// sources : https://makitweb.com/how-to-compress-image-size-while-uploading-with-php/


if(isset($_POST['upload'])){

  // Getting file name
  $filename = $_FILES['imagefile']['name'];
 
  // Valid extension
  $valid_ext = array('png','jpeg','jpg');

  // Location
  $location = "images/".$filename;

  // file extension
  $file_extension = pathinfo($location, PATHINFO_EXTENSION);
  $file_extension = strtolower($file_extension);

  // Check extension
  if(in_array($file_extension,$valid_ext)){

    // Compress Image
    compressImage($_FILES['imagefile']['tmp_name'],$location,60);

  }else{
    echo "Invalid file type.";
  }
}

// Compress image
function compressImage($source, $destination, $quality) {

  $info = getimagesize($source);

  if ($info['mime'] == 'image/jpeg') 
    $image = imagecreatefromjpeg($source);

  elseif ($info['mime'] == 'image/gif') 
    $image = imagecreatefromgif($source);

  elseif ($info['mime'] == 'image/png') 
    $image = imagecreatefrompng($source);

  imagejpeg($image, $destination, $quality);

}
