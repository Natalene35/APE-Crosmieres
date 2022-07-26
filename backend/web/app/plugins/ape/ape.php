<?php
/* 
Plugin Name: APE Crosmières custom
Description: ajout de gestion d'évenements et ventes initiatives pour les Association de parent d'élèves
Author: Natalène D, Emilie P, Loïc D, Julien L et Christophe D
Version: 0.0.2
*/



require __DIR__ . '/vendor/autoload.php';


// add files to create custom post type
require_once plugin_dir_path(__FILE__) . "post-types/event.php";
require_once plugin_dir_path(__FILE__) . "post-types/sale.php";


// add files to create custom 
require_once plugin_dir_path(__FILE__) . "custom-endpoints/event.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/sale.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/registration.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/child.php";
