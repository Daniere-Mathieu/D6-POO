<?php

use \utils\{PublicFile, View};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('index') ?>">
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('card') ?>">
</head>

<body class='card-body'>
    <?php View::render('partials/header'); ?>
    <h1>Home</h1>
    <a href="/teachers" target="_blank" rel="noopener noreferrer">Teachers list</a>
</body>

</html>