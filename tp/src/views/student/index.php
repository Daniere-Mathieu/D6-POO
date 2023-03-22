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
    <title>All Students</title>
</head>

<body>
    <?php View::render('partials/header'); ?>
    <h1 class="padding-10">Students</h1>
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
            <?php foreach ($students as $student) : ?>
                <tr>
                    <td><?= $student->getId() ?></td>
                    <td><?= $student->getName() ?></td>
                    <td><?= $student->getFirstname() ?></td>
                    <td><a href="<?= '/student/get/' . $student->getId() ?>">personal page</a></td>
                    <?php if(Verification::isIdEquivalent($student->getId()) && Verification::isStudent()): ?>
                        <td><a href="<?= '/student/update/' . $student->getId() ?>">update</a></td>
                        <td><a href="<?= '/student/delete/' . $student->getId() ?>">delete</a></td>
                    <?php endif ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>