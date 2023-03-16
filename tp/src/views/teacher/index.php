<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Teacher</title>
</head>
<body>
    <h1>Teachers</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>firstname</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher) : ?>
                <tr>
                    <td><?= $teacher->getId() ?></td>
                    <td><?= $teacher->getName() ?></td>
                    <td><?= $teacher->getFirstname() ?></td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>