<?php
require_once('./config.php');
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Fetch user details from `client_list`
    $qry = $conn->query("SELECT * FROM client_list WHERE email = '$email' AND delete_flag = 0");

    if ($qry->num_rows > 0) {
        $user = $qry->fetch_assoc();
        $hashed_password = $user['password'];

        // Verify password using password_verify()
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            header('Content-Type: application/json');
            echo json_encode(["status" => "success"]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(["status" => "failed", "msg" => "Incorrect password!"]);
            exit;
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(["status" => "failed", "msg" => "Email not found!"]);
        exit;
    }
}
?>
