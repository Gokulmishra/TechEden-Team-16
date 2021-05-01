<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("select * from users where username='" . $_POST['username'] . "'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $err = 0;
    if (!$result == null) {
        $err = 1;
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Username is alredy taken.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
    $stmt = $pdo->query("select * from users where email='" . $_POST['email'] . "'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result == null) {
        $err = 1;
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">an account with the email already exists.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }


    if ($err == 0) {
        $stmt = $pdo->prepare("insert into users values(:username,:password,:email,:org,:lat,:lng)");
        $stmt->execute(
            array(
                ':username' => $_POST['username'],
                ':password' => $_POST['password'],
                ':email' => $_POST['email'],
                ':org' => $_POST['org'],
                ':lat' =>$_POST['lat'],
                ':lng' =>$_POST['lng']
            )
        );
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Your account has been succesfully created<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        
    
} 
?>