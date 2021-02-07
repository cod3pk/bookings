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
        .home-img {
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
    // Output data of each row
    while ($row = $result->fetch_assoc()) {

        echo "<pre>";
        $c_datetime = date("Y-m-d h:i:s");
        $cd_datetime = date_create($c_datetime);
        $db_datetime = $row['flight_datetime'];
        $db2_database = date_create($db_datetime);
        $interval = date_diff($cd_datetime, $db2_database);
        $datetime_diff = $interval->format('%R%a days');
        if ($datetime_diff < 0 || $datetime_diff == 0) {
            echo "<h2><b>Status: Flight has Passed <img class='home-img' src='departed.svg'></b></h2>";
        } else if ($datetime_diff > 2) {
            echo "<h2><b>Status: Flight is Staged <img class='home-img' src='staged.svg'></b></h2>";
        } else if ($datetime_diff > 0 && $datetime_diff <= 2) {
            echo "<h2><b>Status: Flight is Open <img class='home-img' src='open.svg'></b></h2>";
        }
        echo "<h2>Flight Number: {$row["flight_number"]} </h2>" . "<br>"
            . "<b>Flight Date & Time: </b>{$row["flight_datetime"]}"
            . "<b> || Departure: </b>{$row["from_airport"]}"
            . "<b> || Destination Airport: </b>{$row["to_airport"]}"
            . "<b> || The Plane: </b>{$row["plane"]}"
            . "<b> || Distance: </b>{$row["distance_km"]}" . "<hr>" .
            "<br><br><br>";
    }
} else {
    echo "<h1>No Flights Available</h1>";
}
$connection->close();
?>

</body>
</html>
