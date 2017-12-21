<?
  require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
  $APPLICATION->SetTitle("Вектор здоровья - портал по реабилитации детей с ДЦП");
?><?php
  //Устанавливаем фильтр если нужны только которые на главной( обычно это IS_MAIN )
  $GLOBALS['isMain'] = array(
    'PROPERTY_IS_MAIN_VALUE' => 'ДА'
  );
?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"main.slider",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "sliders",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "10000",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(),
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?> <!--/slider-container-main-->
<div class="middle middle-main">
 <section class="section-about">
	<div class="page">
		<div class="about-content">
			<h2 class="h2">О нас</h2>
			<p class="main-text-about">
 <span style="font-size: 14pt;"><i>Мы&nbsp;приветствуем вас на&nbsp;сайте &laquo;Вектор здоровья&raquo;. Проект в&nbsp;первую очередь адресован родителям, которых заботит проблема реабилитации детей с&nbsp;детским церебральным параличом.</i></span><br>
 <i> </i><span style="font-size: 14pt;"><i> </i></span><i> </i>
			</p>
 <i> </i>
			<p>
 <i> </i><span style="font-size: 14pt;"><i>Миссия портала - дать наиболее исчерпывающую информацию о данной особенности развития и помочь в ее&nbsp;ранней диагностике.</i></span>
			</p>
			<p class="main-text-about">
 <a href="/about/" class="btn">Узнать больше →</a>
			</p>
		</div>
	</div>
 </section>
	<?php /* ?>
  <section class="section-test">
    <div class="figure-test"></div>
    <div class="page">
      <h2 class="h2--center">Слово редактора</h2>
      <p class="main-text-about">Депутаты Государственной Думы Олег Смолин и&nbsp;Любовь Духанина внесли проект поправок в&nbsp;закон &laquo;Об&nbsp;образовании&raquo;. Если они будут приняты, то&nbsp;молодые люди с&nbsp;инвалидностью, поступающие в&nbsp;вузы по&nbsp;квоте, смогут подавать документы в&nbsp;пять учебных заведений, а&nbsp;не&nbsp;в&nbsp;одно, как раньше. Это должно сделать высшее образование более доступным для инвалидов. Ведь иначе они будут по-прежнему обречены жить на&nbsp;обочине общества, так как заниматься физическим трудом они не&nbsp;могут.
      </p>
      <p class="main-text-about">Сейчас существует ограничение &laquo;один вуз&nbsp;&mdash; одна специальность&raquo;. В&nbsp;прошлом году исследовательский центр &laquo;Особое мнение&raquo;, директором которого является член Общественной палаты РФ&nbsp;Екатерина Курбангалеева, в&nbsp;рамках президентского гранта проводил всероссийский мониторинг доступности высшего профессионального образования для инвалидов и&nbsp;лиц с&nbsp;ОВЗ. В&nbsp;рамках&nbsp;10% квоты они могут подавать документы только в&nbsp;один вуз на&nbsp;одну специальность, в&nbsp;то&nbsp;время как здоровые молодые люди&nbsp;&mdash; в&nbsp;5&nbsp;вузов на&nbsp;3&nbsp;специальности в&nbsp;каждом. </p>
      <p class="main-text-about">По&nbsp;подсчетам, которые сделала Екатерина Курбангалеева, ежегодно в&nbsp;вузы поступают около 5&nbsp;тыс. инвалидов, а&nbsp;всего высшее образование получают примерно 20&nbsp;тыс. людей с&nbsp;инвалидностью. Это каждый 33-й инвалид в&nbsp;возрасте от&nbsp;18&nbsp;до&nbsp;30&nbsp;лет. При этом всего в&nbsp;стране около пяти миллионов студентов&nbsp;&mdash; то&nbsp;есть каждый четвертый в&nbsp;этом&nbsp;же возрастном диапазоне. Постоянно сталкиваясь с&nbsp;ограничениями во&nbsp;всех сферах, молодые инвалиды не&nbsp;верят в&nbsp;свои силы. Поэтому снятие административный барьеров на&nbsp;пути получения образования этими людьми&nbsp;&mdash; еще один шаг по&nbsp;пути их&nbsp;интеграции в&nbsp;общество.
      </p>
      <p class="main-text-about">Есть большая вероятность, что эти поправки обретут силу закона. Они уже поддержаны Комиссией при Президенте РФ&nbsp;по&nbsp;делам инвалидов и&nbsp;Министерством образования и&nbsp;науки&nbsp;РФ.</p>
    </div>
  </section>
  <?php */ ?> <?
    $GLOBALS['testFilter'] = array(
      'PROPERTY_IGNOR_MAIN' => false
    );
  ?> <? /* $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "tests.main",
    Array(
    "AJAX_MODE" => "N",
    "IBLOCK_TYPE" => "tests_block",
    "IBLOCK_ID" => "13",
    "NEWS_COUNT" => "10000",
    "SORT_BY1" => "ACTIVE_FROM",
    "SORT_ORDER1" => "DESC",
    "SORT_BY2" => "SORT",
    "SORT_ORDER2" => "ASC",
    "FILTER_NAME" => "testFilter",
    "FIELD_CODE" => array(),
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
  ); */?> <section class="section-task">
	<div class="figure-tasks">
	</div>
	<div class="pos-pic-task pos-pic-task--left">
		 &nbsp;
	</div>
	<div class="pos-pic-task pos-pic-task--right">
		 &nbsp;
	</div>
	<div class="page">
		<div class="task-content">
			<div class="task-content-item color-group-1 b-first-phone">
				<h2 class="h2-task">Задачи</h2>
				<div class="show-item-all">
					 Развернуть ↓
				</div>
			</div>
			<div class="task-content-item color-group-2">
				<div class="number number--n1">
					 1
				</div>
				<div class="heading">
					 Создание<br>
					 информационного<br>
					 ресурса
				</div>
				<div class="text">
					 От&nbsp;первых шагов по&nbsp;определению особенностей развития ребенка до&nbsp;начала реабилитации. Практические рекомендации. Тесты развития.
				</div>
			</div>
			<div class="task-content-item color-group-3">
				<div class="number number--n2">
					 2
				</div>
				<div class="heading">
					 Мониторинг новостей<br>
					 и интересных<br>
					 событий
				</div>
				<div class="text">
					 Новости, анонсы мероприятий, изменения в&nbsp;законодательстве, новые разработки в&nbsp;реабилитации.
				</div>
			</div>
			<div class="task-content-item color-group-4">
				<div class="number number--n3">
					 3
				</div>
				<div class="heading">
					 Единая база<br>
					 по методикам в<br>
					 области реабилитации
				</div>
				<div class="text">
					 Описание методов реабилитации, которые практикуют в&nbsp;России и&nbsp;за&nbsp;рубежом.
				</div>
			</div>
			<div class="task-content-item color-group-1 tablet-hide">
				<div class="number number--n4">
					 4
				</div>
				<div class="heading">
					 Мобильное<br>
					 приложение
				</div>
				<div class="text">
					 со&nbsp;встроенными программами по&nbsp;реабилитации и&nbsp;возможностью отслеживать стадии развития ребенка.
				</div>
			</div>
			<div class="task-content-item color-group-2 tablet-hide">
				<div class="number number--n5">
					 5
				</div>
				<div class="heading">
					 Построение единой<br>
					 базы данных
				</div>
				<div class="text">
					 Контакты реабилитационных центров, детских больниц, коррекционных образовательных заведений.
				</div>
			</div>
			<div class="task-content-item color-group-3 tablet-hide">
				<div class="number number--n6">
					 6
				</div>
				<div class="heading">
					 Ребенок<br>
					 с особенностями<br>
					 развития в обществе
				</div>
				<div class="text">
					 Социальная адаптация. Истории успеха.
				</div>
			</div>
			<div class="task-content-item color-group-4 tablet-hide">
				<div class="number number--n7">
					 7
				</div>
				<div class="heading">
					 Информация<br>
					 о мерах<br>
					 государственной<br>
					 и частной поддержки
				</div>
				<div class="text">
					 Льготы, госпрограммы, законодательство, специализированные благотворительные фонды.
				</div>
			</div>
		</div>
	</div>
	<div class="figure figure-task-bottom small-tablet">
	</div>
 </section>
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news.main",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "general_information",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "10",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(),
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?> <section class="section-articles">
	<div class="figure-articles">
	</div>
	<div class="pos-pic-art pos-pic-art--left">
		 &nbsp;
	</div>
	<div class="pos-pic-art pos-pic-art--right">
		 &nbsp;
	</div>
	<div class="page">
		<div class="articles-content">
			<div class="group-heading">
 <span class="tabs-links-item active">Статьи</span>
			</div>
			<div class="tabs-content">
				<div class="tab-content-art tabs-content-item active">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"articles.main",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "general_information",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "10",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array('ICON'),
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
				</div>
				 <!--/tab-content-art-->
				<div class="tab-content-art tabs-content-item">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"publics.main",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "28",
		"IBLOCK_TYPE" => "general_information",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "10",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array('ICON'),
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
				</div>
				 <!--/tab-content-art-->
			</div>
			 <!--/tabs-content-->
		</div>
	</div>
 </section>
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"partners.main",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(),
		"FILTER_NAME" => "isMain",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "29",
		"IBLOCK_TYPE" => "general_information",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "10",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array('SITE_URL','IS_MAIN'),
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?> <section class="section-contacts-map">
	<div class="map-content">
		<div class="map map-main js-map" id="mapsYandex" data-gm1="55.7102989" data-gm2="37.7216569">
		</div>
		<div class="position-block">
			<h2>Контакты</h2>
			<div class="geo">
				 Мы находимся на территории Технополиса "Москва"
			</div>
			<p>
 <b>Адрес:</b> 109316, г. Москва, Волгоградский проспект, д. 42
			</p>
			<p>
 <b>Телефон:</b> <a href="#callback" class="js-popup ">+7 495 647 08 18</a> <a href="#callback" class="js-popup ">Позвонить</a>
			</p>
			<p>
 <b>E-mail:</b> <a href="mailto:office@healthvector.ru">office@healthvector.ru</a>
			</p>
		</div>
	</div>
 </section>
</div>
 <!--/middle --><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>