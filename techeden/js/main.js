function login() {
    var username = document.forms['loginform']['username'].value;
    var password = document.forms['loginform']['password'].value;
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/php/login_validation.php",
        data: {
            username: username,
            password: password
        },
        success: function(html) {
            $("#message1").html(html).show();
        }
    });
    return false;
}

function signup() {
    var username = document.forms['signupform']['username'].value;
    var email = document.forms['signupform']['email'].value;
    var password = document.forms['signupform']['password'].value;
    var confpass = document.forms['signupform']['confpass'].value;
    var org = document.forms['signupform']['org'].value;
    var lat = document.getElementById("lat").value;
    var lng = document.getElementById("lng").value;
    var msg = '';
    var err = false;
    if (username == '' || email == '' || password == '' || confpass == '') {
        msg = "All fields are required.";
        err = true;
    } else if (password != confpass) {
        msg = "password and confirm password must be same.";
        err = true;
    } else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(signupform.email.value) == false) {
        msg = "enter a valid email address.";
        err = true;
    } else if (password.length < 8) {
        err = true;
        msg = "password must be atleast 8 characters.";
    } else if (!password.match(/[A-Z]/g)) {
        err = true;
        msg = "password must contain atleast one uppercase letter.";
    } else if (!password.match(/[0-9]/g)) {
        err = true;
        msg = "password must contain atleast one integer.";
    } else {
        $.ajax({
            type: "POST",
            url: "http://localhost/techeden/php/signup_validation.php",
            data: {
                username: username,
                email: email,
                password: password,
                org: org,
                lat: lat,
                lng: lng
            },
            success: function(html) {
                $("#message").html(html).show();
            }
        });
    }
    if (err == true) {
        console.log('error is true')
        document.getElementById('message').innerHTML = '';
        document.getElementById('message').innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        return false;
    }

    return false;
}