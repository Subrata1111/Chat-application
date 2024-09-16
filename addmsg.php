<?php
session_start();
include('config.php');

$msg = $_GET["msg"];
$email = $_SESSION['email'];

$stmt = $conn->prepare("SELECT id FROM userinfo WHERE email = ?");
$stmt->bind_param("s", $email); // Bind the email parameter
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt2 = $conn->prepare("INSERT INTO msg (email, msg) VALUES (?, ?)");
    if ($stmt2) {
        $stmt2->bind_param("ss", $email, $msg); // Bind the parameters
        $stmt2->execute();
        if ($stmt2->affected_rows > 0) {
            echo 'Message successfully inserted.';
        } else {
            echo 'Failed to insert message.';
        }

        $stmt2->close(); // Close the statement
    } else {
        echo 'Failed to prepare message insert statement.';
    }
} else {
    echo 'User not found.';
}

$stmt->close(); // Close the statement
