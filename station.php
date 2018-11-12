<?php
    $api = "api_key=265bd1ff6c464f1f8b91aa80ddc7a174";
    $stationRequest = "https://api.wmata.com/Rail.svc/json/jStations?";
    $lineRequest = "https://api.wmata.com/Rail.svc/json/jLines?";

    $url = $stationRequest . $api;
    $response = file_get_contents($url);
    $stations = json_decode($response)->Stations;

    $url = $lineRequest . $api;
    $response = file_get_contents($url);
    $lines = json_decode($response)->Lines;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Station</title>
    <link rel="stylesheet" href="css/reset.min.css">
    <link rel="stylesheet" href="css/station.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt|Roboto" rel="stylesheet">
    <link rel="shortcut icon" href="static/favicon.png" type="image/png" />

    <script src="station.js"></script>
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
    <section class="map">
        <h1>Map Overview</h1><br>
        <ul>
            <li><button id="al" onclick="al()">All Lines</button></li>
            <li><button id="rd" onclick="rd()">Red Lines</button></li>
            <li><button id="or" onclick="or()">Orange Lines</button></li>
            <li><button id="bl" onclick="bl()">Blue Lines</button></li>
            <li><button id="gr" onclick="gr()">Green Lines</button></li>
            <li><button id="yl" onclick="yl()">Yellow Lines</button></li>
            <li><button id="sv" onclick="sv()">Silver Lines</button></li>
        </ul>
        <?php
            foreach ($stations as $station) {
                echo "<div id=\"$station->Code\" class=\"card station\">";
                    echo "<div class=\"content bg-$station->LineCode1\">";
                        echo "<div class=\"line-code\">";
                            echo "<p class=\"code cl-$station->LineCode1\" >$station->Code</p>";
                        echo "</div>";
                        echo "<article class=\"info\">";
                            echo "<h2 class=\"cl-w\">$station->Name</h2>";
                            echo "<p class=\"cl-w\">Line(s): $station->LineCode1 $station->LineCode2 $station->LineCode3 $station->LineCode4</p>";
                        echo "</article>";
                    echo "</div>";
                echo "</div>";
            }
        ?>

            <svg version="1.1" id="Metro_Map_Lines" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" viewBox="0 0 208.5 204.5" style="enable-background:new 0 0 208.5 204.5;" xml:space="preserve">
                <g>
                    <title>metro-map-svg</title>
                    <path id="green-line" class="gr" d="M179.3,159.1l-14.6-14.6c-0.6-0.9-2.6-0.7-3.6-0.5l-3.8,2c-1,0.2-2.2-0.1-2.9-0.9l-7.4-8.2
            c-0.9-1-2.4-1.7-3.7-1.7H130c-2.2,0-4-1.8-4-4l0.5-54c0-2.5-2-4.5-4.4-4.5l0,0h-3c-2.1,0-3.7-1.7-3.7-3.7v-1.8
            c0-2.1,1.7-3.7,3.7-3.7h6.2c3,0,5.7-1.8,6.8-4.4l1.4-3.4c0.2-0.3,0.5-0.6,0.7-0.9l20.8-20.8" />
                    <path id="yellow-line" class="yl" d="M106.4,195.5v-32.4c0-2.9-3.7-6.7-7.7-6.7c0,0-4.4,0.4-4.4-2.6V140c0-2,10.2-10.2,10.2-10.2
            c1.2-1.2,3.8-0.9,5.6-0.9h9.3c2.8,0,2.8-1,2.8-5.6V81.7c0-3.1,0.6-5.2-2.5-5.3h-1.5c-3.5,0-6.3-2.8-6.3-6.3v-3.5
            c0-3.6,2.9-6.5,6.5-6.5c3.1,0,6.3,0,6.4,0c0.6,0,1.2-0.1,1.9-0.3l1.7-1.1l1.5-1.4" />
                    <path id="orange-line" class="or" d="M3.7,102.5H55c4.7,0,10.7,1.3,10.7-3.2v-5.1c0-8.4,6.9-11.1,8.8-11.1h29.6
            c2.4,0,9.3,0.9,9.3,11.1v12.1c0,2.4,0,6.5,5.6,6.5h24c1,0,2-0.3,2.7-1l6.3-5.4c0.7-0.6,1.8-1,2.8-1H169c1.1,0,2.2-0.4,3-1.2
            L196.2,80" />
                    <path id="silver-line" class="sv" d="M3.7,75.1L33.7,105c0.5,0.5,1.1,0.7,1.9,0.7H63c3.6,0,6.5-2.9,6.5-6.5v-6.8
            c0.1-1.9,2.5-5.1,5.4-5.3l28-0.3c4.1,0,6.8,3.3,6.8,7.4l0.1,14.7c0,3.8,3.7,7,7.5,7h27.6c1,0,2-0.4,2.7-1l5.9-5.2
            c0.7-0.7,1.7-1.2,2.7-1.2h48.6" />
                    <path id="blue-line" class="bl" d="M63.9,194.6v-7.9c0-3.3,2.7-6,6-6h29.9c1.7,0,3-1.3,3-3v-12.8c0-2.5-2.1-4.5-4.5-4.5l0,0h-2.7
            c-2.7,0-4.9-2.2-4.9-4.9l0,0v-19.9c0-2-0.7-3.8-2.2-5.2l-12.7-12.7c-2.1-2.1-3.3-5-3.3-7.9V94.1c0-2.1,1.7-3.7,3.7-3.7h25.8
            c1.9,0,3.3,1.4,3.3,3.3v13.7c0,6.7,5.4,12.2,12.1,12.2c0,0,0,0,0.1,0h28c1,0,2-0.3,2.7-0.9l6.5-5.2c1-0.8,2.4-1.3,3.7-1.3h46" />
                    <path id="red-line" class="rd" d="M115.3,9v29.1c0,1.4,0.5,2.9,1.5,3.9l25.7,26.4c0.4,0.5,0.8,1,1,1.7c0.2,0.6,0.3,1.2,0.3,1.9
            c-0.3,7,0.2,14,0,21c0.1,1-0.2,2-0.8,2.8c-0.5,0.5-1.1,0.8-1.9,0.9c-10.5,0-24.7-0.1-35.2,0c-7.3,0.1-6.7-3.6-6.7-3.6l-0.2-15.3
            c-0.3-1.1-1.9-2.9-2.7-3.8L84.2,61.2c-0.9-1.1-2.3-1.8-3.7-1.8h-2.2c-2.5,0-4.9-2.9-6.6-4.6L33.6,17.2" />
                    <circle onmouseover="show('B11')" onmouseout="hide('B11')" class="st6" cx="115.2" cy="11.8" r="1.3" />
                    <circle onmouseover="show('B10')" onmouseout="hide('B10')" class="st6" cx="115.2" cy="18.3" r="1.3" />
                    <circle onmouseover="show('B09')" onmouseout="hide('B09')" class="st6" cx="115.2" cy="24.8" r="1.3" />
                    <circle onmouseover="show('B08')" onmouseout="hide('B08')" class="st6" cx="115.2" cy="31.3" r="1.3" />
                    <circle onmouseover="show('B07')" onmouseout="hide('B07')" class="st6" cx="119.8" cy="45" r="1.3" />
                    <circle onmouseover="show('B05')" onmouseout="hide('B05')" class="st6" cx="143.7" cy="73.2" r="1.3" />
                    <circle onmouseover="show('B04')" onmouseout="hide('B04')" class="st6" cx="143.7" cy="79.6" r="1.3" />
                    <circle onmouseover="show('E02')" onmouseout="hide('E02')" class="st6" cx="124.2" cy="81.6" r="1.3" />
                    <circle onmouseover="show('E04')" onmouseout="hide('E04')" class="st6" cx="113.7" cy="68.1" r="1.3" />
                    <circle onmouseover="show('E05')" onmouseout="hide('E05')" class="st6" cx="120.7" cy="61.7" r="1.3" />
                    <circle onmouseover="show('E03')" onmouseout="hide('E03')" class="st6" cx="120.7" cy="74.5" r="1.3" />
                    <circle onmouseover="show('E01')" onmouseout="hide('E01')" class="st6" cx="124.2" cy="88" r="1.3" />
                    <circle onmouseover="show('B35')" onmouseout="hide('B35')" class="st6" cx="143.7" cy="86.1" r="1.3" />
                    <circle onmouseover="show('B03')" onmouseout="hide('B03')" class="st6" cx="143.7" cy="92.6" r="1.3" />
                    <circle onmouseover="show('A06')" onmouseout="hide('A06')" class="st6" cx="83.8" cy="60.8" r="1.3" />
                    <circle onmouseover="show('A05')" onmouseout="hide('A05')" class="st6" cx="88.2" cy="65.5" r="1.3" />
                    <circle onmouseover="show('A04')" onmouseout="hide('A04')" class="st6" cx="92.6" cy="70.3" r="1.3" />
                    <circle onmouseover="show('A03')" onmouseout="hide('A03')" class="st6" cx="97" cy="75" r="1.3" />
                    <circle onmouseover="show('A02')" onmouseout="hide('A02')" class="st6" cx="99.1" cy="80.3" r="1.3" />
                    <circle onmouseover="show('G05')" onmouseout="hide('G05')" class="st6" cx="201.6" cy="110.2" r="1.3" />
                    <circle onmouseover="show('G04')" onmouseout="hide('G04')" class="st6" cx="195.2" cy="110.2" r="1.3" />
                    <circle onmouseover="show('G03')" onmouseout="hide('G03')" class="st6" cx="188.7" cy="110.2" r="1.3" />
                    <circle onmouseover="show('G02')" onmouseout="hide('G02')" class="st6" cx="182.2" cy="110.2" r="1.3" />
                    <circle onmouseover="show('G01')" onmouseout="hide('G01')" class="st6" cx="176.4" cy="110.2" r="1.3" />
                    <circle onmouseover="show('B02')" onmouseout="hide('B02')" class="st6" cx="134.6" cy="96.7" r="1.3" />
                    <circle onmouseover="show('F02')" onmouseout="hide('F02')" class="st6" cx="124.2" cy="104.5" r="1.3" />
                    <circle onmouseover="show('D13')" onmouseout="hide('D13')" class="st6" cx="193.3" cy="82.7" r="1.3" />
                    <circle onmouseover="show('D12')" onmouseout="hide('D12')" class="st6" cx="188.8" cy="87.2" r="1.3" />
                    <circle onmouseover="show('D11')" onmouseout="hide('D11')" class="st6" cx="184.1" cy="91.9" r="1.3" />
                    <circle onmouseover="show('D10')" onmouseout="hide('D10')" class="st6" cx="179.6" cy="96.4" r="1.3" />
                    <circle onmouseover="show('D09')" onmouseout="hide('D09')" class="st6" cx="174.7" cy="101.3" r="1.3" />
                    <circle onmouseover="show('N01')" onmouseout="hide('N01')" class="st6" cx="25.6" cy="96.8" r="1.3" />
                    <circle onmouseover="show('N02')" onmouseout="hide('N02')" class="st6" cx="20.9" cy="92.2" r="1.3" />
                    <circle onmouseover="show('N03')" onmouseout="hide('N03')" class="st6" cx="16.4" cy="87.6" r="1.3" />
                    <circle onmouseover="show('K06')" onmouseout="hide('K06')" class="st6" cx="19.8" cy="102.5" r="1.3" />
                    <circle onmouseover="show('K07')" onmouseout="hide('K07')" class="st6" cx="13.4" cy="102.5" r="1.3" />
                    <circle onmouseover="show('K08')" onmouseout="hide('K08')" class="st6" cx="6.9" cy="102.5" r="1.3" />
                    <circle onmouseover="show('C03')" onmouseout="hide('C03')" class="st6" cx="92" cy="87" r="1.3" />
                    <circle onmouseover="show('C02')" onmouseout="hide('C02')" class="st6" cx="104.4" cy="87" r="1.3" />
                    <circle onmouseover="show('C04')" onmouseout="hide('C04')" class="st6" cx="85.6" cy="87" r="1.3" />
                    <circle onmouseover="show('A07')" onmouseout="hide('A07')" class="st6" cx="77.8" cy="59.4" r="1.3" />
                    <circle onmouseover="show('D05')" onmouseout="hide('D05')" class="st6" cx="140" cy="115.9" r="1.3" />
                    <circle onmouseover="show('D04')" onmouseout="hide('D04')" class="st6" cx="133.6" cy="115.9" r="1.3" />
                    <circle onmouseover="show('D07')" onmouseout="hide('D07')" class="st6" cx="151.9" cy="110.4" r="1.3" />
                    <circle onmouseover="show('D06')" onmouseout="hide('D06')" class="st6" cx="147.4" cy="114.9" r="1.3" />
                    <circle onmouseover="show('D02')" onmouseout="hide('D02')" class="st6" cx="110.8" cy="112.6" r="1.3" />
                    <circle onmouseover="show('D01')" onmouseout="hide('D01')" class="st6" cx="109.8" cy="106.2" r="1.3" />
                    <circle onmouseover="show('K03')" onmouseout="hide('K03')" class="st6" cx="48.4" cy="103.8" r="1.3" />
                    <circle onmouseover="show('K04')" onmouseout="hide('K04')" class="st6" cx="42.5" cy="103.8" r="1.3" />
                    <circle onmouseover="show('K01')" onmouseout="hide('K01')" class="st6" cx="60.1" cy="103.8" r="1.3" />
                    <circle onmouseover="show('K02')" onmouseout="hide('K02')" class="st6" cx="54.2" cy="103.8" r="1.3" />
                    <circle onmouseover="show('F11')" onmouseout="hide('F11')" class="st6" cx="176.1" cy="156" r="1.3" />
                    <circle onmouseover="show('F10')" onmouseout="hide('F10')" class="st6" cx="171.5" cy="151.3" r="1.3" />
                    <circle onmouseover="show('F09')" onmouseout="hide('F09')" class="st6" cx="166.9" cy="146.8" r="1.3" />
                    <circle onmouseover="show('F05')" onmouseout="hide('F05')" class="st6" cx="138.8" cy="135.2" r="1.3" />
                    <circle onmouseover="show('F04')" onmouseout="hide('F04')" class="st6" cx="133.1" cy="135.2" r="1.3" />
                    <circle onmouseover="show('F07')" onmouseout="hide('F07')" class="st6" cx="152.8" cy="143" r="1.3" />
                    <circle onmouseover="show('F08')" onmouseout="hide('F08')" class="st6" cx="158.9" cy="145.2" r="1.3" />
                    <circle onmouseover="show('F06')" onmouseout="hide('F06')" class="st6" cx="148.7" cy="138.9" r="1.3" />
                    <circle onmouseover="show('C15')" onmouseout="hide('C15')" class="st6" cx="106.4" cy="192.3" r="1.3" />
                    <circle onmouseover="show('J03')" onmouseout="hide('J03')" class="st6" cx="63.9" cy="191.4" r="1.3" />
                    <circle onmouseover="show('J02')" onmouseout="hide('J02')" class="st6" cx="76.5" cy="180.7" r="1.3" />
                    <circle onmouseover="show('C14')" onmouseout="hide('C14')" class="st6" cx="106.4" cy="185.8" r="1.3" />
                    <circle onmouseover="show('C12')" onmouseout="hide('C12')" class="st6" cx="104.4" cy="170.8" r="1.3" />
                    <circle onmouseover="show('C10')" onmouseout="hide('C10')" class="st6" cx="104.4" cy="164.4" r="1.3" />
                    <circle onmouseover="show('C08')" onmouseout="hide('C08')" class="st6" cx="92.5" cy="150.2" r="1.3" />
                    <circle onmouseover="show('C06')" onmouseout="hide('C06')" class="st6" cx="82.3" cy="124.1" r="1.3" />
                    <circle onmouseover="show('C09')" onmouseout="hide('C09')" class="st6" cx="96.8" cy="158.1" r="1.3" />
                    <circle onmouseover="show('N04')" onmouseout="hide('N04')" class="st6" cx="11.7" cy="83" r="1.3" />
                    <circle onmouseover="show('N06')" onmouseout="hide('N06')" class="st6" cx="6.9" cy="78.2" r="1.3" />
                    <circle onmouseover="show('E10')" onmouseout="hide('E10')" class="st6" cx="152.2" cy="36.8" r="1.3" />
                    <circle onmouseover="show('E09')" onmouseout="hide('E09')" class="st6" cx="147.7" cy="41.4" r="1.3" />
                    <circle onmouseover="show('E08')" onmouseout="hide('E08')" class="st6" cx="143" cy="45.9" r="1.3" />
                    <g onmouseover="show('B06')" onmouseout="hide('B06')">
                        <circle class="st6" cx="131.9" cy="57" r="3.2" />
                        <circle class="st6" cx="131.9" cy="57" r="1.3" />
                    </g>
                    <g onmouseover="show('B01')" onmouseout="hide('B01')">
                        <circle class="st6" cx="124.2" cy="96.9" r="3.2" />
                        <circle class="st6" cx="124.2" cy="96.9" r="1.3" />
                    </g>
                    <g onmouseover="show('D03')" onmouseout="hide('D03')">
                        <circle class="st6" cx="124.2" cy="115.9" r="3.2" />
                        <circle class="st6" cx="124.2" cy="115.9" r="1.3" />
                    </g>
                    <g onmouseover="show('D08')" onmouseout="hide('D08')">
                        <circle class="st6" cx="160.4" cy="108.4" r="3.2" />
                        <circle class="st6" cx="160.4" cy="108.4" r="1.3" />
                    </g>
                    <g onmouseover="show('A01')" onmouseout="hide('A01')">
                        <circle class="st6" cx="109.4" cy="96.9" r="3.2" />
                        <circle class="st6" cx="109.4" cy="96.9" r="1.3" />
                    </g>
                    <g onmouseover="show('C07')" onmouseout="hide('C07')">
                        <circle class="st6" cx="92.5" cy="141.7" r="3.2" />
                        <circle class="st6" cx="92.5" cy="141.7" r="1.3" />
                    </g>
                    <g onmouseover="show('C13')" onmouseout="hide('C13')">
                        <circle class="st6" cx="104.4" cy="178.3" r="3.2" />
                        <circle class="st6" cx="104.4" cy="178.3" r="1.3" />
                    </g>
                    <g onmouseover="show('K05')" onmouseout="hide('K05')">
                        <circle class="st6" cx="33.6" cy="103.8" r="3.2" />
                        <circle class="st6" cx="33.6" cy="103.8" r="1.3" />
                    </g>
                    <g onmouseover="show('C05')" onmouseout="hide('C05')">
                        <circle class="st6" cx="69.5" cy="96.9" r="3.2" />
                        <circle class="st6" cx="69.5" cy="96.9" r="1.3" />
                    </g>
                    <circle onmouseover="show('E07')" onmouseout="hide('E07')" class="st6" cx="138.5" cy="50.5" r="1.3" />
                    <circle onmouseover="show('A15')" onmouseout="hide('A15')" class="st6" cx="36.7" cy="20.4" r="1.3" />
                    <circle onmouseover="show('A14')" onmouseout="hide('A14')" class="st6" cx="41.9" cy="25.4" r="1.3" />
                    <circle onmouseover="show('A13')" onmouseout="hide('A13')" class="st6" cx="47.1" cy="30.6" r="1.3" />
                    <circle onmouseover="show('A12')" onmouseout="hide('A12')" class="st6" cx="52.1" cy="35.7" r="1.3" />
                    <circle onmouseover="show('A11')" onmouseout="hide('A11')" class="st6" cx="57.3" cy="40.8" r="1.3" />
                    <circle onmouseover="show('A10')" onmouseout="hide('A10')" class="st6" cx="62.4" cy="45.9" r="1.3" />
                    <circle onmouseover="show('A09')" onmouseout="hide('A09')" class="st6" cx="67.5" cy="51.1" r="1.3" />
                    <circle onmouseover="show('A08')" onmouseout="hide('A08')" class="st6" cx="72.6" cy="56.2" r="1.3" />
                </g>
            </svg>
    
    </section>

    <section class="lines">
        <h1>Lines Info</h1>

        <div class="cards">
            <?php
                foreach ($lines as $line) {
                    foreach ($stations as $station) {
                        if ($line->StartStationCode === $station->Code) {
                            $startName = $station->Name;
                        }
                        if ($line->EndStationCode === $station->Code) {
                            $endName = $station->Name;
                        }
                    }
                    echo "<div class=\"card\">";
                        echo "<div class=\"content\">";
                            echo "<div class=\"line-code\">";
                                echo "<p class=\"code bg-$line->LineCode\" >$line->LineCode</p>";
                            echo "</div>";
                            echo "<article class=\"info\">";
                                echo "<h2 class=\"cl-$line->LineCode\">$line->DisplayName Line</h2>";
                                echo "<p>Start Station: <b>$startName</b> ($line->StartStationCode)</p>";
                                echo "<p>End Station: <b>$endName</b> ($line->EndStationCode)</p>";
                            echo "</article>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>

    </section>

    <footer>
        <p>&copy; 2018 Metrorail - <a target="blank" href="https://www.wmata.com/">Washington Metropolitan Area Transit Authority</a></p>
    </footer>
</body>

</html>