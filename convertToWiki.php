<?php
require_once ('vendor/autoload.php');

use HealthVector\HTMLToWikiConverter;

$srcFolder = isset($argv[1]) ? $argv[1] : false;

if ($srcFolder) {
    HTMLToWikiConverter::convert($srcFolder, 'wiki');
}
else {
    echo "Укажите папку-источник (например www/cns_disorder)\n";
}