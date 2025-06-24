<?php
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$conn = new mysqli('localhost', 'root', '', 'travel_db');
if ($conn->connect_error) {
    die('Login Failed :' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("SELECT * FROM register WHERE Username = ?");
    $stmt->bind_param("s", $Username);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows > 0) {        
        $data = $stmt_result->fetch_assoc();    
        if ($data['Password'] === $Password) {
            echo "<h2>Login Successful</h2>";
            $login_stmt = $conn->prepare("INSERT INTO login (Username, Password) VALUES (?, ?)");
            $login_stmt->bind_param("ss", $Username, $Password);
            $login_stmt->execute();
            $login_stmt->close();
        } else {
            echo "<h2>Incorrect password</h2>";
        }
    } else {
        echo "<h2>Invalid Username</h2>";
    }
    $stmt->close();
    $conn->close();
}
?>
