<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$status=1;
$stmt=$pdo->query("update requests set status='".$status."',acceptor='".$_SESSION['logged']."'  where sl='".$_POST['sl']."'");
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Request Accepted successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        
?>