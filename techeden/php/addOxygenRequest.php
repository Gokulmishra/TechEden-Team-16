<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->prepare("insert into requests (username,name,address,contact,quantity,deadline) values (:username,:name,:address,:phone,:volume,:date)");
$stmt->execute(
    array(
        ':username'=>$_SESSION['logged'],
        ':name'=>$_POST['name'],
        ':address'=>$_POST['address'],
        ':phone'=>$_POST['phone'],
        ':volume'=>$_POST['volume'],
        ':date'=>$_POST['date']
    )
    );
?>