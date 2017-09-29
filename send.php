<?php
include('./phpmailer/class.phpmailer.php');

// Send forms to this email address
$boss = 'contact_form@rogerscpallc.com';



//Edit these to match the HTML Form fileds
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$phone = trim($_POST['phone']);
$email = strtolower(trim($_POST['email']));
$comment = trim($_POST['comment']);


// Retrieve the email template required
$message = file_get_contents('email.htm');

// Replace the % with the actual information
$message = str_replace('%first_name%', $first_name, $message);
$message = str_replace('%last_name%', $last_name, $message);
$message = str_replace('%phone%', $phone, $message);
$message = str_replace('%email%', $email, $message);
$message = str_replace('%comment%', $comment, $message);

// Setup PHPMailer
echo $message;
$mail = new PHPMailer();
$mail->IsSMTP();
// This is the SMTP mail server
// $mail->From = "from@example.com";
// $mail->FromName = "Mailer";
$mail->From = "contact_form@rogerscpallc.com";
$mail->FromName = "RogersCPA LLC Website Contact Form";
$mail->Host = 'localhost';
// Remove these next 3 lines if you dont need SMTP authentication
// Set who the email is coming from
// Set who the email is sending to
$mail->AddAddress($boss);
$mail->AddBCC($email);
$mail->AddBCC('bt@widgital.net');

// Set the subject
$mail->Subject = 'RogersCPA LLC Website Contact Form';
//Set the message
$mail->IsHTML(true); 
$mail->Body = $message;
$mail->AltBody = strip_tags($message);
// Send the email
if(!$mail->Send()) {
 echo "Mailer Error: " . $mail->ErrorInfo;
}
?>
