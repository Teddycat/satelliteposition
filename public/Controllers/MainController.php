<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.03.17
 * Time: 5:12
 */

require_once('Models/MainModel.php');
require_once('iSatellites.php');

class Main implements iSatellites
{
    public $time;
    public $station;
    public $latitude;
    public $longitude;

    public static $urlApi = "https://api.wheretheiss.at/v1/satellites";
    public static $googleUrl = "https://maps.googleapis.com/maps/api/geocode/json?";
    private static $_key = "AIzaSyC98tlownk8W2gZLYOku7xmAMS87G3Wjek";

    public function __construct($time, $station)
    {
        $this->time = $time;
        $this->station = $station;
        $this->getCoordinates();
    }

    /**
     * Getting id by selected space station
     * @return mixed
     */
    public function getSatelliteId()
    {
        $obj = new MainModel();
        $allStations = $obj->getSatelliteId(self::$urlApi);
        foreach ($allStations as $key) {
            if ($key->name == $this->station)
                return $key->id;
        }
    }

    /**
     * Getting coordinates of satellite
     * @return mixed
     */
    public function getCoordinates()
    {
        $obj = new MainModel();
        $satelliteInfo = $obj->getSatelliteInfo(self::$urlApi, $this->getSatelliteId());
        $this->latitude = $satelliteInfo->latitude;
        $this->longitude = $satelliteInfo->longitude;

        return $satelliteInfo;
    }

    /**
     * Convert information about current place to string, convenient for user
     * @return string
     */
    public function getPlace()
    {
        $obj = new MainModel();
        $placeInfo = $obj->getSatellitePlace(self::$googleUrl, $this->latitude, $this->longitude, self::$_key);
        $text = "Currently ISS is over ";
        if (count($placeInfo->results) < 1) {
            $text .= "unknown place (probably mountain or ocean)";
        } else {
            $text .= $placeInfo->results[0]->formatted_address;
        }
        return $text;
    }
}

$satellite = new Main(time(), 'iss'); //setting station here. Of course, with frontend it will be something like $_POST['station']

echo $satellite->getPlace();

