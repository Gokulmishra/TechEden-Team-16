<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select  * from  requests where acceptor='".$_SESSION['logged']."' and delivery='not_assigned' order by deadline;");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $send="".$row['username']."";
    echo '
    <li class="col-md-5 col-lg-5" style="box-sizing:border-box;margin:10px;>
    <div class="container-fluid">
    <div class="event">Name: '.$row['name'].'</div>
    <div class="event">Address: '.$row['address'].'</div>
    <div class="event">Contact Number: '.$row['contact'].'</div>
    <div class="event">Quantity : '.$row['quantity'].' Litres</div>
    <div class="event">Deadline : '.$row['deadline'].'</div>
    <div id="'.$row['sl'].'" class="event"></div>
    <button class="btn btn-primary" onclick="return showDirections(\''.$send.'\')" >Directions</button>
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
                        document.getElementById("'.$row['sl'].'").innerHTML = "Distance : " + json.route.distance + " Km";
                        
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
    <form>
        <label for="deliveryboy">Assign Delivery Agent</label>
        <select name="delivery" id="delivery'.$row['sl'].'">';
        $stmt1=$pdo->query("select * from users where org='delivery';");
        while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)){
            echo'
            <option value="'.$row1['username'].'">'.$row1['username'].'</option>
            ';
        }
echo'</select>
    </form>
    <button class="btn btn-primary" onclick="return assignAgent(\''.$row['sl'].'\')">Assign</button>
    </li>

    ';
}
