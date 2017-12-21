
<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
  if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
    return;
}

//echo "<pre>"; print_r($arResult);echo "</pre>";

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

?>

<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
  if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
    return;
}
?>


<ul class="pagination">
  <?if ($arResult["NavPageNomer"] > 1):?>

    <?if($arResult["bSavePage"]):?>

      <li><a class="pagination-left" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&nbsp;</a></li>

      <li><a class="pagination-start"  href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">&laquo;</a></li>

    <?else:?>

      <?if ($arResult["NavPageNomer"] > 2):?>
        <li><a class="pagination-left" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&nbsp;</a></li>
      <?else:?>
        <li><a class="pagination-left" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_prev")?></a></li>
      <?endif?>
      <li><a class="pagination-start" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">&laquo;</a></li>
    <?endif?>

  <?else:?>
    <li><a class="pagination-left" >&nbsp;</a></li>
    <li><a class="pagination-start" >&laquo;</a></li>
  <?endif?>

  <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

    <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
      <li><a class="pagination-item active" ><?=$arResult["nStartPage"]?></a></li>
    <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
      <li><a class="pagination-item" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
    <?else:?>
      <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
    <?endif?>
    <?$arResult["nStartPage"]++?>
  <?endwhile?>


  <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
    <li><a  class="pagination-end" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">&raquo;</a></li>
    <li><a class="pagination-right" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">&nbsp;</a></li>
  <?else:?>

    <li><a class="pagination-end" >&raquo;</a></li>

    <li><a class="pagination-right" >&nbsp;</a></li>
  <?endif?>


</ul>