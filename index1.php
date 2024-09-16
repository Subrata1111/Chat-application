<?php
session_start();
if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
    $name = htmlspecialchars($_SESSION['name']);
    $email = htmlspecialchars($_SESSION['email']);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ChatPage</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h1>Welcome <span></span></h1>
        <div class="chat">
            <h3>Welcome <span><?= $_SESSION['name'] ?></span></h3>
            <div class="msg">

            </div>
            <div class="input-msg">
                <input type="text" placeholder="Write message here" id="input_msg">
                <button onclick="update()">Send</button>
            </div>
        </div>
    </body>
    <script src="script1.js"></script>

    </html>
<?php
}
?>