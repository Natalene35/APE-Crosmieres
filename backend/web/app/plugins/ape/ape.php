<?php
/* 
Plugin Name: APE Crosmières custom
Description: ajout de gestion d'évenements et ventes initiatives pour les Association de parent d'élèves
Author: Natalène D, Emilie P, Loïc D, Julien L et Christophe D
Version: 0.0.3
*/



require __DIR__ . '/vendor/autoload.php';


// add files to create custom post type
require_once plugin_dir_path(__FILE__) . "post-types/event.php";
require_once plugin_dir_path(__FILE__) . "post-types/sale.php";


// add files to create custom endpoint
require_once plugin_dir_path(__FILE__) . "custom-endpoints/event.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/sale.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/registration.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/child.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/user.php";

// add files to create custom role
require_once plugin_dir_path(__FILE__) . "custom-roles/ApeMember.php";
require_once plugin_dir_path(__FILE__) . "custom-roles/ApeUser.php";


// function to load when plugin is actived or desactived
register_activation_hook(__FILE__, 'ape_create_custom_roles');
register_deactivation_hook(__FILE__, 'ape_remove_custom_roles');


function ape_create_custom_roles()
{
    ape_create_apemember_role();
    ape_create_apeuser_role();
}

function ape_remove_custom_roles()
{
    ape_remove_apemember_role();
    ape_remove_apeuser_role();
}
