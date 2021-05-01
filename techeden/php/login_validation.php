<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select * from users where username='".$_POST['username']."'");
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row==null){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Invalid username or password.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
else{
    if($row['password']==$_POST['password']){
        $_SESSION['logged']=$row['username'];
        echo '<script>location.reload()</script>';
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Invalid username or password.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        
    }
}
?>