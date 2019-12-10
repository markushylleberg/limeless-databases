<?php
$host   = 'localhost';
$user   = 'root';
$pass   = '';
$db     = 'myvirtualpantry';
$dsn = "mysql:host=$host;dbname=$db";
$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(
    PDO::ATTR_DEFAULT_FETCH_MODE,
    PDO::FETCH_OBJ
);
$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/app.css">
    <title>MY VIRTUAL PANTRY</title>
</head>
<body>
<header>
<nav>
<iframe src="https://giphy.com/embed/1oIMaEKhA0WLEV3KRj" width="50" height="50" frameBorder="0" class="giphy-embed"></iframe>
</nav>
</header>
<div id="pageContent">
