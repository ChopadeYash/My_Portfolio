<?php
// Fetching Values from URL.
$name = $_POST['name1'];
$email = $_POST['email1'];
$message = $_POST['message1'];
$subject1 = $_POST['subject1'];
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing E-mail.

// After sanitization Validation is performed
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    // $subject = $name;
    // To send HTML mail, the Content-type header must be set.
    $headers = 'MIME-Version: 1.0' . "rn";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "rn";
    $headers .= 'From:' . $email. "rn"; // Sender's Email
    $headers .= 'Cc:' . $email. "rn"; // Carbon copy to Sender
    $template = '<div style="padding:50px; color:white;">Hello  ' . $name . ',<br/>'
    . '<br/>Thank you...! For Contacting Us.<br/><br/>'
    . 'Name:' . $name . '<br/>'
    . 'Email:' . $email . '<br/>'
    . 'Subject:' . $subject1 . '<br/>'
    . 'Message:' . $message . '<br/><br/>' 
    . 'This is a Contact Confirmation mail.'
    . '<br/>'
    . 'We Will contact You as soon as possible .</div>';
    $sendmessage = '<div style="background-color:#7E7E7E; color:white">' . $template . "</div>";
    // Message lines should not exceed 70 characters (PHP rule), so wrap it.
    $sendmessage = wordwrap($sendmessage, 70);
    // Send mail by PHP Mail Function.
    mail("yashchopade2002@gmail.com ", $subject1, $sendmessage, $headers);
    echo "Your Query has been received, We will contact you soon.";

    //Logging form data to a file
    $logFilePath = 'C:/xampp/htdocs/Portfolio_Website/forms/form_data.log';
    $formData = [
    'name' => $name,
    'email' => $email,
    'message' => $message,
    'subject' => $subject1
    ];
    $logMessage = '[' . date('Y-m-d H:i:s') . '] ' . json_encode($formData) . "\n";
    file_put_contents($logFilePath, $logMessage, FILE_APPEND);
    // Displaying form data as JSON response
    header('Content-Type: application/json');
    echo json_encode($formData);
    
} else {
    echo "<span>* invalid email *</span>";
}
?>