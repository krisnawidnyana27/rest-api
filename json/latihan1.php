<?php

// $mahasiswa = [
//     [
//     "nama" => "Krisna",
//     "nim" => "220030153",
//     "email" => "krisna@gmail.com"
//     ],
//     [
//         "nama" => "Krisna",
//         "nim" => "220030153",
//         "email" => "krisna@gmail.com"
//         ]
// ];


$dbh = new PDO ('mysql:host=localhost;
dbname=test', 'root', '');
$db = $dbh->prepare('SELECT * FROM siswa');
$db->execute();
$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);

$data = json_encode($mahasiswa);
echo $data;
?>