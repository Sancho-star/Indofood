<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$successMessage = "";  // Initialize success message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $feedback = htmlspecialchars($_POST['feedback'] ?? '');

    // Debugging output
    var_dump($email); // Check the email format

    // Sanitize and validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Send the feedback via email
        $to = "asanchit97@gmail.com";  // Replace with your actual email address
        $subject = "New Feedback from $name";
        $headers = "From: $email\r\n";

        $body = "Name: $name\nEmail: $email\n\nFeedback:\n$feedback";

        // Uncomment the line below to actually send the email
        if (mail($to, $subject, $body, $headers)) {
            // Set success message
            $successMessage = "Thank you, $name! Your feedback has been sent.";
        } else {
            $successMessage = "There was an error sending your feedback. Please try again later.";
        }
    } else {
        $successMessage = "Invalid email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
</head>
<body>
    <h2>Submit Your Feedback</h2>

    <?php if (!empty($successMessage)): ?>
        <p><?php echo $successMessage; ?></p>
    <?php else: ?>
        <form action="" method="POST">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="feedback">Your Feedback:</label><br>
            <textarea id="feedback" name="feedback" rows="5" cols="30" required></textarea><br><br>

            <input type="submit" value="Submit Feedback">
        </form>
    <?php endif; ?>
</body>
</html>
