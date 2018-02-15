<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Методики реабилитации");
$APPLICATION->SetTitle("Методики реабилитации");
$_REQUEST["ELEMENT_CODE"] = empty($_REQUEST["ELEMENT_CODE"]) ? "feldenkrayz-metod-khavy-shelkhav" : $_REQUEST["ELEMENT_CODE"];
?>
<div class="page" style="margin-top: 30px">
	<div class="content-information-help">
		<div class="content-accordeon">
			<section class="nano content-accordeon--item">
				<h3 class="title_block">Методики реабилитации</h3>
				<div class="nano-content info" style="display: none;">
					<div class="characteristics-content">
						<p>
							 Реабилитация при детском церебральном параличе представляет собой комплекс методик, направленных на устранение имеющихся у детей особенностей в физическом и психическом развитии, на адаптацию к окружающему миру и социуму. Она затрагивает множество областей в медицине, педагогике и психологии. Реабилитация успешна только при комплексном подходе, поскольку двигательные нарушения сочетаются с расстройством речи, психики и мышления.
						</p>
						<p>
							 В медицинскую коррекцию детского церебрального паралича включают&nbsp;следующие методы, которые всегда назначаются врачом:
						</p>
						<ul>
							<li>Медикаментозная терапия. Она необходима только для лечения сопутствующих диагностированных заболеваний (см. <a href="http://federalbook.ru/files/FSZ/soderghanie/Z_16/Z16-2015-Batisheva.pdf">Т.М. Батышева «Современные методики реабилитации детей с детским церебральным параличом»</a>).</li>
							<li>Лечебная физкультура (ЛФК). Упражнения проводятся индивидуально и регулярно (несколько раз в течение дня). По назначению врача несколько раз в год делают курсы лечебной физкультуры по 10-20 процедур 2-3 раза. В остальное время упражнения проводятся дома обученными членами семьи.</li>
							<li>Массаж. Как правило, при детском церебральном параличе используется классический и точечный массаж. Назначаются курсы массажа по 10-15 процедур 4 раза в год. В остальное время массаж делают дома.</li>
							<li>Физиотерапия. Используются парафиновые аппликации (расслабляют спастичные мышцы, напряженные сухожилия). Назначают с 3-х месячного возраста, не чаще 1 раза в 3 месяца. Электропроцедуры делают курсом по 10 приемов, не чаще 2&nbsp;раз в год. При сопутствующей эпилепсии электролечение противопоказано. Водолечение проводится в виде различных ванн, гидромассажа. При реабилитации&nbsp;возможны занятия в бассейне.</li>
							<li>Использование различных устройств и приспособлений. Примерно к году жизни ребенка с особенностями развития возникает необходимость в специальной мебели и приспособлениях для сидения и ходьбы. Это могут быть кресло с подлокотниками и подголовником, ходунки, поручни. Врач может назначить лонгеты на время бодрствования или сна, ортопедическую обувь и другие ортезы для обучения или коррекции ходьбы.</li>
							<li>Мануальная терапия, остеопатия, иглорефлексотерапия являются методами выбора при реабилитации.</li>
						</ul>
						<p>
							 Все вышеперечисленные методы реабилитации используются по назначению нескольких врачей, основными из которых являются невролог, врач лечебной физкультуры (ЛФК), врач-ортопед, иногда психотерапевт. При возникновении сопутствующих заболеваний могут понадобиться консультации офтальмолога, сурдолога (специалист по слуху), эпилептолога. Невролог наблюдает ребенка с детским церебральным параличом, назначает реабилитационные мероприятия. Врач ЛФК проводит диагностику двигательных возможностей ребенка, разрабатывает программу физической реабилитации, назначает упражнения лечебной физкультуры и массаж.
						</p>
						<p>
							 Врач-ортопед выявляет патологию суставов и позвоночника, назначает ношение ортопедической обуви, ортезов, рекомендует оперативные вмешательства.
						</p>
						<p>
							 При возникновении психоэмоциональных проблем, нарушений высших психических функций может потребоваться консультация психиатра.
						</p>
						<p>
							 Для физической коррекции чаще всего используются методы, которые хорошо себя зарекомендовали у тысяч пациентов. Это методы Войта, Бобат, Козявкина и другие.
						</p>
				</div> <!--/characteristics-content-->
			</div>
		</section>
	</div>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"programms",
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
		"FIELD_CODE" => array("CODE"),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "19",
		"IBLOCK_TYPE" => "helpfull_part",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "20",
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
);?>&nbsp;
	<h2><?=$APPLICATION->ShowProperty('h2');?></h2>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"programms",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_NOTES" => "",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
		"ELEMENT_ID" => "",
		"FIELD_CODE" => array(),
		"IBLOCK_ID" => "19",
		"IBLOCK_TYPE" => "helpfull_part",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array("TEXT_IN_END","ADD_LINKS"),
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"USE_PERMISSIONS" => "N"
	)
);?>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>