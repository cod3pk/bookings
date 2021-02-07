<?php

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['pass']);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $suburb = $_POST['suburb'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $user_status = $_POST['user_status'];

    $connection = mysqli_connect("localhost", "root", "", "cooper_flights");

    $query = "INSERT INTO customer (fname,lname,email,password,address,suburb,state,postcode,phone,admin) VALUES ('$fname','$lname','$email','$password','$address','$suburb','$state','$postcode','$phone','$user_status')";
    $result = mysqli_query($connection, $query);

    if ($result == true) {
        $id = $connection->insert_id;
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['exists'] = true;
        header("Location: index.php");
    } else {
        echo "Registration Failed" . mysqli_error($connection);
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
    <h2 style="text-align: center"> Registration </h2>
    <div class="homeForm">

        <form name="regForm" action="#" method="post">
            <label><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email">
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pass" id="pass">
            <label><b>First Name</b></label>
            <input type="text" placeholder="First Name" name="fname" id="fname">
            <label><b>Last Name</b></label>
            <input type="text" placeholder="Last Name" name="lname" id="lname">
            <label><b>Address</b></label>
            <input type="text" placeholder="Enter Address" name="address" id="address">
            <label><b>Suburb</b></label>
            <input type="text" placeholder="Enter Suburb" name="suburb" id="suburb">
            <label><b>State</b></label>
            <input type="text" placeholder="Enter State" name="state" id="state">
            <label><b>Post Code</b></label>
            <input type="text" placeholder="Enter Post Code" name="postcode" id="postcode">
            <label><b>Phone</b></label>
            <input type="text" placeholder="Enter Phone" name="phone" id="phone">
            <label><b>Admin</b></label>
            <input type="text" value="0" name="user_status" id="user_status">
            <br><br>

            <input type="submit" name="submit" value="Register">
        </form>

    </div>
</div>
</body>
</html>