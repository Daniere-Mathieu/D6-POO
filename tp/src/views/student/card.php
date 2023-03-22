<?php

use \utils\{PublicFile, View};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $student->__toString() ?></title>
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('index') ?>">
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('card') ?>">
</head>

<body class='card-body'>
    <?php View::render('partials/header'); ?>
    <h1>Card</h1>
    <div class="card">
        <div>
            <img class="img-200" src="<?= PublicFile::getImageFile($student->getId()) ?>" alt="">
        </div>
        <div>
            <h2><?= $student->getFullName() ?></h2>
            <a href="mailto:<?= $student->getEmail() ?>"><?= $student->getEmail() ?></a>
        </div>
    </div>
</body>

</html>