<?php 
use \utils\PublicFile;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $teacher->getName() ?></title>
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('index')?>">
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('card')?>">
</head>
<body>
    <h1>Card</h1>
    <div>
        <div>
            <img src="<?= PublicFile::getImageFile($teacher->getId()) ?>" alt="">
        </div>
        <div>
            <h1><?= $teacher->getName() . " " . $teacher->getFirstname(); ?></h1>
            <p><?= $teacher->getEmail() ?></p>
        </div>
    </div>
</body>
</html>