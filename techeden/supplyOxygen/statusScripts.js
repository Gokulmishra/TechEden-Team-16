showStatus();

function showStatus() {
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/showStatus.php",
        success: function(html) {
            $('#packageStatusList').html(html).show();
        }
    });
}