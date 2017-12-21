<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
	return;
  
$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];


$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
    "ANNOUNCE" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SEOTEXT_ANNOUNCE"),
			"TYPE" => "STRING",
			"DEFAULT" => "Анонс",
      "COLS" => "60"
    ),    
    "FULL_TEXT" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SEOTEXT_FULL_TEXT"),
			"TYPE" => "STRING",
			"DEFAULT" => "Полный текст",
      "COLS" => "60"
    ),
		"IBLOCK_ID" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("SEOTEXT_BLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '={$_REQUEST["ID"]}',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
    "ELEMENT_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("SEOTEXT_ELEMENT_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '={$_REQUEST["ELEMENT_ID"]}',
		),
    "ANNOUNCE_FIELD" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("SEOTEXT_ANNOUNCE_FIELD"),
			"TYPE" => "STRING",
			"DEFAULT" => "PROPERTY_SEO_ANNOUNCE"
    ),    
    "FULL_TEXT_FIELD" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("SEOTEXT_FULL_TEXT_FIELD"),
			"TYPE" => "STRING",
			"DEFAULT" => "PROPERTY_SEO_TEXT"
    ),
    "READ_MORE" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME"=>GetMessage("SEOTEXT_READ_MORE"),
			"TYPE"=>"STRING",
			"DEFAULT"=>"Развернуть текст",
		),    
    "READ_MORE_HIDE" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME"=>GetMessage("SEOTEXT_READ_MORE_HIDE"),
			"TYPE"=>"STRING",
			"DEFAULT"=>"Свернуть текст",
		),
	),
);
?>
