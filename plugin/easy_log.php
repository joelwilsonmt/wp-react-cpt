<?php
function cLog($message) {
    // Ensure the message is a string and escape it
    $message = json_encode($message); // Safely encode the message to JSON to handle special characters and ensure valid JavaScript

    add_action('admin_footer', function() use ($message) {
        echo "<script>console.log('$message');</script>";
    });
}

?>
