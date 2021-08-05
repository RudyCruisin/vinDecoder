<?php
require_once 'includes/database.php';
session_start();
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rudy's VIN Decoder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-dark justify-content-center" style="background-color:#242428;">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="datadisplay.php">STORED DATA</a>
                </li>
            </ul>
        </nav>

    </header>