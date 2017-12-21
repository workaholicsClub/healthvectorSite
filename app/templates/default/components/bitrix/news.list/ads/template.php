<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>

  <div class="society-advert-group society-action-group">
    <div class="block-group"  data-url="<?=$arResult['LIST_PAGE_URL'];?>" id="lazy" data-page="<?=$arResult['NAV_RESULT']->NavPageCount; ?>">

      <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <div class="block coll-6 advert-item mw100">
              <div class="top-wrap">
                <div class="date-block">
                  <table class="data">
                    <tbody>
                    <tr>
                      <td class="year"><?=FormatDate('Y',MakeTimeStamp($arItem['ACTIVE_FROM']));?></td>
                      <td class="day"><?=FormatDate('d',MakeTimeStamp($arItem['ACTIVE_FROM']));?></td>
                      <td class="month"><?=FormatDate('F',MakeTimeStamp($arItem['ACTIVE_FROM']));?></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class="city"><?=$arItem['PROPERTIES']['PLACE']['VALUE'];?></div>
              </div>
              <div class="name"><?=$arItem['NAME'];?></div>
              <div class="small-text"><?=$arItem['~PREVIEW_TEXT'];?></div>
              <a class="more" href="<?=$arItem['DETAIL_PAGE_URL'];?>">Подробнее &rarr;</a>
            </div>

        <?endforeach;?>
      <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>
    </div>
  </div>

  <div class="load"><img src="/image/default-2.gif" alt=""></div>
<?endif;?>