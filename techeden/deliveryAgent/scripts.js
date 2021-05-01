showDeliveryTasks();
console.log("hi")

function showDeliveryTasks() {
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/showDeliverytasks.php",
        success: function(html) {
            $("#deliveryTasksList").html(html).show();
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

function markasDelivered(sl) {
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/markasDelivered.php",
        data: {
            sl: sl
        },
        success: function() {
            showDeliveryTasks();
        }
    });
}