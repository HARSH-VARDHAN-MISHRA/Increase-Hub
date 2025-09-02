<?php
$subject = 'New Customer Order'; // Subject of your email
$to = 'contact@designesia.com';  // Recipient's E-mail

// Collect form data
$first_name   = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
$last_name    = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
$name         = trim($first_name . ' ' . $last_name);
$email        = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone        = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$company_size = isset($_POST['company_size']) ? trim($_POST['company_size']) : '';
$company_name = isset($_POST['company_name']) ? trim($_POST['company_name']) : '';
$website      = isset($_POST['website']) ? trim($_POST['website']) : '';
$msg          = isset($_POST['message']) ? trim($_POST['message']) : '';

// Collect services (can be multiple checkboxes)
$services = '';
if (isset($_POST['services'])) {
    if (is_array($_POST['services'])) {
        $services = implode(', ', $_POST['services']);
    } else {
        $services = $_POST['services'];
    }
}

// Email headers
$email_from = $name . ' <' . $email . '>';

$headers  = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/plain; charset=utf-8\r\n";
$headers .= "From: " . $name . " <" . $email . ">\r\n";
$headers .= "Return-Path: " . $email . "\r\n";

// Email body
$message  = "Name: " . $name . "\n";
$message .= "Email: " . $email . "\n";
$message .= "Phone: " . $phone . "\n";
$message .= "Company Size: " . $company_size . "\n";
$message .= "Company Name: " . $company_name . "\n";
$message .= "Website: " . $website . "\n";
$message .= "Services: " . $services . "\n";
$message .= "Message: " . $msg . "\n";

// Send email
if (@mail($to, $subject, $message, $headers)) {
    echo 'sent';
} else {
    echo 'failed';
}
?>
