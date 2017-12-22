<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->AddChainItem($arResult['NAME']);
$APPLICATION->SetPageProperty(isset($arParams['HEADER_CONTAINER']) ? $arParams['HEADER_CONTAINER'] : 'h2',$arResult['NAME']);
$APPLICATION->SetPageProperty('title',$arResult['NAME']);
?>
