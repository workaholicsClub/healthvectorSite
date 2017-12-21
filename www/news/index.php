<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Новости");
$APPLICATION->SetTitle("Новости");
//$jso->enable('site/loader');
?>
<div class="page"> <section class="section-news"> 
    <div class="subscribe-news subscribe-news--work"> <form action="/ajax/subscribe.news.php" class="ajaxform"> 				<input name="email" class="subscribe-field" placeholder="E-mail для подписки на новости" type="text" /> 				<input class="subscribe-submit" value="" type="submit" /> 			</form> </div>
   
    <div class="calendar-news"> 
      <div class="btn-calendar">Календарь</div>
     
      <div class="wrapper-calendar"> 
        <div class="calendar-block"> 
          <div class="calendar-content js-calc-content"> <?$APPLICATION->IncludeComponent(
	"interlabs:news.calendar.interlabs",
	"healthvector.news",
	Array(
		"FILTER_NAME" => "calendar",
		"LIST_URL" => "/news/",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "general_information",
		"IBLOCK_ID" => "10",
		"MONTH_VAR_NAME" => "month",
		"YEAR_VAR_NAME" => "year",
		"WEEK_START" => "1",
		"DATE_FIELD" => "DATE_ACTIVE_FROM",
		"TYPE" => "EVENTS",
		"SHOW_YEAR" => "Y",
		"SHOW_TIME" => "Y",
		"TITLE_LEN" => "0",
		"SET_TITLE" => "N",
		"SHOW_CURRENT_DATE" => "Y",
		"SHOW_MONTH_LIST" => "Y",
		"NEWS_COUNT" => "0",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);?> </div>
         </div>
       
<!--/calendar-block-->
 
        <div class="calendar-block--bottom"><img class="close-icon" src="/image/close.png"  /></div>
       </div>
     </div>
   
<!--/calendar-news-->
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"news", 
	array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "general_information",
		"IBLOCK_ID" => "10",
		"NEWS_COUNT" => "3",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "calendar",
		"FIELD_CODE" => array(
			0 => "CODE",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
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
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "news",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?> </section> </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>