<?php 
use \utils\PublicFile;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $teacher->getFullName() ?></title>
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('index')?>">
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('card')?>">
</head>
<body class='card-body'>
    <?php include_once(__DIR__ . '/../partials/header.php') ?>
    <h1>Card</h1>
    <div class="card">
        <div>
            <img class="img-200" src="<?= PublicFile::getImageFile($teacher->getId()) ?>" alt="">
        </div>
        <div>
            <h2><?= $teacher->getFullName() ?></h2>
            <a href="mailto:<?= $teacher->getEmail() ?>"><?= $teacher->getEmail() ?></a>
        </div>
    </div>
</body>
</html>