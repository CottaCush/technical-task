<?php

namespace App\Controllers;

use App\Models\CacheModel;

class ApplicationController
{
    public function run(): void
    {
        $results = null;
        if (!empty($_POST)) {
            // TODO: Implement requirements and display shipping rates
            $cache = new CacheModel();
            $shipmentInfo = new ShipmentInfoController($cache);
            $postData = $_POST;

            $results = $shipmentInfo->getShippingRates($postData);
        }

        echo $this->renderView('views/forms.php', ['results' => $results]);
    }

    public function renderView(string $filePath, array $variables = []): string
    {
        ob_start();
        extract($variables, EXTR_OVERWRITE);
        include($filePath);

        return ob_get_clean();
    }
}