<?php 
use \utils\PublicFile;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('index')?>">
    <title>All Teacher</title>
</head>
<body>
    <?php include_once(__DIR__ . '/../partials/header.php') ?>
    <h1 class="padding-10">Teachers</h1>
    <table class="padding-10">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>firstname</th>
                <th>page</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher) : ?>
                <tr>
                    <td><?= $teacher->getId() ?></td>
                    <td><?= $teacher->getName() ?></td>
                    <td><?= $teacher->getFirstname() ?></td>
                    <td><a href="<?= '/teacher/get/'. $teacher->getId()?>">personal page</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>