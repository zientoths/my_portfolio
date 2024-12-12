<?php
$conn = new mysqli('localhost', 'root', '', 'responsive_portfolio');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
