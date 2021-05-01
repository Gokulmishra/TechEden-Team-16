<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select  * from  requests where acceptor='".$_SESSION['logged']."';");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    if($row['deliverystatus']==0){
        echo '
    <li class="col-md-4 col-lg-4" style="box-sizing:border-box;background:none;padding:10px;">
    <div class="container-fluid" style="background:var(--warning);padding:25px;border-radius:20px;">
    <div class="event">Name: '.$row['name'].'</div>
    <div class="event">Address: '.$row['address'].'</div>
    <div class="event">Contact Number: '.$row['contact'].'</div>
    <div class="event">Quantity : '.$row['quantity'].' Litres</div>
    <div class="event">Deadline : '.$row['deadline'].'</div>
    </div>
    </li>';
    }
    else{
        echo '
    <li class="col-md-4 col-lg-4" style="box-sizing:border-box;background:none;padding:10px;">
    <div class="container-fluid" style="background:var(--success);padding:25px;border-radius:20px;">
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