<?php

$users = [
    [
        'name' => 'prenom',
        'lastname' => 'nom',
        'mail' => 'prenom@nom.fr'
    ],
    [
        'name' => 'prenom2',
        'lastname' => 'nom2',
        'mail' => 'prenom2@nom2.fr'
    ]
];

function printInfos(array $users) {
    foreach($users as $user) {
        echo $user['name'] . ' ' . $user['lastname'] ;
        echo 'Mail : ' . $user['mail'];
    }
}

echo $users[0]['name'] . ' ' . $users[0]['lastname'] . ' ' . $users[0]['mail'] . "\n";
echo $users[1]['name'] . ' ' . $users[1]['lastname'] . ' ' . $users[1]['mail'];
