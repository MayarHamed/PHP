<?php

require_once("config.php");

$selected_city = isset($_POST['city']) ? $_POST['city'] : "";
$selected_city = str_replace("-", " ", $selected_city);
//echo $selected_city;
$cid = "";
Foreach ($cities as $city) {
    if ($city["name"] == $selected_city) {
        $cid = $city["id"];
//         echo $cid;
    }
}
$url = 'https://api.openweathermap.org/data/2.5/weather?id=' . $cid . '&appid=e1c82fb2551e3c51835f64c431cbbe85';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$response = curl_exec($ch);
$data = json_decode($response, true);
$curr_date = date("d-m-y h:i:s");
curl_close($ch);

echo "<h3>" . $data["name"] . " weather status" . "</h3>" .
 $curr_date . '</br>' .
 '<img src="https://openweathermap.org/img/wn/' . $data["weather"][0]["icon"] . '@2x.png"></img>' . '</br>' .
 'Weather: ' . $data["weather"][0]["description"] . '</br>' .
 'Temperature: ' . $data["main"]["temp"] ." °F". '</br>' .
 'Humidity: ' . $data["main"]["humidity"] ."%". '</br>' .
 'Wind: ' . $data["wind"]["speed"]." km/hr";


require_once("weather.php");


//
//{
//"coord": {
//"lon": -77.0469,
// "lat": 38.8048
//},
// "weather": [
//{
//"id": 803,
// "main": "Clouds",
// "description": "broken clouds",
// "icon": "04d"
//}
//],
// "base": "stations",
// "main": {
//"temp": 281.41,
// "feels_like": 277.36,
// "temp_min": 279.79,
// "temp_max": 282.71,
// "pressure": 1011,
// "humidity": 51
//},
// "visibility": 10000,
// "wind": {
//"speed": 8.75,
// "deg": 310,
// "gust": 12.35
//},
// "clouds": {
//"all": 75
//},
// "dt": 1678560090,
// "sys": {
//"type": 2,
// "id": 2074226,
// "country": "US",
// "sunrise": 1678533970,
// "sunset": 1678576233
//},
// "timezone": -18000,
// "id": 4744106,
// "name": "Alexandria",
// "cod": 200
//}