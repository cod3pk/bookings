<?php
session_start();
if (!isset($_SESSION['exists'])) {
    header("Location: login.php");
}
$connection = mysqli_connect('localhost', 'root', '', 'cooper_flights') or die("not connected");
?>

<!DOCTYPE html>
<html>
<head>
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
    <link rel="stylesheet" href="style.css">
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

<?php
$flight_id = $_SESSION['plane_id'];
$query = "SELECT flight_number FROM flight WHERE id='$flight_id'";
$result = mysqli_query($connection, $query);
$flight_num = "";
while ($row = mysqli_fetch_assoc($result)) {
    $flight_num = $row['flight_number'];
}

if (isset($_POST['book'])) {
    $user_id = $_SESSION['id'];
    $booking_date = date("Y-m-d h:i:s");
    $sql12 = "INSERT INTO booking (flight_id, customer_id, checkin_datetime,booking_datetime) VALUES ('$flight_id','$user_id','$booking_date','$booking_date')";
    $result2 = mysqli_query($connection, $sql12);

    if ($result2) {
        echo "<script>alert('Booking done successfully');</script>";
    } else {
//        echo "<script>alert('Booking cannot be done');</script>";
        echo "Cannot Insert". mysqli_error($connection);
    }

}


?>

<!-- The Code of Body Starts from here -->
<div class="container">
    <h1 style="text-align: center"> New Booking </h1>
    <div class="homeForm">
        <form action="#" method="post">
            <label><b>Flight Number</b></label>
            <input type="text" value="<?php echo $flight_num ?>">
            <br><br>
            <Label><b> Amount: 455$ </b></Label>
            <br><br>
            <label><b>Credit Card Number</b></label>
            <input type="text" placeholder="Enter Credit Card Number">
            <label><b>Name</b></label>
            <input type="text" placeholder="Enter Name On Credit Card" name="name">
            <label><b>Expiry Date</b></label>
            <input type="date">
            <br><br>
            <input type="submit" name="book" value="Book">
        </form>

    </div>
</div>

</body>
</html>
