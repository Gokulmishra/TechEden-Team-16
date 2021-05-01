<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select  * from  requests where delivery='".$_SESSION['logged']."' and deliverystatus='0' order by deadline;");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $send="".$row['username']."";
    echo '
    <li class="col-md-4 col-lg-4" style="box-sizing:border-box;background:none;padding:10px;">
    <div class="container-fluid" style="background:#fff2;padding:25px;border-radius:20px;">
    <div class="event">Name: '.$row['name'].'</div>
    <div class="event">Address: '.$row['address'].'</div>
    <div class="event">Contact Number: '.$row['contact'].'</div>
    <div class="event">Quantity : '.$row['quantity'].' Litres</div>
    <div class="event">Deadline : '.$row['deadline'].'</div>
    <div id="distance'.$row['sl'].'" class="event"></div>
    <div id="time'.$row['sl'].'" class="event"></div>
    <button class="btn btn-primary" onclick="return showDirections(\''.$send.'\')" >Directions</button>
    <button class="btn btn-primary" onclick="return markasDelivered('.$row['sl'].')">Mark as Delivered</button>
        <script>var username = "'.$row['username'].'";
        $.ajax({
            type: "POST",
            url: "http://localhost/techeden/php/getLocation.php",
            dataType: "json",
            data: {
                username: username
            },
            success: function(data) {
                var xhr = new XMLHttpRequest();
                var url = "http://www.mapquestapi.com/directions/v2/route?key=haFujM3v9pYWgSiUzQQwc0rkdlEGzwJS";
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var json = JSON.parse(xhr.responseText);
                        console.log(json);
                        document.getElementById("distance'.$row['sl'].'").innerHTML = "Distance : " + json.route.distance + " Km";
                        document.getElementById("time'.$row['sl'].'").innerHTML = "Estimated Time : " + json.route.formattedTime;
                        
                    }
                };
                var data = JSON.stringify({
                    "locations": [{
                        "latLng": {
                            "lat": data[0],
                            "lng": data[1]
                        }
                    }, {
                        "latLng": {
                            "lat": data[2],
                            "lng": data[3]
                        }
                    }],
                    "options": {
                        "avoids": [],
                        "avoidTimedConditions": false,
                        "doReverseGeocode": true,
                        "shapeFormat": "raw",
                        "generalize": 0,
                        "routeType": "fastest",
                        "timeType": 1,
                        "locale": "en_US",
                        "unit": "m",
                        "enhancedNarrative": false,
                        "drivingStyle": 2,
                        "highwayEfficiency": 21.0
                    }
                });
                xhr.send(data);
            }
        });
        </script>
    </div>
    
    </li>

    ';
}
