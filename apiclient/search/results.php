<?php
$params = $_SERVER['QUERY_STRING'];
$content = "<div>
                <div>
                    <p><a href='/apiclient/search/'> Go back to search </a></p>
                </div>
                <div id='container'>
                </div>
            </div>";
include('../base.php');
?>


<!-- ugly way to get JWT from server and store it in webStorage/localStorage.
Security issue etc. but now no time to get it work more suitable and secure way.
Django rest-framework's simple-jwt support for httponly cookie not found out..-->

<script>
    $(document).ready(function() {
        if (localStorage.getItem("access") === null && localStorage.getItem("refresh") === null) {
            getToken();
        } else if (localStorage.getItem("access") !== null){
            let token = localStorage.getItem("access");
            if (isValid(token)){
                getContent(token);
            } else if (localStorage.getItem("refresh") !== null){
                token = localStorage.getItem("refresh");
                if(isValid(token)){
                    refreshToken(token);
                }
            } else {
                getToken();
            }
        }
    });
    function getToken(){
        $.ajax({
            type: "GET",
            url: "../api/auth.php",
            dataType: 'json',
            success: function (data) {
                for (let key in data) {
                    localStorage.setItem(key, data[key]);
                }
                getContent(localStorage.getItem("access"));
            }
        });
    }
    function refreshToken(token) {
        $.ajax({
            type: "POST",
            url: "../api/auth_refresh.php",
            dataType: 'json',
            data: {
                refresh: token
            },
            success: function (data) {
                for (let key in data){
                    localStorage.setItem(key, data[key]);
                }
                getContent(localStorage.getItem("access"));
            }
        });
    }
    function isValid(token){
        try {
            let base64Url = token.split('.')[1];
            let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            let jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
            let parsedPayload = JSON.parse(jsonPayload);

            return Date.now() < parsedPayload['exp'] * 1000;
        } catch (e) {
            if(e instanceof TypeError) {
                getToken();
            } else {
                console.log(e);
            }
        }
    }
    function getContent(token){
        let header = "Bearer " + token;
        $.ajax({
            type: "GET",
            url: "../api/get_data.php?<?php echo $params; ?>",
            headers: {"Authorization": header },
            dataType: 'json',
            success: function (data) {
                let arr = data.split("\n");
                for (let i in arr){
                    let content = $("<p></p>").text(arr[i]);
                    $('#container').append(content);
                }
            }
        });
    }
</script>