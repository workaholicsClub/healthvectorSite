<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Полезная информация");
$APPLICATION->SetPageProperty("h1", "Полезная информация");
?>
 <div class="page">
	 <?$APPLICATION->IncludeComponent(
		 "bitrix:menu",
		 "pages",
		 array(
			 "ROOT_MENU_TYPE" => "pages",
			 "MAX_LEVEL" => "1",
			 "CHILD_MENU_TYPE" => "pages.submenu",
			 "USE_EXT" => "Y",
			 "DELAY" => "N",
			 "ALLOW_MULTI_SELECT" => "N",
			 "MENU_CACHE_TYPE" => "A",
			 "MENU_CACHE_TIME" => "3600",
			 "MENU_CACHE_USE_GROUPS" => "Y",
			 "MENU_CACHE_GET_VARS" => array()
		 ),
		 false
	 );?>
 </div>
 <!--/bottom-program-sale -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>