<?php

session_start();
if (!isset($_SESSION['exists'])){
    header("Location: login.php");
}
$connection = mysqli_connect('localhost', 'root', '', 'cooper_flights') or die("not connected");

if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['pass']);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $suburb = $_POST['suburb'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $s_id = $_SESSION['id'];
    $query = "UPDATE customer SET fname='$fname',lname='$lname',email='$email',password='$password',address='$address',suburb='$suburb',state='$state',postcode='$postcode',phone='$phone' WHERE id='$s_id'";
    $result = mysqli_query($connection, $query);

    if ($result == true) {
        echo "<script>alert('Records Updated');</script>";
    } else {
        echo "Cannot be updated" . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }
    </style>
</head>
<body>

<ul>
    <?php
    if (isset($_SESSION['exists'])) {
        echo "<li><a href='index.php'>Home</a></li>";
        echo "<li><a href='profile.php'>My Profile </a></li>";
        echo "<li><a href='newbooking.php'>New Bookings</a></li>";
        echo "<li><a href='bookings.php'>Bookings</a></li>";
        echo "<li><a href='flights.php'>Flights</a></li>";
        echo "<li><a href='logoff.php'>Logout</a></li>";
    } else {
        echo "<li><a href='index.php'>Home</a></li>";
        echo "<li><a href='profile.php'>My Profile </a></li>";
        echo "<li><a href='newbooking.php'>New Bookings</a></li>";
        echo "<li><a href='bookings.php'>Bookings</a></li>";
        echo "<li><a href='flights.php'>Flights</a></li>";
        echo "<li><a href='register.php'>Register</a></li>";
        echo "<li><a href='login.php'>Login</a></li>";
    }
    ?>
</ul>

<!-- The Code of Body Starts from here -->
<div class="container">
    <h1 style="text-align: center"> Profile </h1>
    <div class="homeForm">
<?php
$id = $_SESSION['id'];
$sql = "SELECT * FROM customer WHERE id = '$id'";
$result = $connection->query($sql);
while ($row = mysqli_fetch_assoc($result)){

?>
        <form name="regForm" action="#" method="post">
            <label><b>Email</b></label>
            <input type="text" name="email" value="<?php echo $row['email'];?>" id="email">
            <label><b>Password</b></label>
            <input type="password" name="pass" value="<?php echo $row['password'];?>" id="pass">
            <label><b>First Name</b></label>
            <input type="text" name="fname" value="<?php echo $row['fname'];?>" id="fname">
            <label><b>Last Name</b></label>
            <input type="text" name="lname" value="<?php echo $row['lname'];?>" id="lname">
            <label><b>Address</b></label>
            <input type="text" name="address" value="<?php echo $row['address'];?>" id="address">
            <label><b>Suburb</b></label>
            <input type="text" name="suburb" value="<?php echo $row['suburb'];?>" id="suburb">
            <label><b>State</b></label>
            <input type="text" name="state" value="<?php echo $row['state'];?>" id="state">
            <label><b>Post Code</b></label>
            <input type="text" name="postcode" value="<?php echo $row['postcode'];?>" id="postcode">
            <label><b>Phone</b></label>
            <input type="text" name="phone" value="<?php echo $row['phone'];?>" id="phone">
            <br>
            <input type="submit" name="submit" value="Save">
        </form>
     <?php   } ?>
    </div>
</div>



</body>
</html>
