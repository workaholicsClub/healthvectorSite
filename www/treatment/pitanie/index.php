<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Питание ребенка с ДЦП");
$APPLICATION->SetPageProperty("h2", "Питание ребенка с ДЦП");
$APPLICATION->SetPageProperty("h1", "Реабилитация");
?>
<?
Tools::IncludeModule();
Tools::IncludeModule('form');
$parts = CIBlockElement::GetList(array('SORT'=>'ASC'),array('ACTIVE'=>'Y','IBLOCK_ID'=>33));
$sParts = array(
  "reference" => array(),
  "reference_id" =>array()
);
$url = '';
while ($part = $parts->Fetch() ){
  if(!isset($_REQUEST['ELEMENT_CODE']) || $_REQUEST['ELEMENT_CODE'] == ''){
    $_REQUEST['ELEMENT_CODE'] = $part['CODE'];
  }
  $sParts['reference'][] = $part['NAME'];
  $sParts['reference_id'][] = $part['CODE'];
  $url = $part['LIST_PAGE_URL'];
}


?>
<!--/bottom-program-sale -->
  <div class="page" style="margin-top: 30px">

    <div class="group-reports">
      <div class="year-report select-parent year-report-select">
        <?=CForm::GetDropDownField('ADS',$sParts,$_REQUEST['SECTION_CODE'],' class="js-select-pager" data-url="'.$url.'"');?>
      </div>
    </div>

    <h2><?=$APPLICATION->ShowProperty('h2');?></h2>
      <?$APPLICATION->IncludeComponent(
      "bitrix:news.detail",
      "also_text",
      Array(
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "treatment",
        "IBLOCK_ID" => "33",
        "ELEMENT_ID" => "",
        "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => array(),
        "PROPERTY_CODE" => array("TEXT_IN_END", "ADD_LINKS"),
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
        "CACHE_NOTES" => "",
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
  </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>