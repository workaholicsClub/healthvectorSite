<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
require_once('BASeoEngine.php');
$engine = new BASeoEngine($arParams);
$arResult = $engine->execute();
$this->IncludeComponentTemplate();