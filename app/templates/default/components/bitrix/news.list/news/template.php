<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>


<div class="block-group">
  <div class="news-content news-content--work" mobile  data-url="<?=$arResult['LIST_PAGE_URL'];?>" id="lazy" data-page="<?=$arResult['NAV_RESULT']->NavPageCount; ?>">
    <?php $first = true; ?>

    <? if(isset($_GET['AJAX_PAGE'])) {
      $first = false; //убираем при подгрузке
      echo '<!--RestartBuffer-->';
    } ?>
  <?foreach($arResult["ITEMS"] as $arItem):?>
    <div class="block coll-4 coll-6-tablet <?=($first?'first':'');?> mw100 item-news">
      <div class="data">
        <table class="data">
          <tbody>
          <tr> <td class="year" style="border-image: initial;"><?=FormatDate('Y',MakeTimeStamp($arItem['ACTIVE_FROM']));?></td>
            <td class="day" style="border-image: initial;"><?=FormatDate('d',MakeTimeStamp($arItem['ACTIVE_FROM']));?></td>
            <td class="month" style="border-image: initial;"><?=FormatDate('F',MakeTimeStamp($arItem['ACTIVE_FROM']));?></td> </tr>
          </tbody>
        </table>
      </div>

      <div class="heading"><a href="<?=$arItem['~DETAIL_PAGE_URL'];?>"><?=$arItem['NAME'];?></a></div>

      <div class="anounce"><?=$arItem['~PREVIEW_TEXT'];?></div>
      <a href="<?=$arItem['~DETAIL_PAGE_URL'];?>" class="btn btn--news" >Подробнее &rarr;</a> </div>
    <?php $first = false;?>
  <?endforeach;?>

    <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>
  </div>

  <!--/news-content--work-->
</div>

<?=$arResult['NAV_STRING'];?>

<div class="group-children-stories">
  <div class="load"><img src="/image/default-2.gif" alt=""></div>
</div>

<?endif;?>