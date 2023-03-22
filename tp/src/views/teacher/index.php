<?php

use \utils\{PublicFile, View, Verification};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('index') ?>">
    <title>All Teacher</title>
</head>

<body>
    <?php View::render('partials/header'); ?>
    <h1 class="padding-10">Teachers</h1>
    <table class="padding-10">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Firstname</th>
                <th>Page</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher) : ?>
                <tr>
                    <td><?= $teacher->getId() ?></td>
                    <td><?= $teacher->getName() ?></td>
                    <td><?= $teacher->getFirstname() ?></td>
                    <td><a href="<?= '/teacher/get/' . $teacher->getId() ?>">personal page</a></td>
                    <?php if(Verification::isIdEquivalent($teacher->getId()) && Verification::isTeacher()): ?>
                        <td><a href="<?= '/teacher/update/' . $teacher->getId() ?>">update</a></td>
                        <td><a href="<?= '/teacher/delete/' . $teacher->getId() ?>">delete</a></td>
                    <?php endif ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>