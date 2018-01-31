<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/korrekcionno-pedagogicheskaya-rabota/psihoterapevticheskie-metody/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/korrekcionno-pedagogicheskaya-rabota/psihoterapevticheskie-metody/index.php",
	),
	array(
		"CONDITION" => "#^/korrekcionno-pedagogicheskaya-rabota/zanyatiya-po-razvitiyu/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/korrekcionno-pedagogicheskaya-rabota/zanyatiya-po-razvitiyu/index.php",
	),
	array(
		"CONDITION" => "#^/experts_cooperation/stuff/([^\\?].+)/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2",
		"ID" => "",
		"PATH" => "/experts_cooperation/stuff/detail.php",
	),
	array(
		"CONDITION" => "#^/helpful_info/special-literature/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/helpful_info/special-literature/index.php",
	),
	array(
		"CONDITION" => "#^/helpful_info/science/([^\\?].+)/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2",
		"ID" => "",
		"PATH" => "/helpful_info/science/detail.php",
	),
	array(
		"CONDITION" => "#^/experts_cooperation/lectures/([^\\?].+)\\/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/experts_cooperation/lectures/detail.php",
	),
	array(
		"CONDITION" => "#^/experts_cooperation/seminars/([^\\?].+)\\/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/experts_cooperation/seminars/detail.php",
	),
	array(
		"CONDITION" => "#^/experts_cooperation/stuff/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/experts_cooperation/stuff/index.php",
	),
	array(
		"CONDITION" => "#^/helpful_info/specialists/([^\\?]+)\\/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/helpful_info/specialists/detail.php",
	),
	array(
		"CONDITION" => "#^/soc_life/ads/([^\\?].+)/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2",
		"ID" => "",
		"PATH" => "/soc_life/ads/detail.php",
	),
	array(
		"CONDITION" => "#^/helpful_info/science/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/helpful_info/science/index.php",
	),
	array(
		"CONDITION" => "#^/treatment/programms/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/treatment/programms/index.php",
	),
	array(
		"CONDITION" => "#^/soc_life/fond-list/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/soc_life/fond-list/detail.php",
	),
	array(
		"CONDITION" => "#^/articles/([^\\?].+)/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2",
		"ID" => "",
		"PATH" => "/articles/detail.php",
	),
	array(
		"CONDITION" => "#^/treatment/pitanie/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/treatment/pitanie/index.php",
	),
	array(
		"CONDITION" => "#^/soc_life/events/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/soc_life/events/detail.php",
	),
	array(
		"CONDITION" => "#^/charity/reports/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/charity/reports/index.php",
	),
	array(
		"CONDITION" => "#^/soc_life/story/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/soc_life/story/detail.php",
	),
	array(
		"CONDITION" => "#^/soc_life/ruls_([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/soc_life/index.php",
	),
	array(
		"CONDITION" => "#^/soc_life/ads/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/soc_life/ads/index.php",
	),
	array(
		"CONDITION" => "#^/articles/([^\\?].+)/(\\?.*)?\$#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/articles/index.php",
	),
	array(
		"CONDITION" => "#^/treatment/places/(.*)/.*\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/treatment/places/detail.php",
	),
	array(
		"CONDITION" => "#^\\/tests\\/([^\\?]+)/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/tests/detail.php",
	),
	array(
		"CONDITION" => "#^\\/news\\/([^\\?]+)\\/(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/news/detail.php",
	),
);

?>