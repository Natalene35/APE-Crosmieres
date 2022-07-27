<?php

namespace Controller;

use Controller\TemplateController;

class UserController
{

    public static function admin()
    {
        if (is_user_logged_in()) {
            // charger le fichier view
            require plugin_dir_path(__FILE__) . '../views/admin.php';
            // empecher le déroulement du reste par wp
            die;
        } else {
            // TODO redirect vers l'accueil
        }
    }


    public static function delete()
    {
        if (is_user_logged_in()) {
            // charger le fichier view
            require plugin_dir_path(__FILE__) . '../views/delete_confirm.php';
            // empecher le déroulement du reste par wp
            die;
        }
    }

    public static function deleteConfirm()
    {
        // d($_POST['confirmation']);
        if (is_user_logged_in() && $_POST['confirmation'] === "confirm") {
            $user = wp_get_current_user();
            $user_id = $user->ID;
            $name = $user->user_nicename;
            require_once(ABSPATH . 'wp-admin/includes/user.php');
            wp_logout();
            wp_delete_user($user_id);
            // echo "<h1>L\'utilisateur <strong>$name</strong> a bien été supprimé.</h1>";
            TemplateController::home(); // = wp_redirect(home_url());

        } else {
            TemplateController::messageAlert("<script>alert('Annulation')</script>");
            // echo '<h1 style="font-size:3rem;background-color:green;text-align:center;"><strong>Annulation</strong></h1>';
        }
        // wp_redirect(home_url());
    }

}
