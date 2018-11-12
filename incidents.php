<?php
    $page = $_SERVER['PHP_SELF'];
    $sec = "60";

    $api = "api_key=265bd1ff6c464f1f8b91aa80ddc7a174";
    if( isset($_GET['station']) ) {
        $stationCode = $_GET["station"];
    }  
    $incidentRequest = "https://api.wmata.com/Incidents.svc/json/Incidents?";

    $url = $incidentRequest . $api;
    $response = file_get_contents($url);
    $incidents = json_decode($response)->Incidents;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <title>Incidents</title>
    <link rel="stylesheet" href="css/reset.min.css">
    <link rel="stylesheet" href="css/incidents.css">
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

    <section class="incidents">
        <h1>Rail Incidents</h1>
        <?php
                foreach ($incidents as $incident) {
                    $code = substr($incident->LinesAffected, 0, 2);
                    echo "<div class=\"card\">";
                        echo "<div class=\"content\">";
                            echo "<div class=\"line-code\">";
                                echo "<p class=\"code bg-$code\">$code</p>";
                            echo "</div>";
                            echo "<article class=\"info\">";
                                echo "<h2 class=\"cl-$code\">$incident->IncidentType Line</h2>";
                                echo "<p>$incident->Description</p>";
                                echo "<p>$incident->DateUpdated</p>";
                            echo "</article>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
    </section>

    <footer>
        <p>&copy; 2018 Metrorail - <a target="blank" href="https://www.wmata.com/">Washington Metropolitan Area Transit Authority</a></p>
    </footer>

</body>

</html>