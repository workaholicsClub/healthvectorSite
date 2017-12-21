<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("h1", "Жизнь в обществе");
$APPLICATION->SetPageProperty("h2", "Объявления");
$APPLICATION->SetTitle("Объявления");
$jso->enable('site/loader');
?>
<?
Tools::IncludeModule();
Tools::IncludeModule('form');
$parts = CIBlockSection::GetList(array('SORT'=>'ASC'),array('ACTIVE'=>'Y','IBLOCK_ID'=>Config::IBLOCK_ADS));
$sParts = array(
  "reference" => array(),
  "reference_id" =>array()
);
$url = '';
while ($part = $parts->Fetch() ){
 if(!isset($_REQUEST['SECTION_CODE']) || $_REQUEST['SECTION_CODE'] == ''){
  $_REQUEST['SECTION_CODE'] = $part['CODE'];
 }
 $sParts['reference'][] = $part['NAME'];
 $sParts['reference_id'][] = $part['CODE'];
 $url = $part['LIST_PAGE_URL'];
}


?>
 <div class="page">
 <div class="group-reports">
   <div class="year-report select-parent year-report-select">
    <?=CForm::GetDropDownField('ADS',$sParts,$_REQUEST['SECTION_CODE'],' class="js-select-pager" data-url="'.$url.'"');?>
   </div>
  </div>
  <?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "ads",
    Array(
      "AJAX_MODE" => "N",
      "IBLOCK_TYPE" => "soc_life",
      "IBLOCK_ID" => "25",
      "NEWS_COUNT" => "6",
      "SORT_BY1" => "ACTIVE_FROM",
      "SORT_ORDER1" => "DESC",
      "SORT_BY2" => "SORT",
      "SORT_ORDER2" => "ASC",
      "FILTER_NAME" => "",
      "FIELD_CODE" => array("CODE"),
      "PROPERTY_CODE" => array("FILES"),
      "CHECK_DATES" => "N",
      "DETAIL_URL" => "",
      "PREVIEW_TRUNCATE_LEN" => "",
      "ACTIVE_DATE_FORMAT" => "d.m.Y",
      "SET_TITLE" => "N",
      "SET_STATUS_404" => "N",
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "ADD_SECTIONS_CHAIN" => "N",
      "HIDE_LINK_WHEN_NO_DETAIL" => "N",
      "PARENT_SECTION" => "",
      "PARENT_SECTION_CODE" => $_REQUEST['SECTION_CODE'],
      "INCLUDE_SUBSECTIONS" => "Y",
      "CACHE_TYPE" => "A",
      "CACHE_TIME" => "36000000",
      "CACHE_FILTER" => "N",
      "CACHE_GROUPS" => "Y",
      "PAGER_TEMPLATE" => ".default",
      "DISPLAY_TOP_PAGER" => "N",
      "DISPLAY_BOTTOM_PAGER" => "Y",
      "PAGER_TITLE" => "Новости",
      "PAGER_SHOW_ALWAYS" => "N",
      "PAGER_DESC_NUMBERING" => "N",
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
      "PAGER_SHOW_ALL" => "N",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "AJAX_OPTION_HISTORY" => "N"
    ),
    false
  );?>
 </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>