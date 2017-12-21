<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Карта сайта");
$APPLICATION->SetTitle("Карта сайта");?>

<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"sitemap",
	Array(
		"ROOT_MENU_TYPE" => "top",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "top.submenu",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array()
	)
);?> 
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>