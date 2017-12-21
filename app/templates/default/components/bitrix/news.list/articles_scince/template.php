<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>

  <section class="section-articles section-articles--page" data-fix="100" data-url="<?=$arResult['LIST_PAGE_URL'];?>" id="lazy" data-page="<?=$arResult['NAV_RESULT']->NavPageCount; ?>">

    <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
      <div class="wrap-art" >
        <div class="pic-articles">
          <?=CFile::ShowImage($arItem['PREVIEW_PICTURE']);?>
          <?//=CFile::ShowImage($arItem['PROPERTIES']['ICON']['VALUE'] , 0,0,' class="icon"');?>
          <!--<div class="arrow-art"></div>-->
        </div>
        <div class="group-descript">
          <div class="heading"><?=$arItem['~NAME'];?></div>
          <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="btn btn--articles">Подробнее &rarr;</a>
          <span class="art-date"><?=FormatDate('d.m.Y',MakeTimeStamp($arItem['ACTIVE_FROM']));?></span>
        </div>
      </div>
    <?endforeach;?>
    <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>
  </section>
  <div class="load"><img src="/image/default-2.gif" alt=""></div>
<?endif;?>


