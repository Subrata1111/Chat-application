<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if user already exists
    $stmt = $conn->prepare("SELECT id FROM userinfo WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email already registered.";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO userinfo (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            header("Location: index1.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="login-register.css">
</head>

<body>
    <div class="container">
        <div class="right-container">
            <h1>Create Account</h1><br>
            <form action="" method="post">
                <div>
                    <label>Name</label><br>
                    <input type="text" name="name" id="name" required><br>
                    <label>Email Id</label><br>
                    <input type="email" name="email" id="email" required>
                    <label for="">Password</label><br>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required>
                        <span class="toggle-button" onclick="document.getElementById('password').type = (document.getElementById('password').type === 'password' ? 'text' : 'password')">👁️</span>
                    </div><br>
                    <button type="submit" name="signup">Sign Up</button>
                </div>
            </form>

        </div>
        <div class="left-container">
            <h1>Welcome</h1><br>
            <p>Enter your personal details and start journey with us</p><br>
            <a href="login1.php"><button>Sign In</button> </a>
        </div>
    </div>
</body>

</html>