<?php

use App\Controllers\ShipmentInfoController;
use App\Models\CacheModel;

require "bootstrap/bootstrap.php";

if ($_SERVER['REQUEST_METHOD'] ==='POST') {
    header("Content-Type:application/json");
    $cache = new CacheModel();
    $shipmentInfo = new ShipmentInfoController($cache);
    $postData = json_decode(file_get_contents('php://input'), true);

    echo $shipmentInfo->getShippingRates($postData);
}

