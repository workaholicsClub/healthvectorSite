<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Реабилитационные центры");
$APPLICATION->SetPageProperty("h1", "Полезная информация");
$APPLICATION->SetPageProperty("h2", "Реабилитационные центры");?>
<? $jso->enable('site/places');?> <section class="content">
 	<?
	$GLOBALS['arrFilterPlaces'] = array(
		'NAME'=>$_REQUEST['form_dropdown_BUILD'],
		'PROPERTY_CITIES'=>$_REQUEST['form_dropdown_CITIES'],
		'PROPERTY_AREA'=>$_REQUEST['form_dropdown_AREA'],
		'PROPERTY_SPEC'=>$_REQUEST['form_dropdown_SPEC']
	);
	?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"places",
	Array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "helpfull_part",
		"IBLOCK_ID" => "21",
		"NEWS_COUNT" => "10000",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilterPlaces",
		"FIELD_CODE" => array(),
		"PROPERTY_CODE" => array("COORDS", "IS_BUILD", "CITIES", "AREA", "SPEC"),
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
		"PARENT_SECTION_CODE" => "",
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
);?> 	
 	</section> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>