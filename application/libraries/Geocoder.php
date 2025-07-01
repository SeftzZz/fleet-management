<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Geocoder {

    private $api_key;

    public function __construct() {
        $this->api_key = 'AIzaSyAtvWRcixgcR1p_WkZLP-KF57_uVIwk90';
    }

    public function getCoordinates($address) {
        $address = urlencode($address);
        $url = "https://maps.google.com/maps/api/geocode/json?address={$address}&key={$this->api_key}";

        $response = file_get_contents($url);

        if ($response === FALSE) {
            return FALSE;
        }

        $data = json_decode($response, TRUE);

        if ($data['status'] == 'OK') {
            return $data['results'][0]['geometry']['location'];
        } else {
            return FALSE;
        }
    }
}
