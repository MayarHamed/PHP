<?php
require_once("config.php");
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Weather Forecast</title>
    </head>
    <body>
        <h1>
            Weather Forecast
        </h1>
        <form method="post" action="index.php">
            <label for="city">Choose a city:</label>
            <select name="city">
                <?php
                Foreach ($cities as $city) {
                    if ($city["country"] == "EG") {
                        $city["name"] = str_replace(" ", "-", $city["name"]);
                        echo ' <option value=' . $city["name"] . '>' . $city["name"] . '</option>';
                    }
                }
                ?>
            </select>
            <br><br>
            <input type="submit" value="Get weather">
        </form>
    </body>
</html>