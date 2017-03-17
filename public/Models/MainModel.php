<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.03.17
 * Time: 4:28
 */
class MainModel
{

    public function getSatelliteId($link)
    {
        $json = file_get_contents($link);
        return json_decode($json);
    }

    public function getSatelliteInfo($link, $id)
    {
        $json = file_get_contents($link . '/' . $id);
        return json_decode($json);
    }

    public function getSatellitePlace($google, $latitude, $longitude, $key)
    {
        $json = file_get_contents($google . 'latlng=' . $latitude . ',' . $longitude . '&key=' . $key);
        return json_decode($json);
    }

}
