<?php
session_start();
session_unset(); // Removes all session variables
session_destroy(); // Destroys the session

// Redirect to the login page
header('Location: login.php');
exit;
?>