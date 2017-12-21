<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach( $arResult['ITEMS'] as $id => $item ) {
    $item['_EDIT_AREA'] = Tools::GetIBlockElementEditLink( $item['ID'], $item['IBLOCK_ID'] );
    $arResult['ITEMS'][ $id ] = $item;
}

?>