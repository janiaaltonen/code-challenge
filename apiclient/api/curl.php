<?php

class Curl{

    private $curl;
    private string $address = "127.0.0.1:8000/";

    function __construct(){
        $this->curl = curl_init();
    }

    function getRequest($endpoint, $token){
        curl_setopt_array($this->curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->address. $endpoint,
            CURLOPT_HTTPHEADER => array('Authorization: Bearer '. $token)
        ]);
        return curl_exec($this->curl);
    }

    function getJWT($endpoint, $credentials){
        curl_setopt_array($this->curl, [
            CURLOPT_URL => $this->address. $endpoint,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $credentials,
            CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
            CURLOPT_RETURNTRANSFER => 1
        ]);

        return curl_exec($this->curl);
    }

    function refreshJWT($endpoint, $token){
        curl_setopt_array($this->curl, [
            CURLOPT_URL => $this->address. $endpoint,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $token,
            CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
            CURLOPT_RETURNTRANSFER => 1
        ]);

        return curl_exec($this->curl);
    }

}
