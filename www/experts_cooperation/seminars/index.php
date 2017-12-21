<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Семинары и конференции");
$APPLICATION->SetPageProperty("h2", "Семинары и конференции");
$APPLICATION->SetPageProperty("h1", "Сообщество экспертов");
?> 	<?php

	$date = time();
	if(isset($_REQUEST['DATE'])){
			$date = DateTime::createFromFormat('Y-m',$_REQUEST['DATE']);
			$date = $date->getTimestamp();
	}
	if(!isset($_REQUEST['DATE'])){
		$_REQUEST['DATE'] = date('Y-m');
	}
	$GLOBALS['filterSeminars'] = array(
		'>=DATE_ACTIVE_FROM'  => date( '01.m.Y 00:00:00',$date ),
		'<=DATE_ACTIVE_FROM'  => date( 't.m.Y 23:59:59', $date)
	);
?> 
<div class="page"> 	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"seminars",
	Array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "experts_com",
		"IBLOCK_ID" => "18",
		"NEWS_COUNT" => "200",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "filterSeminars",
		"FIELD_CODE" => array("DATE_ACTIVE_FROM", "ACTIVE_FROM", "DATE_ACTIVE_TO", "ACTIVE_TO"),
		"PROPERTY_CODE" => array("CITY", "AUTHOR", "RULES"),
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
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
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