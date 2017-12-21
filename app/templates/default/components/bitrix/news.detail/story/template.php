<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="page">
  <div class="children-stories-page" id="<?=Tools::GetIBlockElementEditLink( $arResult['ID'], $arResult['IBLOCK_ID']) ?>">
    <?if($arResult['PREVIEW_PICTURE'] != ''):?>
      <div class="children-stories-photo fl-page mw100">
        <?=CFile::ShowImage($arResult['PREVIEW_PICTURE']);?>
        <img class="icon" src="/image/star-icon-arrow.png" alt="">
        <div class="arrow-art"></div>
      </div>
    <?endif;?>
    <?=$arResult['~DETAIL_TEXT'];?>
    <a class="btn" onClick="window.history.back();" href="">Вернуться назад &rarr;</a>
</div> <!--/children-stories-page-->
</div>
