<?php
    $api = "api_key=265bd1ff6c464f1f8b91aa80ddc7a174";
    $stationCode = "G03";
    if( isset($_GET['station']) ) {
        $stationCode = $_GET["station"];
    }  
    $trainRequest = "https://api.wmata.com/StationPrediction.svc/json/GetPrediction/$stationCode?";
    $stationRequest = "https://api.wmata.com/Rail.svc/json/jStations?";

    $url = $trainRequest . $api;
    $response = file_get_contents($url);
    $trains = json_decode($response)->Trains;

    $url = $stationRequest . $api;
    $response = file_get_contents($url);
    $stations = json_decode($response)->Stations;

    $page = "next.php?station=$stationCode"; 
    $sec = "60";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <title>Next Train</title>
    <link rel="stylesheet" href="css/reset.min.css">
    <link rel="stylesheet" href="css/next.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt|Roboto" rel="stylesheet">
    <link rel="shortcut icon" href="static/favicon.png" type="image/png" />

</head>

<body>
    <nav>
        <div class="title"><a href="index.php">Metrorail</a></div class="title">
        <div class="item">
            <a href="station.php">Station</a>
            <a href="next.php">Next Train</a>
            <a href="incidents.php">Incidents</a>
        </div>
    </nav>

    <section class="form">
        <h1>Search Station</h1>
        <form action="next.php" method="GET">
            <select name="station">
                <?php
                    foreach (range('A', 'Z') as $char) {
                        foreach ($stations as $station) {
                            if ($char === $station->Name[0]) {
                                echo "<option value=\"$station->Code\">$station->Name</option>";
                            }
                        }
                    }
                ?>
            </select>
            <input type="submit" value="Show Result">
        </form>
    </section>

    <section class="data">
        <h1><?php echo $trains[0]->LocationName; ?></h1>
        <table class="rwd-table">
            <tr>
                <th>Line</th>
                <th>Cars</th>
                <th>Destination</th>
                <th>Minutes</th>
            </tr>
            <?php
                foreach ($trains as $train) {
                    echo "<tr>";
                        echo "<td data-th=\"Line\" class=\"cl-$train->Line\">$train->Line</td>";
                        echo "<td data-th=\"Cars\">$train->Car</td>";
                        echo "<td data-th=\"Destination\">$train->DestinationName</td>";
                        echo "<td data-th=\"Minutes\">$train->Min</td>";
                    echo "</tr>";
                }
            ?>
            
        </table>
        <p>ARR (arriving), BRD (boarding)</p>

    </section>

    <footer>
        <p>&copy; 2018 Metrorail - <a target="blank" href="https://www.wmata.com/">Washington Metropolitan Area Transit Authority</a></p>
    </footer>
</body>

</html>