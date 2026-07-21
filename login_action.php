<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['usersigninbtn'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM clients WHERE email='$email' LIMIT 1";
    $run = mysqli_query($conn, $sql);

    if ($run && mysqli_num_rows($run) > 0) {

        $data = mysqli_fetch_assoc($run);

       if (
    $password === $data['password'] ||
    md5($password) === $data['password']
) {

            session_start();
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['user_name'] = $data['name'];
            $_SESSION['user_email'] = $data['email'];

            header("Location: dashboard.php");
            exit();

        } else {
            echo "<script>
                alert('Password not match');
                window.location.href='register.php';
            </script>";
        }

    } else {
        echo "<script>
            alert('Email not exists');
            window.location.href='register.php';
        </script>";
    }
}
?>