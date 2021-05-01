<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$status=0;
$stmt=$pdo->query("select  * from  requests where username='".$_SESSION['logged']."' and status='".$status."';");
if($stmt->fetch(PDO::FETCH_ASSOC)==null){
    echo "<div>No Sent Requests.</div>";
}
else{
    $stmt=$pdo->query("select  * from  requests where username='".$_SESSION['logged']."' and status='".$status."';");
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo '
    <li>
    <div class="container-fluid">
    <div class="event">Name: '.$row['name'].'</div>
    <div class="event">Address: '.$row['address'].'</div>
    <div class="event">Contact Number: '.$row['contact'].'</div>
    <div class="event">Quantity : '.$row['quantity'].' Litres</div>
    <div class="event">Deadline : '.$row['deadline'].'</div>
    </div>
    </li>

    ';
}
}


?>