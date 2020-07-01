<?php
    include_once '../api/curl.php';

    $endpoint = "api/token/refresh";

    $token = $_POST["refresh"];
    $token = "refresh=". $token;

    $curl = new Curl();

    echo $curl-> refreshJWT($endpoint, $token);
