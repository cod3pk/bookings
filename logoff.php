<?php

session_start();
$_SESSION['exists'] = false;
session_destroy();
header("Location: login.php");