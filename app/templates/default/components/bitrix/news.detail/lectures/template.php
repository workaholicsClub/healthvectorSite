<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section class="content" id="<?=Tools::GetIBlockElementEditLink( $arResult['ID'], $arResult['IBLOCK_ID']) ?>">
  <div class="page">
    <div class="block-group">
      <div class="block">
        <?if($arResult['DETAIL_PICTURE']['SRC']!=''):?>
          <div class="block news-page-head-img">
            <?=Cfile::ShowImage($arResult['DETAIL_PICTURE']);?>
          </div>
        <?endif;?>
        <div class="block news-page-head-content <?=($arResult['DETAIL_PICTURE']['SRC']!=''?'':'fix');?>">
          <div class="news-item-date">
            <span class="news-item-date-day"><?=FormatDate("d", MakeTimeStamp($arResult["ACTIVE_FROM"]));?></span>
            <span class="news-item-date-month"><?=FormatDate("F", MakeTimeStamp($arResult["ACTIVE_FROM"]));?></span>
            <span class="news-item-date-year"><?=FormatDate("Y", MakeTimeStamp($arResult["ACTIVE_FROM"]));?></span>
          </div>
          <h2 class="title"><?=$arResult['NAME']?></h2>
        </div>
        <?if(trim($arResult['~PREVIEW_TEXT'])!=''):?>
          <div class="block news-page-preview <?=($arResult['DETAIL_PICTURE']['SRC']!=''?'':'fix');?>">
          <?=$arResult['~PREVIEW_TEXT'];?>
           </div>
          <?else:?>
          <div style="height: 60px;    clear: both;"></div>
        <?endif;?>
        <div class="block">
          <?
          $clearText = strip_tags($arResult['DETAIL_TEXT'], '<div><p><img><ul><li><a><br><br/>');
          $clearText = preg_replace('/<((^img)[a-z][a-z0-9]*)[^>]*?(\/?)>/i','<$1$3>', $clearText);
          $clearText = preg_replace('/%=upload_url%/','/upload/news_old', $clearText);
          $clearText = trim($clearText);
          ?>
         <?=$clearText;?>
        </div>
      </div>
    </div>
  </div>
</section>