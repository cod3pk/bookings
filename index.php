<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'cooper_flights') or die("not connected");
$sql = "SELECT * FROM flight";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .home-img{
            height: 20px;
            width: 20px;
        }

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

<?php
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
    echo "<pre>";
        echo "<h2> Flight Number: </h2> " . $row["flight_number"]
            . " flight_datetime " . $row["flight_datetime"]
            . " <h3> Status:   " . "<img class='home-img' src='" . $row["status"] . ".svg" .  "'></h3>"
            . " Departure  " . $row["from_airport"]
            . " • Destination Airport  " . $row["to_airport"]
            . " • The Plane  " . $row["plane"]
            . " distance_km " . $row["distance_km"] .
            "<br><br><br>";
    }
} else {
    echo "0 results";
}

$connection->close();
?>


</body>
</html>
