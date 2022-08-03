<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// add function to the init hook
add_action('rest_api_init', 'ape_rest_user_email');


// create route WP for customize
function ape_rest_user_email()
{
    register_rest_route('wp/v2', 'send', array(
        'methods' => 'POST',
        'callback' => 'ape_rest_user_send_email',
        'permission_callback' => function () {
            return true;
        }
    ));
}


function ape_rest_user_send_email($request)
{
    // translate request with JSON and sanitize every field send
    $parameters = $request->get_json_params();

    $name = sanitize_text_field($parameters['name']);
    $email = sanitize_text_field($parameters['email']);
    $message = sanitize_text_field($parameters['message']);
    $nbsaucisse = sanitize_text_field($parameters['nbsaucisse']);
    $motive = sanitize_text_field($parameters['motive']);
    $startTime = sanitize_text_field($parameters['startTime']);
    $endTime = sanitize_text_field($parameters['endTime']);
    $eventTitle = sanitize_text_field($parameters['eventTitle']);

    $mail = new PHPMailer();

    // to choose subject and message to send
    if ($motive === 'participer') {
        $subject = utf8_decode("Inscription à ") . html_entity_decode($eventTitle);
        $body = "
        <h3>$name viens à l'événement : $eventTitle</h3>
        <p>mail : $email</p>
        <p>Message :</p> $message";
    } else if ($motive === 'aider') {
        $subject = utf8_decode("Volontariat pour ") . html_entity_decode($eventTitle);
        $body = "
        <h3>$name veux participer à l'événement : $eventTitle</h3>
        <p>Il est disponible de $startTime à $endTime</p>
        <p>mail : $email</p>
        <p>Message :</p> $message";
    } else  if ($motive === 'commander') {
        $subject = utf8_decode("Commande pour ") . html_entity_decode($eventTitle);
        $body = "
        <h3>$name veux $nbsaucisse saucisses pour l'événement : $eventTitle</h3>
        <p>mail : $email</p>
        <p>Message :</p> $message";
    } else {
        $subject = utf8_decode("Erreur de lecture du motif pour ") . html_entity_decode($eventTitle);
        $body = "
        <h3>$name s'est inscrit à l'événement : $eventTitle</h3>
        <p>Son message n'est pas très clair.</p>
        <p>mail : $email</p>
        <p>Message :</p> $message";
    }


    // configuration avec hotmail
    // Parametre SMTP
    // Nom de serveur : smtp.office365.com
    // Port : 587
    // Méthode de chiffrement : STARTTLS


    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "chrisdmar12@gmail.com"; // the sender
    $mail->Password = 'qsxriotatequwnsc';
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";


    //email settings
    $mail->CharSet = 'utf-8';
    $mail->isHTML(true);
    $mail->setFrom("Page inscription", $name); // sender and his name
    $mail->addAddress("chrisdmar12@gmail.com"); // recipient
    $mail->Subject = $subject;
    $mail->Body = $body;

    if ($mail->send()) {
        return [
            "status" => "success",
            "message" => "Message envoyé"
        ];
    } else {
        return [
            "status" => "failed",
            "message" => "Une erreur s'est produite, veuillez réessayer plus tard..."
        ];
    }
}
