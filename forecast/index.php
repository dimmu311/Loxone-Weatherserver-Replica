<?php
header('Content-Type: text/plain;charset=UTF-8');
header('Connection: close');

require "../config.php";
require "../pictoCode.php";

$user = $_GET['user'];
$coord = str_getcsv($_GET['coord'], ',');
$asl = $_GET['asl'];
$format = $_GET['format'];
$newApi = $_GET['new_api'];

$apiCall = "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/$coord[1],$coord[0]?unitGroup=metric&key=$apiKey&include=hours%2Ccurrent&lang=id";

$weather = json_decode(file_get_contents($apiCall));
if($debug) error_log(print_r($weather, true));

//{{{ set the Header...
$sunrise = date('H:i', $weather->days[0]->sunriseEpoch);
$sunset = date('H:i', $weather->days[0]->sunsetEpoch);

$latitude = $weather->latitude;
$latitude = $latitude < 0 ? $latitude. 'S' : $latitude. 'N';
$longitude = $weather->longitude;
$longitude = $longitude < 0 ? $longitude. 'W' : $longitude. 'E';

$dateTime = new DateTime();
$dateTime->setTimeZone(new DateTimeZone($weather->timezone));
$timezone = $dateTime->format('T');

$utcTimedifference = floatval($weather->tzoffset);
$utcTimedifference = $latitude < 0 ? 'UTC-'.sprintf("%.1f", $utcTimedifference) : 'UTC+'.sprintf("%.1f", $utcTimedifference); //todo: check if -/+ is need to calculate or if it is automaticly done

$id = '';
$name = '';
$height = $asl;
$country = '';
//}}}
//{{{ set Content...
$forecast = array();
foreach($weather->days as $day){
	foreach($day->hours as $hour){
		$localDate = date('d.m.Y', $hour->datetimeEpoch);
		$weekday = date('D', $hour->datetimeEpoch);
		$localTime = date('H', $hour->datetimeEpoch);
		$temperature = $hour->temp!==null ? $hour->temp : 0;
		$feeledTemperature = $hour->feelslike!==null ? $hour->feelslike : 0;
		$windspeed = $hour->windspeed!==null ? $hour->windspeed : 0; //todo check unit
		$winddirection = $hour->winddir!==null ? $hour->winddir : 0;
		$windGust = $hour->windgust!==null ? $hour->windgust : 0;
		$lowClouds = 0; //todo
		$mediumClouds = 0; //todo
		$highClouds = $hour->cloudcover!==null ? $hour->cloudcover : 0; //todo
		$precipitation = $hour->precip!==null ? $hour->precip : 0;
		$probabilityOfPrecip = $hour->precipprob!==null ? $hour->precipprob : 0;
		$snowFraction = $hour->snow!==null ? $hour->snow : 0; //todo
		$seaLevelPressure = $hour->pressure!==null ? $hour->pressure : 0;
		$relativeHumidity = $hour->humidity!==null ? $hour->humidity : 0; //check if this is relative
		$cape = 0; //todo this means how much energie is in a Thunderstorm
		$pictoCode = getIconId($hour->conditions);
		$radiation = $hour->solarradiation!==null ? $hour->solarradiation : 0;
		$oneMoreValue = 0; //maybe this is particulate matter pollution. particulate matter pollution is available in config but not in the header.

		$forecast[] = $localDate. ';	'.
		$weekday. ';	'.
		$localTime. ';	'.
		$temperature. ';	'.
		$feeledTemperature. ';	'.
		$windspeed. ';	'.
		$winddirection. ';	'.
		$windGust. ';	'.
		$lowClouds. ';	'.
		$mediumClouds. ';	'.
		$highClouds. ';	'.
		$precipitation. ';	'.
		$probabilityOfPrecip. ';	'.
		$snowFraction. ';	'.
		$seaLevelPressure. ';	'.
		$relativeHumidity. ';	'.
		$cape. ';	'.
		$pictoCode. ';	'.
		$radiation. ';	'.
		$oneMoreValue. ';';
	}
}
//}}}

$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = true;

$mb_metadata = $xml->createElement('mb_metadata');
$xml->appendChild($mb_metadata);
$mb_metadata_text = PHP_EOL;
$mb_metadata_text .= 'id;name;longitude;latitude;height (m.asl.);country;timezone;utc-timedifference;sunrise;sunset;';
$mb_metadata_text .= PHP_EOL;
$mb_metadata_text .= 'local date;weekday;local time;temperature(C);feeledTemperature(C);windspeed(km/h);winddirection(degr);wind gust(km/h);low clouds(%);medium clouds(%);high clouds(%);precipitation(mm);probability of Precip(%);snowFraction;sea level pressure(hPa);relative humidity(%);CAPE;picto-code;radiation (W/m2);';
$mb_metadata_text .= PHP_EOL;
$mb_metadata_text = $xml->createTextNode($mb_metadata_text);
$mb_metadata->appendChild($mb_metadata_text);

$valid_until = $xml->createElement('valid_until');
$xml->appendChild($valid_until);
$date = new DateTime();
$date->add(new DateInterval('P10Y'));
$valid_until_text = $xml->createTextNode($date->format('Y-m-d'));
$valid_until->appendChild($valid_until_text);

$station = $xml->createElement('station');
$xml->appendChild($station);
$station_text = PHP_EOL;
$station_text .= "$id;$name;$coord[0]E;$coord[1]N;$height;$country;$timezone;$utcTimedifference;$sunrise;$sunset;";
$station_text .= PHP_EOL;
foreach($forecast as $cast){
	$station_text .= $cast;
	$station_text .= PHP_EOL;
}
$station_text = $xml->createTextNode($station_text);
$station->appendChild($station_text);

echo str_replace('<?xml version="1.0"?>'. PHP_EOL, '', $xml->saveXML());
?>