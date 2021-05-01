<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select  * from users where username='".$_POST['username']."'");
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$lat=$row['lat'];
$lng=$row['lng'];
$stmt=$pdo->query("select  * from users where username='".$_SESSION['logged']."'");
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$clat=$row['lat'];
$clng=$row['lng'];
$data="[$lat,$lng,$clat,$clng]";
print $data;
?>