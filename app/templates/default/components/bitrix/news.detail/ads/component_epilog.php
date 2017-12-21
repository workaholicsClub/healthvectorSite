<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->AddChainItem($arResult['NAME']);
$APPLICATION->SetPageProperty('h2',$arResult['NAME']);
$APPLICATION->SetPageProperty('h1','Жизнь в обществе');
$APPLICATION->SetPageProperty('title',$arResult['NAME']);
?>