<?php
require 'vendor/autoload.php'; // Include Composer's autoload file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Your SendGrid API key
    $apiKey = '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';

    // Create a new SendGrid Mail object
    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("your-email@example.com", "Your Name");
    $email->setSubject("New Contact Form Submission");
    $email->addTo("isirollan@gmail.com", "Isidora Rollan Zegers");
    $email->addContent("text/html", "
        <html>
        <head>
            <title>New Contact Form Submission</title>
        </head>
        <body>
            <h2>Contact Form Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong> $message</p>
        </body>
        </html>
    ");

    // Send email via SendGrid
    $sendgrid = new \SendGrid($apiKey);

    try {
        $response = $sendgrid->send($email);
        echo "Message sent successfully.";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
}
?>
