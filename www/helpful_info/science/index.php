<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Научные публикации");
$APPLICATION->SetPageProperty("h1", "Научные публикации");
//$jso->enable('site/loader');
?><?
Tools::IncludeModule();
Tools::IncludeModule('form');
$parts = CIBlockSection::GetList(array('SORT'=>'ASC'),array('ACTIVE'=>'Y','IBLOCK_ID'=>Config::IBLOCK_SCIENCE));
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
		<div class="group-articles-select select-parent"> <?=CForm::GetDropDownField('PART',$sParts,$_REQUEST['SECTION_CODE'],' class="js-select-pager" data-url="'.$url.'"');?> </div>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"articles_scince",
			Array(
				"AJAX_MODE" => "N",
				"IBLOCK_TYPE" => "general_information",
				"IBLOCK_ID" => "28",
				"NEWS_COUNT" => "8",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array("CODE"),
				"PROPERTY_CODE" => array("ICON"),
				"CHECK_DATES" => "Y",
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
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"PAGER_TEMPLATE" => ".default",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "Новости",
				"PAGER_SHOW_ALWAYS" => "Y",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "Y",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N"
			)
		);?> </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>