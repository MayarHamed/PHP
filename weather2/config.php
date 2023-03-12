<?php

$cities = file_get_contents("city.list.json");
$cities = json_decode($cities, true);