<?php
ob_start();
session_start();

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = hash('sha256', $_POST['pass']);

    if ($email == "") {
        echo "<script>alert('Email Required')</script>";
    } else {
        $connection = mysqli_connect("localhost", "root", "", "cooper_flights");
        $query = "SELECT * FROM customer WHERE email='{$email}'";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $db_email = $row['email'];
            $db_pass = $row['password'];
            $id = $row['id'];
            if ($email == $db_email && $password == $db_pass) {
                echo "<script>alert('ok')</script>";
                $_SESSION['id'] = $id;
                $_SESSION['exists'] = true;
                header("Location: index.php");
            } else {
                echo "<script>alert('Invalid Credentials')</script>";
            }
        }
    }


}
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 style="text-align: center"> Booking System </h1>
    <h2 style="text-align: center"> Login </h2>
    <div class="homeForm">

        <form action="#" method="post">
            <label><b>Username</b></label>
            <input type="text" placeholder="Email" name="email" id="Email">
            <br><br>
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pass" id="pass">
            <br><br>
            <input type="submit" name="submit" placeholder="Login">

        </form>

    </div>
</div>
</body>
</html>