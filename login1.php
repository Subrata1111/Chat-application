<?php
include 'config.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT id, name,email, password FROM userinfo WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    // $stmt->store_result();

    // Store the result
    $stmt->store_result();

    // Check if any row is returned
    if ($stmt->num_rows > 0) {
        // Bind the result variable
        $stmt->bind_result($id, $name, $sto_email, $sto_password);
        $stmt->fetch();


        // Verify the password
        if ($password == $sto_password) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $sto_email;
            header("Location: index1.php");
            exit();
        } else {
            echo '<script>alert("Your password may be incorrect! Try Again.")</script>';
            // Redirect after displaying the message after 3 sec
            header("Refresh:0; URL=login1.php");
            // header("Location: login1.php");
            exit();
        }
    } else {
        echo "No user found with the provided email.";
        header("Location: register1.php");
        exit();
    }

    // Close the statement
    $stmt->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="login-register.css">
</head>

<body>
    <div class="container">
        <div class="left-container">
            <h1>Welcome Back</h1><br>
            <p>To keep connect with us please login with your personal info</p><br>
            <a href="register1.php"><button>Sign Up</button></a>
        </div>
        <div class="right-container">
            <h1>Sign In</h1><br>
            <form action="" method="post">
                <div>
                    <label>Email Id</label><br>
                    <input type="email" name="email" id="email" required>
                    <label for="">Password</label><br>

                    <div class="password-container">
                        <input type="password" id="password" name="password" required>
                        <span class="toggle-button" onclick="document.getElementById('password').type = (document.getElementById('password').type === 'password' ? 'text' : 'password')">👁️</span>
                    </div><br>
                    <button type="submit" name="signin">Sign IN</button>
                </div>
            </form>
            <br>
            <a href="forgot_password.php"><button>Forgot Your Password?</button><br></a>
        </div>
    </div>
</body>

</html>