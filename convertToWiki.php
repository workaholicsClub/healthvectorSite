<?php
require_once ('vendor/autoload.php');

use HealthVector\HTMLToWikiConverter;

$urlListFile = isset($argv[1]) ? $argv[1] : false;

if ($urlListFile) {
    HTMLToWikiConverter::convertUrls($urlListFile, 'wiki');
}
else {
    echo "Укажите папку-источник (например www/cns_disorder)\n";
}