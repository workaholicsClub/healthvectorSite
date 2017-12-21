<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Реабилитационные центры");
$APPLICATION->SetTitle("Реабилитационные центры");?>

<?$APPLICATION->IncludeComponent("bitrix:news.detail", "places", Array(
	"AJAX_MODE" => "N",	// Включить режим AJAX
		"IBLOCK_TYPE" => "helpfull_part",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" => "21",	// Код информационного блока
		"ELEMENT_ID" => "",	// ID новости
		"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],	// Код новости
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_TEXT",
			3 => "",
		),
		"PROPERTY_CODE" => array(	// Свойства
			0 => "ADDRESS",
			1 => "URL",
			2 => "PHONE",
			3 => "",
		),
		"IBLOCK_URL" => "",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"BROWSER_TITLE" => "NAME",	// Установить заголовок окна браузера из свойства
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"PAGER_TITLE" => "Страница",	// Название категорий
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"COMPONENT_TEMPLATE" => ".default",
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
		"SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа элемента
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "N",	// Выводить детальное изображение
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"USE_SHARE" => "N",	// Отображать панель соц. закладок
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>