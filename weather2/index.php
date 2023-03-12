<?php

require_once("config.php");
require_once("vendor/autoload.php");
use GuzzleHttp\Client;

$client = new Client();
$selected_city = isset($_POST['city']) ? $_POST['city'] : "";
$selected_city = str_replace("-", " ", $selected_city);
$cid = "";

Foreach ($cities as $city) {
    if ($city["name"] == $selected_city) {
        $cid = $city["id"];
    }
}

$url = 'https://api.openweathermap.org/data/2.5/weather?id=' . $cid . '&appid=e1c82fb2551e3c51835f64c431cbbe85';
$response = $client->get($url);
$data = json_decode($response->getBody(), true);
$curr_date = date("d-m-y h:i:s");

echo "<h3>" . $data["name"] . " weather status" . "</h3>" .
 $curr_date . '</br>' .
 '<img src="https://openweathermap.org/img/wn/' . $data["weather"][0]["icon"] . '@2x.png"></img>' . '</br>' .
 'Weather: ' . $data["weather"][0]["description"] . '</br>' .
 'Temperature: ' . $data["main"]["temp"] . " °F" . '</br>' .
 'Humidity: ' . $data["main"]["humidity"] . "%" . '</br>' .
 'Wind: ' . $data["wind"]["speed"] . " km/hr";


require_once("weather.php");
