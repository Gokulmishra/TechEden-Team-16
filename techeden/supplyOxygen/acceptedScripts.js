showAcceptedRequests();
console.log("hi")

function showAcceptedRequests() {
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/showSupplyAcceptedRequests.php",
        success: function(html) {
            $("#acceptedRequestList").html(html).show();
        }
    });
}
window.onload = function() {
    L.mapquest.key = 'haFujM3v9pYWgSiUzQQwc0rkdlEGzwJS';

    var map = L.mapquest.map('map', {
        center: [15, 79],
        layers: L.mapquest.tileLayer('map'),
        zoom: 5
    });
    map.addControl(L.mapquest.control());
}

function showDirections(inusername) {
    var username = inusername;
    console.log(username);
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/getLocation.php",
        dataType: "json",
        data: {
            username: inusername
        },
        success: function(data) {
            console.log(data);
            L.mapquest.directions().route({
                start: [data[2], data[3]],
                end: [data[0], data[1]]
            });
        }
    });
}

function assignAgent(serial) {
    var id = 'delivery' + serial;
    var delivery = document.getElementById(id).value;
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/addAgent.php",
        data: {
            serial: serial,
            delivery: delivery
        },
        success: function() {
            showAcceptedRequests();
        }
    });
}