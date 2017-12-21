<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("h1", "Жизнь в обществе");
$APPLICATION->SetPageProperty("h2", "Мероприятия");
$APPLICATION->SetTitle("Мероприятия");
//$jso->enable('site/loader');

$date = time();
if(isset($_REQUEST['DATE'])){
 $date = DateTime::createFromFormat('Y-m',$_REQUEST['DATE']);
 $date = $date->getTimestamp();
}
if(!isset($_REQUEST['DATE'])){
 $_REQUEST['DATE'] = date('Y-m');
}
Tools::IncludeModule();
Tools::IncludeModule('form');
$parts = CIBlockElement::GetList(array('ACTIVE_FROM'=>'DESC'),array('ACTIVE'=>'Y','IBLOCK_ID'=>Config::IBLOCK_EVENTS),array('ACTIVE_FROM'));
$sParts = array(
  "reference" => array(),
  "reference_id" =>array()
);
$url = $APPLICATION->GetCurPage().'?DATE=';
$key = '';
$currTime = false;
while ($part = $parts->Fetch() ){
 $partss[] = $part;
 $sParts['reference'][] = FormatDate('f',MakeTimeStamp($part['ACTIVE_FROM'])).', '.FormatDate('Y',MakeTimeStamp($part['ACTIVE_FROM']));
 $key  = FormatDate('Y',MakeTimeStamp($part['ACTIVE_FROM'])).'-'.FormatDate('m',MakeTimeStamp($part['ACTIVE_FROM']));
 $sParts['reference_id'][] = $key;

 if($key == $_REQUEST['DATE']){
  $currTime = true;
 }
}
$sParts['reference'] = array_unique($sParts['reference']);
$sParts['reference_id'] = array_unique($sParts['reference_id']);
//если нет данных на данный момент то выводим последний
if(!$currTime){
 $_REQUEST['DATE'] = current($sParts['reference_id']);
 $date = DateTime::createFromFormat('Y-m',$_REQUEST['DATE']);
 $date = $date->getTimestamp();
}


$GLOBALS['filterEvents'] = array(
  '>=DATE_ACTIVE_FROM'  => date( '01.m.Y 00:00:00',$date),
  '<=DATE_ACTIVE_FROM'  => date( 't.m.Y 23:59:59', $date)
);

?>

<div class="page">
	<div class="content-society">
		<h3>Промежуток времени:</h3>
		<div class="year-report select-parent year-report-select">
		 <?=CForm::GetDropDownField('EVENTS',$sParts,$_REQUEST['DATE'],' class="js-select-pager" get data-url="'.$url.'"');?>
		</div>
	</div>

 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"events",
	Array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "soc_life",
		"IBLOCK_ID" => "26",
		"NEWS_COUNT" => "3",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "filterEvents",
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
	)
);?></div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>