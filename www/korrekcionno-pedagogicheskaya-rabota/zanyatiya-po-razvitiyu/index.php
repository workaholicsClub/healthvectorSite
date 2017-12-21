<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Занятия по развитию");
$APPLICATION->SetPageProperty("h2", "Занятия по развитию");?>
<!-- <section class="content"> -->
<div class="page">
  <div class="content-information-help">
		<div class="page">
			<!-- <h2>Занятия по развитию</h2> -->
			<p>В стадии наполнения</p>
		</div>
	</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"programms",
	Array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "helpfull_part",
		"IBLOCK_ID" => $_SERVER['HIVE_ENV'] ? "34" : "35",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array("CODE"),
		"PROPERTY_CODE" => array(),
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
	<h2><?=$APPLICATION->ShowProperty('h3');?></h2>
	<?$APPLICATION->IncludeComponent(
  	"bitrix:news.detail",
  	"programms",
  	Array(
  		"AJAX_MODE" => "N",
  		"IBLOCK_TYPE" => "helpfull_part",
  		"IBLOCK_ID" => $_SERVER['HIVE_ENV'] ? "34" : "35",
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
  		"AJAX_OPTION_HISTORY" => "N",
      "HEADER_CONTAINER" => "h3"
  	)
  );?>
</div>
<?$APPLICATION->SetPageProperty("h1", "Коррекционно-педагогическая работа");?>
<!-- </section> -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
