<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Validate the name and email
    $stmt = $conn->prepare("SELECT password FROM userinfo WHERE name = ? AND email = ?");
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($password);
        $stmt->fetch();
        echo "Your password is: " . htmlspecialchars($password);
    } else {
        echo "No account found with the provided username and email.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="login-register.css">
</head>
<body>
    <form method="POST" action="forgot_password.php">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <input type="submit" value="Retrieve Password">
    </form>
</body>
</html>

