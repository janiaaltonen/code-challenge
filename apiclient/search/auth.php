/*
* serves as login page to exchange credentials to JWT
*/

<?php
    include_once '../api/curl.php';


    $credentials = "username=jani&password=jani";
    $endpoint = "api/token";

    $curl = new Curl();

    echo $curl->getJWT($endpoint, $credentials);
