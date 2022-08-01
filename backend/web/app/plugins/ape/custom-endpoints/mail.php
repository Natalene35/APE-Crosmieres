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
    // translate request with JSON
    $parameters = $request->get_json_params();

    $name = sanitize_text_field($parameters['name']);
    $email = sanitize_text_field($parameters['email']);
    $body = sanitize_text_field($parameters['body']);

    $mail = new PHPMailer();

    $email = "chrisdmar12@gmail.com";
    // $name = "Kévin";
    $subject = "$name viens de s'inscrire à l'événement";
    $body .= "
        <br>
        <h1>$name s'est inscrit</h1>
        <p>Sort le champ's</p>
        ";


    // fonctionne avec hotmail
    // Parametre SMTP
    // Nom de serveur : smtp.office365.com
    // Port : 587
    // Méthode de chiffrement : STARTTLS


    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "chrisdmar12@gmail.com"; //expediteur
    $mail->Password = '';
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";



    //email settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name); // expediteur and name
    $mail->addAddress($email); // destinataire
    $mail->Subject = $subject;
    $mail->Body = $body;

    // return  $mail;

    if ($mail->send()) {
        $status = "success";
        $response = "Email is sent!";
    } else {
        $status = "failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));
}



function sendWithPhpMailer($subject, $body, $reply)
{
    require(ABSPATH . WPINC . '/class-phpmailer.php');
    require(ABSPATH . WPINC . '/class-smtp.php');

    // date_default_timezone_set( 'America/Sao_Paulo' );

    $blogname = wp_strip_all_tags(trim(get_option('blogname')));
    $smtpHost = wp_strip_all_tags(trim(get_option('smtp_host')));
    $mailPort = wp_strip_all_tags(trim(get_option('smtp_port')));
    $smtpUser = wp_strip_all_tags(trim(get_option('smtp_user')));
    $smtpPass = wp_strip_all_tags(trim(get_option('smtp_pass')));
    $mailTo = wp_strip_all_tags(trim(get_option('mail_to')));

    $send = false;
    $mail = new PHPMailer;

    try {
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->Sender = $smtpUser;
        $mail->CharSet = 'utf-8';
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Port = $mailPort;
        $mail->Host = $smtpHost;
        $mail->Username = $smtpUser;
        $mail->Password = $smtpPass;
        $mail->Subject = $subject;
        $mail->From = $smtpUser;
        $mail->setFrom($smtpUser, $blogname);
        $mail->addReplyTo($reply);
        $mail->addAddress($mailTo);

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');

        $mail->isHTML(true);
        $mail->Body = $body;

        $send = $mail->Send();

        $mail->ClearAllRecipients();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: $mail->ErrorInfo \n";
        echo "Error: $e";
        return false;
    }

    return $send;
}
