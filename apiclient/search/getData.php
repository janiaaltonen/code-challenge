<?php
include_once "../api/curl.php";
include_once "../api/movie.php";
include_once "../api/book.php";

$params = $_SERVER['QUERY_STRING'];
parse_str($params, $paramsArr);
$type = $paramsArr['submit'];
$query = '';
$content = '';

$token = '';
foreach (getallheaders() as $name => $value) {
    if($name == 'deflate Authorization'){
        $token = $value;
    }
}

$curl = new Curl();
$object = '';

if($type == 'movie'){
    unset($paramsArr['submit']);
    $query = 'getMovie?';
    $query .= formatQuery($paramsArr);
    $movie = new Movie(json_decode($curl->getRequest($query, $token)));
    $object = $movie->getMovie();
} else{
    unset($paramsArr['submit']);
    $query = 'getBook?';
    $query .= formatQuery($paramsArr);
    $book = new Book(json_decode($curl->getRequest($query, $token)));
    $object = $book->getBook();
}

function formatQuery($paramsArr){
    $queryParams = '';
    foreach ($paramsArr as $key => $value) {
        if ($value == end($paramsArr)) {
            $queryParams .= $key . "=" . urlencode($value);
        } else {
            $queryParams .= $key . "=" . urlencode($value) . "&";
        }
    }
    return $queryParams;
}

echo json_encode($object);