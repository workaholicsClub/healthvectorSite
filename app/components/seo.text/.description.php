<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SEOTEXT_EDIT_NAME"),
	"DESCRIPTION" => GetMessage("SEOTEXT_EDIT_DESC"),
	"ICON" => "/images/subscr_click.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "iblock",
			"NAME" => GetMessage("SUBSCR_SERVICE")
		)
	),
);
?>