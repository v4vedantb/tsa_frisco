<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $name = strip_tags(trim($_POST["resourceName"]));
    $email = filter_var(trim($_POST["resourceEmail"]), FILTER_SANITIZE_EMAIL);
    $category = strip_tags(trim($_POST["resourceCategory"]));
    $description = strip_tags(trim($_POST["resourceDescription"]));

    // Recipient email
    $to = "v3d.ytshorts@gmail.com";
    $subject = "New Resource Submission from Frisco Website";

    // Email content
    $message = "You have received a new resource submission:\n\n";
    $message .= "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Category: $category\n";
    $message .= "Description:\n$description\n";

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        // Redirect to thank-you page on success
        header("Location: thankyou.html");
        exit();
    } else {
        // Handle errors
        echo "<p>Oops! Something went wrong, please try again later.</p>";
    }
} else {
    // If not a POST request, redirect to form page
    header("Location: resources.html");
    exit();
}
?>
