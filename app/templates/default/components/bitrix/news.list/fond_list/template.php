<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>

<div class="page">
  <div class="group-fonds">
    <div class="block-group"  data-url="<?=$arResult['LIST_PAGE_URL'];?>" id="lazy" data-page="<?=$arResult['NAV_RESULT']->NavPageCount; ?>">
      <? $first = true; ?>
      <?
      if(isset($_GET['AJAX_PAGE'])) {
        $first = false;
        echo '<!--RestartBuffer-->';
      }
      ?>
      <?foreach($arResult["ITEMS"] as $arItem):?>

        <div class="block coll-3 <?=($first?' first ':'');?> item-fond coll-4-tablet mw100">
          <div class="item-fond-img">
            <?=CFile::ShowImage($arItem['PREVIEW_PICTURE']);?>
          </div>
          <div class="item-fond-text">
            <div class="name"><?=$arItem['~NAME'];?></div>
            <div class="website">

              <?if($arItem['PROPERTIES']['URL']['VALUE'] != ''):?>
                <a rel="nofollow" target="_blank" href="<?=$arItem['PROPERTIES']['URL']['VALUE'];?>"><?=$arItem['PROPERTIES']['URL']['VALUE'];?></a>
              <?endif;?>

            </div>
          </div>
        </div>
        <? $first = false; ?>
      <?endforeach;?>

      <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>
    </div>
  </div> <!--/group-fonds-->
  <div class="group-fonds">
    <div class="load"><img src="/image/default-2.gif" alt=""></div>
  </div>
</div>
<?endif;?>

