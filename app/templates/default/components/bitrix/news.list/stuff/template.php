<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>



  <div class="group-team-expert">
    <div class="block-group"  mobile  data-url="<?=$arResult['LIST_PAGE_URL'];?>" id="lazy" data-page="<?=$arResult['NAV_RESULT']->NavPageCount; ?>">
      <?php $first = true; ?>

      <? if(isset($_GET['AJAX_PAGE'])) {
        $first = false; //убираем при подгрузке
        echo '<!--RestartBuffer-->';
      } ?>
      <?foreach($arResult["ITEMS"] as $arItem):?>
        <div class="team-item block coll-3 coll-4-tablet <?=($first?'first':''); $first=false;?>">
          <div class="pic">
            <?=CFile::ShowImage($arItem['PREVIEW_PICTURE']);?>
            <?if($arItem['PROPERTIES']['ICON']['VALUE']):?>
              <?=CFile::ShowImage($arItem['PROPERTIES']['ICON']['VALUE'],0,0,' class="icon" ');?>
            <?else:?>
              <?=CFile::ShowImage(Config::DEFAULT_ICO_DOC,0,0,' class="icon" ');?>
            <?endif;?>
            <div class="arrow-color"></div>
          </div>
          <div class="name"><?=$arItem['NAME'];?></div>
          <div class="status"><?=$arItem['PROPERTIES']['POSITION']['VALUE'];?></div>
          <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="btn btn--team">Резюме &rarr;</a>
        </div>
      <?endforeach;?>
      <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>
    </div>
  </div> <!--/group-team-expert-->

  <?=$arResult['NAV_STRING'];?>
  <div class="load"><img src="/image/default-2.gif" alt=""></div>
<?endif;?>