<?php
/*
* Plugin Name: APE Crosmières custom
* Description: ajout de gestion d'évenements et ventes initiatives pour les Association de parent d'élèves
* Author: Natalène D, Emilie P, Loïc D, Julien L et Christophe D
* Version: 0.0.1
*/
require __DIR__ . '/vendor/autoload.php';
use Migration\Child_PostMigration;
use Migration\Link_PostMigration;
require_once plugin_dir_path(__FILE__) . "post-types/event.php";
require_once plugin_dir_path(__FILE__) . "post-types/sale.php";
require_once plugin_dir_path(__FILE__) . "custom-roles/CR_ApeMember.php";


register_activation_hook(__FILE__, 'ape_create_custom_roles');
require_once plugin_dir_path(__FILE__) . "custom-endpoints/registration.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/child.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/link.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/event.php";
require_once plugin_dir_path(__FILE__) . "custom-endpoints/sale.php";

function ape_create_custom_roles()
{
    ape_create_membre_role();
    Child_PostMigration::createTable();
    // Création de la table custom
    Link_PostMigration::createTable();
}

register_deactivation_hook(__FILE__, 'ape_remove_custom_roles');
function ape_remove_custom_roles()
{
    ape_remove_membre_role();
    Child_PostMigration::deleteTable();
    // Suppression de la table custom
    Link_PostMigration::deleteTable();
}
