<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Органические поражения ЦНС: Аутизм");
$APPLICATION->SetPageProperty("h2", "Органические поражения ЦНС: Аутизм");
$APPLICATION->SetPageProperty("h1", "Нарушения цнс");
 $jso->enable('site/skintest'); 
?>
  <?$APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "tests",
    Array(
      "AJAX_MODE" => "N",
      "IBLOCK_TYPE" => "tests_block",
      "IBLOCK_ID" => "13",
      "ELEMENT_ID" => "",
      "ELEMENT_CODE" => 'test-na-nalichie-autizma-m-chat',
      "CHECK_DATES" => "Y",
      "FIELD_CODE" => array(),
      "PROPERTY_CODE" => array('QUESTIONS','ANSWERS'),
      "IBLOCK_URL" => "",
      "META_KEYWORDS" => "-",
      "META_DESCRIPTION" => "-",
      "BROWSER_TITLE" => "-",
      "SET_TITLE" => "N",
      "SET_STATUS_404" => "N",
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "ADD_SECTIONS_CHAIN" => "N",
      "ACTIVE_DATE_FORMAT" => "d.m.Y",
      "USE_PERMISSIONS" => "N",
      "CACHE_TYPE" => "A",
      "CACHE_TIME" => "36000000",
      "CACHE_GROUPS" => "Y",
      "PAGER_TEMPLATE" => ".default",
      "DISPLAY_TOP_PAGER" => "N",
      "DISPLAY_BOTTOM_PAGER" => "Y",
      "PAGER_TITLE" => "Страница",
      "PAGER_SHOW_ALL" => "Y",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "AJAX_OPTION_HISTORY" => "N"
    )
  );?>


 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>