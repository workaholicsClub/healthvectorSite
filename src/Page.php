<?php

namespace HealthVector;

use CMain;

class Page
{
    private $bitrixApp;

    public function __construct(CMain $app) {
        $this->bitrixApp = $app;
    }

    private function getPageTitle() {
        $defaultTitle = $this->bitrixApp->GetTitle();
        $h1PagePropertyTitle = $this->bitrixApp->GetPageProperty('h1');
        $h2PagePropertyTitle = $this->bitrixApp->GetPageProperty('h2');

        if (!$defaultTitle) {
            return $h2PagePropertyTitle
                ? $h2PagePropertyTitle
                : $h1PagePropertyTitle;
        }

        return $defaultTitle;
    }

    public function showBufferedPageTitle() {
        $this->bitrixApp->AddBufferContent(function () {
            return $this->getPageTitle();
        });
    }
}