<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if ((int)$_REQUEST['ajax']) {

$content = ob_get_contents();
ob_end_clean();

$APPLICATION->RestartBuffer();

list(, $content_html) = explode('<!--RestartBuffer-->', $content);
  $result = array(
    'html_data' => $content_html,
    'points' => $arResult['POINTS']
  );
die(json_encode($result));
}