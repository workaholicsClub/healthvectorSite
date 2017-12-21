<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
ob_start();?>
<?php if($arResult['TEXT_IS_PRESENT']) { ?>
<div class="app-seo-text">
  <div class="js-seo announce" data-role="announce"><?=$arResult['ANNOUNCE'];?></div>
  <a href="#" class="js-seo readmore" data-role="readmore" 
    data-show="<?=htmlspecialchars($arParams['READ_MORE']);?>" 
    data-hide="<?=htmlspecialchars($arParams['READ_MORE_HIDE']);?>"><span class="js-seo" data-role="readmore-text"><?=$arParams['READ_MORE'];?></span></a>
  <div class="js-seo fulltext" data-role="fulltext"><?=$arResult['FULL_TEXT'];?></div>
</div>
<?php } ?>
<?
$block = ob_get_contents();
ob_end_clean();
$GLOBALS['INTERLABS_SEO_BLOCK'] = $block;
?>