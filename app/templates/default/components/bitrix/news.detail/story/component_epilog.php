<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->AddChainItem($arResult['NAME']);
$APPLICATION->SetPageProperty('h2',$arResult['NAME']);
$APPLICATION->SetPageProperty('h1','БЛАГОТВОРИТЕЛЬНОСТЬ');
$APPLICATION->SetPageProperty('title',$arResult['NAME']);
?>