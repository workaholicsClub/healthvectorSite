<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$sCity = array(
  "reference" => array(
    'не выбрано'
  ),
  "reference_id" =>array(
    ''
  )
);
foreach($arResult['ITEMS'] as $id => $item ) {
    $item['_EDIT_AREA'] = Tools::GetIBlockElementEditLink( $item['ID'], $item['IBLOCK_ID'] );
    $sCity['reference'][] = $item['DISPLAY_PROPERTIES']['CITY']['DISPLAY_VALUE'];
    $sCity['reference_id'][] =$item['DISPLAY_PROPERTIES']['CITY']['VALUE'];
    $arResult['ITEMS'][ $id ] = $item;
}

$arResult['sCity']=$sCity;

?>