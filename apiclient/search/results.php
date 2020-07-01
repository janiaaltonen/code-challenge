<?php
$params = $_SERVER['QUERY_STRING'];
$content = "<div id='container'></div>";
include('../base.php');
?>


<!-- ugly way to get JWT from server and store it in webstorage. Security issue etc. but now no time to get it work better -->

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
            url: "../search/auth.php",
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
            url: "../search/auth_refresh.php",
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
        let base64Url = token.split('.')[1];
        let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        let parsedPayload = JSON.parse(jsonPayload);

        return Date.now() < parsedPayload['exp'] * 1000;
    }
    function getContent(token){
        let url = "../search/getData.php?";
        let header = "Bearer " + token;
        $.ajax({
            type: "GET",
            url: "../search/getData.php?<?php echo $params; ?>",
            headers: {"Authorization": header },
            dataType: 'json',
            success: function (data) {
                let response = data;
                let arr = response.split("\n");
                for (let i in arr){
                    console.log(arr[i]);
                    let a = $("<p></p>").text(arr[i]);
                    $('#container').append(a);
                }
            }
        });
    }
</script>