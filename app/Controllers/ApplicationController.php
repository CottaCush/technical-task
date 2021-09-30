<?php

namespace App\Controllers;

class ApplicationController
{
    public function run(): void
    {
        $results = null;
        if (!empty($_POST)) {
            // TODO: Implement requirements and display converted rate
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