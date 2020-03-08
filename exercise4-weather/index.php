<?php
$apiKey = "1032cb37d9ac17280e9ac5cae85db9d1";
$cityId = isset($_GET["cities"]) ? $_GET["cities"] : "1791247";

$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
date_default_timezone_set('PRC'); // China timezone
$currentTime = time();
?>

<!doctype html>
<html>
<head>
<title>Weather Showcase</title>
<link rel="stylesheet" href="bootstrap.css">

<style type="text/css">
body {
    font-family: Arial;
    font-size: 0.95em;
    color: #929292;
}

.report-container {
    border: #E0E0E0 1px solid;
    padding: 20px 40px 40px 40px;
    border-radius: 2px;
    width: 550px;
    margin: 0 auto;
}

.weather-icon {
    vertical-align: middle;
    margin-right: 20px;
}

.weather-forecast {
    color: #212121;
    font-size: 1.2em;
    font-weight: bold;
    margin: 20px 0px;
}

span.min-temperature {
    margin-left: 15px;
    color: #929292;
}

.time {
    line-height: 25px;
}
.cities {
    padding-top: 50px;
    width: 550px;
    margin: 0 auto;
}
</style>

</head>
<body>

    <div class="report-container mt-5">
        <h2><?php echo $data->name; ?> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img
                src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                class="weather-icon" /> <?php echo $data->main->temp_max; ?>&deg;C<span
                class="min-temperature"><?php echo $data->main->temp_min; ?>&deg;C</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
            <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
    </div>

    <div class="cities form-group">
    <form action="index.php">
        <label for="cities">Choose a city to see the weather:</label>
        <select id="cities" class="form-control" name="cities">
            <option value="1791247">Wuhan</option>
            <option value="1796236">Shanghai</option>
            <option value="1816670">Beijing</option>
            <option value="1850147">Tokyo</option>
            <option value="2643741">London</option>
            <option value="2655603">Birmingham</option>
            <option value="5128638">New York</option>
            <option value="3882428">Los Angeles</option>
            <option value="6354908">Sydney</option>
        </select>
        <!-- <input type="submit"> -->
    </div>

<script src="jquery.js"></script>
<script>
$(function(){
    // initialization
    let Request = new Object();
    Request = GetRequest();
    let cities = Request['cities'];
    $("#cities option").each(function(){
        let val = $(this).val();
        if(cities === val){
            $("#cities").val(cities);
        }
    })
    // get request parameter;
    function GetRequest() {
        var url = location.search; // get strings after "?"
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for(var i = 0; i < strs.length; i ++) {
                theRequest[strs[i].split("=")[0]]=decodeURI(strs[i].split("=")[1]);
            }
        }
        return theRequest;
    } 
        
    // event
    $("#cities").change(function(){
        $(this).children("option").each(function(){
            let target = $(this).get(0).selected;
            if(target){
                let val = $(this).val();
                let head = location.href.split("?")[0];
                location.href = head + "?cities=" + val;

            };
        })
    })





})

</script>
</body>
</html>