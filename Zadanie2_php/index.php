<?php

$conn = mysqli_connect("localhost", "root", "", "computersoft");


if (!$conn) {
    echo "Unable to connect to DB: " . mysqli_error();
    exit;
}
$query_names = mysqli_query($conn, "SELECT name FROM currency_php");
$query_values = mysqli_query($conn, "SELECT exchange_rate FROM currency_php");


$db_onlyNames = mysqli_fetch_all($query_names);
$db_onlyValue = mysqli_fetch_all($query_values);

$url = 'http://api.nbp.pl/api/exchangerates/tables/A';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response = json_decode($response_json, true);


$db_newArrayNameDB = [];
foreach ($db_onlyNames as $whatever) {
    $db_newArrayNameDB[] = $whatever[0];
}


foreach ($response[0]['rates'] as $currency) {
    $currencyQ=$currency['currency'];
    $valueQ = $currency['mid'];
    $codeQ = $currency['code'];

    if (in_array($currency['currency'], $db_newArrayNameDB)) {

        mysqli_query($conn, "UPDATE currency_php SET exchange_rate='$valueQ' WHERE name='$currencyQ'");
    } else {
        mysqli_query($conn, "INSERT INTO currency_php (id,name,currency_code,exchange_rate) VALUES (NULL, '$currencyQ','$codeQ', '$valueQ')");

    }

}



?>