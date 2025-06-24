<?php
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $ConfirmPassword = $_POST['ConfirmPassword'];

    if($Password != $ConfirmPassword) {
        echo "Passwords do not match. Please try again.";
    } else {
        $conn = new mysqli('localhost', 'root', '', 'travel_db');
        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO register (Username, Email, Password, ConfirmPassword) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $Username, $Email, $Password, $ConfirmPassword);
            $stmt->execute();
            echo "Registered successfully...";
            $stmt->close();
            $conn->close();
        }
    }
?>
