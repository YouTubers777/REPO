<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (!$email) {
        echo "<script>alert('Invalid email address. Please enter a valid email.'); window.history.back();</script>";
        exit;
    }

    // Make a safe filename from username (allow letters, numbers, underscore)
    $safe_name = preg_replace("/[^a-zA-Z0-9_-]/", "_", $name);

    // Directory to store messages
    $dir = __DIR__ . "/messages";

    // Auto create folder if not exist
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    // Filename with timestamp to avoid overwriting
    $filename = $dir . "/" . $safe_name . "_" . date("Ymd_His") . ".txt";

    // Content to save
    $content = "Name: $name\nEmail: $email\nMessage:\n$message\n";

    // Save the content to the file
    if (file_put_contents($filename, $content)) {
        echo "<script>alert('Message saved successfully!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Failed to save message. Try again.'); window.history.back();</script>";
    }
}
?>
