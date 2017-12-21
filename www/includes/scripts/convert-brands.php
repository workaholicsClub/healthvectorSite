<?php
//конвертация производителей из строкового значения (PRODUCER) в привязку к инфоблоку (BRAND)
include_once($_SERVER["DOCUMENT_ROOT"]."/includes/tools.php");
global $DB;
Tools::IncludeModule('iblock');
set_time_limit(0);

//begin

echo '<pre>';
//ConvertBrands();

//end
echo "\nDone";


function ConvertBrands() {
    global $DB;

    $brandsList = array();
    $res = CIBlockElement::GetList(array(), array('IBLOCK_ID' => Config::IBLOCK_CATALOG_BRANDS), false, false, array('ID', 'NAME'));
    while ($brand = $res->Fetch()) {
        $name = MinimizeName($brand['NAME']);
        $brandsList[$name] = $brand['ID'];
    }

    //ручная установка бренда т.к. не все названия совпадают
    $brandsReplaces = array(
        'ieitechnology' => $brandsList['ieitechnologycorp.'],
        'сегнетикс' => $brandsList['segnetics'],
    );
    $brandsList += $brandsReplaces;
    echo '<pre>'; print_r( $brandsList ); echo '</pre>';

    $res = CIBlockElement::GetList(array(), array('IBLOCK_ID' => Config::IBLOCK_CATALOG), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_PRODUCER', 'PROPERTY_BRAND'));
    while ($item = $res->Fetch()) {
        $brandName = MinimizeName($item['PROPERTY_PRODUCER_VALUE']);
        if (empty($brandName)) {
            continue;
        }
        if (!isset($brandsList[$brandName])) {
            echo 'Brand "'.($item['PROPERTY_PRODUCER_VALUE']).'" not found at item '.($item['ID'])."\n";
        } else if ($item['PROPERTY_BRAND_VALUE'] && isset($brandsList[$brandName])) {
            if ($item['PROPERTY_BRAND_VALUE'] != $brandsList[$brandName]) {
                echo 'Brand ID mismatch'."\n";
            }
        } else if (!isset($brandsList[$brandName])){
            echo 'Brand "'.($item['PROPERTY_PRODUCER_VALUE']).'" not found'."\n";
        } else {
            $fieldsUpdate = array(
                'BRAND' => $brandsList[$brandName],
            );
            CIBlockElement::SetPropertyValuesEx($item['ID'], $item['IBLOCK_ID'], $fieldsUpdate);
        }
    }
}//ConvertBrands

function MinimizeName($name) {
    return preg_replace('/\s+/', '', mb_strtolower($name, 'UTF-8'));
}//MinimizeName
