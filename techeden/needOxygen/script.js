function requestOxygen() {
    var name = document.forms["requestform"]["name"].value;
    var address = document.forms["requestform"]["address"].value;
    var phone = document.forms["requestform"]["phone"].value;
    var volume = document.forms["requestform"]["volume"].value;
    var date = document.forms["requestform"]["date"].value;
    if (name == "" || address == "" || phone == "" || volume == "" || date == "") {
        document.getElementById("requestFormStatus").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">All fields are required<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    } else if (volume <= 0) {
        document.getElementById("requestFormStatus").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Enter a valid amount of oxygen<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        $.ajax({
            type: "POST",
            url: "http://localhost/techeden/php/addOxygenRequest.php",
            data: {
                name: name,
                address: address,
                phone: phone,
                volume: volume,
                date: date
            },
            success: function() {
                showSentRequests();
            }
        });
    }
    return false;
}

function showSentRequests() {
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/showSentRequests.php",
        data: {},
        success: function(html) {
            $("#sentRequestList").html(html).show();
        }
    });
    console.log("show");
}
showSentRequests();

function showAcceptedRequests() {
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/showAcceptedRequests.php",
        data: {},
        success: function(html) {
            $("#acceptedRequestList").html(html).show();
        }
    });
    console.log("show");
}
showAcceptedRequests();