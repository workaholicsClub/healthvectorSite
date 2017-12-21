<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->AddChainItem($arResult['NAME']);
$APPLICATION->SetPageProperty('h2',$arResult['NAME']);
if($arResult['IBLOCK']['CODE'] == 'specialists'){
  $APPLICATION->SetPageProperty('h1','Полезная информация');
}else{
  $APPLICATION->SetPageProperty('h1','Сообщество экспертов');
}
$APPLICATION->SetPageProperty('title',$arResult['NAME']);
?>