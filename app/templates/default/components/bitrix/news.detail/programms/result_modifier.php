<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult['ADD_LINKS'] = array();
$arFilter = array('ACTIVE'=>'Y','IBLOCK_ID'=>$arResult['PROPERTIES']['ADD_LINKS']['LINK_IBLOCK_ID'],'ID'=>$arResult['PROPERTIES']['ADD_LINKS']['VALUE']);
$arSelect = array('NAME','PREVIEW_PICTURE','PROPERTY_INFO_URL');
$dbLinks = CIBlockElement::GetLIst(array('SORT'=>'ASC'),$arFilter,false,false,$arSelect);

while($link = $dbLinks->Fetch()){
  $arResult['ADD_LINKS'][] = $link;
}

?>