<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>
<div class="page" >
  <div class="group-children-stories" data-url="<?=$arResult['LIST_PAGE_URL'];?>" id="lazy" data-page="<?=$arResult['NAV_RESULT']->NavPageCount; ?>">

    <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
      <div class="stories-item">
        <div class="children-stories-photo mw100">
          <?=CFile::ShowImage($arItem['PREVIEW_PICTURE']);?>
          <img class="icon" src="/image/star-icon-arrow.png" alt="">
          <div class="arrow-art"></div>
        </div>
        <div class="stories-content mw100">
          <div class="name"><?=$arItem['NAME'];?></div>
          <div class="small-text"><?=$arItem['PREVIEW_TEXT'];?></div>
          <a class="more" href="<?=$arItem['DETAIL_PAGE_URL'];?>">Подробнее &rarr;</a>
        </div>
      </div>
    <?endforeach;?>
    <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>
  </div> <!--/group-children-stories-->
  <div class="group-children-stories">
    <div class="load"><img src="/image/default-2.gif" alt=""></div>
  </div>
</div>
<?endif;?>


