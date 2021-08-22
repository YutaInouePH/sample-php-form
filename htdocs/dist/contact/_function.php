<?php

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__.'/../vendor/autoload.php';

/**
 * Send mail.
 * 
 * @param array $input
 * @return void
 */
function sendMail($input)
{
    // If input itself is null, do not execute this function.
    if(is_null($input)) return ;

    $dotenv = Dotenv::createImmutable(__DIR__.'/');
    $dotenv->load();

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer();

    $mailData = mailDetail($input);
    $admin_to = 'admin@sample.com';

    try {
        mb_language("ja");
		mb_internal_encoding("UTF-8");
        
        //Server settings. Needs manually changing since no .env file not available
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $mail->Port = $_ENV['MAIL_PORT'];

        // Set the from name.
        $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
        // Set the Recipients (User side).
        $mail->addAddress($mailData['user_for_send_mail']);

        //Content
        $mail->isHTML(false);
        $mail->Subject = $mailData['subject_user'];
        $mail->Body = $mailData['mail_text_user'];
        $mail->AltBody = $mailData['mail_text_user'];

        $mail->send();

        //Clear all addresses and attachments for the next iteration
        $mail->clearAddresses();
        $mail->clearAttachments();

        // Set the from name.
        $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
        // Set the Recipients (Admin side).
        $mail->addAddress($admin_to);

        //Content
        $mail->isHTML(false);
        $mail->Subject = $mailData['subject_admin'];
        $mail->Body = $mailData['mail_text_admin'];
        $mail->AltBody = $mailData['mail_text_admin'];

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        die();
        // Redirect to mail sending error (optional).
    }
}

/**
 * Generate mail body.
 * 
 * @return array
 */
function mailDetail($input)
{
    $subject_admin = 'You received an inquiry from a user.';

    // Mail text body to Admin.
    $mail_text_admin = null;

    $mail_text_admin .= "Please reply to this user."."<br><br>";
    $mail_text_admin .= "Email: ".$input['email']."<br>";
    $mail_text_admin .= "Full Name: ".$input['name']."<br>";
    $mail_text_admin .= "Radio Item: ".$input['item-radio']."<br>";
    $mail_text_admin .= "Details: ".$input['details']."<br>";
    $mail_text_admin .= ""."<br>";

    // Mail text body to User.
    $subject_user = 'Thank you for submitting an inquiry';

    $mail_text_user = null;

    $mail_text_user .= ""."<br>";
    $mail_text_user .= "We will check the details and get back to you."."<br>";
    $mail_text_user .= "Please wait for a reply email<br><br>";

    $mail_text_user .= "Email: ".$input['email']."<br>";
    $mail_text_user .= "Full Name: ".$input['name']."<br>";
    $mail_text_user .= "Radio Item: ".$input['item-radio']."<br>";
    $mail_text_user .= "Details: ".$input['details']."<br>";
    $mail_text_user .= ""."<br>";

    $data = [
        'subject_admin' => $subject_admin,
        'mail_text_admin' => $mail_text_admin,
        'user_for_send_mail' => $input['email'],
        'subject_user' => $subject_user,
        'mail_text_user'=> $mail_text_user,
    ];

    return $data;
}

/**
 * Return all fields from POST input.
 * 
 * @return array
 */
function data()
{
    $input = array();

    foreach(fields() as $field) {
        $input[$field] = isset($_POST[$field]) ? $_POST[$field] : null;
    }

    return $input;
}

/**
 * Return key index of input.
 * 
 * @return array
 */
function fields()
{
    // Change array here accordingly to the <input name="">'s name attribute.
    // _token should always be available.
    return [
        '_token', 'email', 'name', 'details', 'item-radio',
    ];
}
?>