<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тесты");
$APPLICATION->SetPageProperty("h1", "Тесты");
?>
	<div class="page">
		<p>При малейшем подозрении, что ваш ребенок отстает в развитии, нужно обращаться к специалисту. Чтобы на приеме
			у педиатра аргументировать свои подозрения, лучше самостоятельно пройти несколько тестов, которые вы найдете
			на нашем портале. Необходимо помнить, что тесты разработаны для использования врачами, поэтому окончательный
			вывод могут сделать только они. У родителей просто нет опыта и образования, чтобы дать окончательную
			трактовку симптомов. Если вы ответили «да» хотя бы один раз на вопрос теста, стоит забеспокоиться. Может
			быть тревога окажется ложной. Но если нет, раннее начало лечения станет залогом его успеха.</p>
		<br clear="all">
		<style>
			.news-list table td {
				padding-bottom: 10px;
			}
		</style>
		<?
		$GLOBALS['testFilter'] = array('PROPERTY_IGNORE' => false);
		?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"table",
			Array(
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"AJAX_MODE" => "N",
				"IBLOCK_TYPE" => "tests_block",
				"IBLOCK_ID" => "13",
				"NEWS_COUNT" => "20",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "testFilter",
				"FIELD_CODE" => array(),
				"PROPERTY_CODE" => array('GROUP'),
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
				"PAGER_SHOW_ALL" => "Y",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N"
			)
		);?>
	</div>
 
<!--/bottom-program-sale -->
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>