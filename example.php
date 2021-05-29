<?php
header('Content-Type: application/json');
require_once('classes/class.interparcel.php');


$tracking = new Tracking_Interparcel('__API_KEY__');

print_r($tracking->getTracking("GB1200218511"));
