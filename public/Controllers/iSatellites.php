<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.03.17
 * Time: 6:47
 *
 * Description: for getting current place we should make three things:
 * 1). get type of satellite - now it's just only one, ISS. But what if API will extended?
 * 2). We have to got coordinates where satellite is flying now
 * 3). Get info that convenient for user
 */

interface iSatellites
{
    public function getSatelliteId();
    public function getCoordinates();
    public function getPlace();

}