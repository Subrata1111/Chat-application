<?php
session_start();
include "config.php";

$stmt = $conn->prepare("SELECT * FROM msg");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        if($data['email']===$_SESSION['email']){
            ?>
            <p class="sender">
                <span><?= $data['email'] ?></span>
                <?= $data['msg'] ?>
            </p>
            <?php
        }else{
            ?>
            <p>
                <span><?= $data['email'] ?></span>
                <?= $data['msg'] ?>
            </p>
            <?php
        }
    } 
}else{
    echo "No message yet";
}

?>