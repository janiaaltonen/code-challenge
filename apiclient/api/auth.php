<?php
    // demonstrates login page to exchange credentials to JWT

    include_once '../api/client/curl.php';


    $credentials = "username=jani&password=jani";
    $endpoint = "api/token";

    $curl = new Curl();

    echo $curl->getJWT($endpoint, $credentials);
