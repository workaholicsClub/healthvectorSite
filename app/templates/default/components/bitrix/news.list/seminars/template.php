<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

  <?php Tools::IncludeModule('form'); ?>
  <div class="characteristics-content">
    <div class="block-table-seminars">
      <div class="head">
        <?php
        // Даже если month = 31 дню нам не важно на какой день попадет главное для нас смесяц
        $dateBefore = FormatDate("Y-m", strtotime($_REQUEST['DATE'].'-01 -1 month'));
        $dateAfter = FormatDate("Y-m", strtotime($_REQUEST['DATE'].'-01 +1 month'));


        ?>
        <a class="arrow arrow-l" href="<?=$arResult['LIST_PAGE_URL'].'?DATE='.$dateBefore;?>"><img src="/image/calendar-arrows-left.png" alt=""></a>
        <?=FormatDate("Y, F", strtotime($_REQUEST['DATE'].'-01'));?>
        <a class="arrow arrow-r" href="<?=$arResult['LIST_PAGE_URL'].'?DATE='.$dateAfter;?>"><img src="/image/calendar-arrows-right.png" alt=""></a>
      </div>
      <div class="table table--head">
        <div class="cell">дата</div>
        <div class="cell select-parent select-table ">
          <?=CForm::GetDropDownField('AREA',$arResult['sCity'],$_REQUEST['form_dropdown_AREA'],' class=" js-select-pager-table"');?>
        </div>
        <div class="cell cell-tems">тема</div>
        <div class="cell">время</div>
        <div class="cell">условия участия</div>
      </div>

      <div class="select-region-mob select-parent select-table">
        <?=CForm::GetDropDownField('AREA',$arResult['sCity'],$_REQUEST['form_dropdown_AREA'],' class=" js-select-pager-table"');?>
      </div>
      
      <?if(count($arResult['ITEMS'])>0):?>
       <div class="wrap-cont-table">
        <?foreach($arResult["ITEMS"] as $arItem):?>
          <div class="table js-row" data-city="<?=$arItem['DISPLAY_PROPERTIES']['CITY']['VALUE'];?>">
            <div data-label="дата" class="cell"><?=FormatDate("d.m.Y", MakeTimeStamp($arItem["ACTIVE_FROM"]));?><br><?=FormatDate("l", MakeTimeStamp($arItem["ACTIVE_FROM"]));?></div>
            <div data-label="город" class="cell"><?=$arItem['DISPLAY_PROPERTIES']['CITY']['DISPLAY_VALUE'];?></div>
            <div data-label="тема" class="cell cell-tems">
              <div class="name-sem">
                <b><?=$arItem['NAME'];?></b><br>
                <p><?=$arItem['PROPERTIES']['AUTHOR']['VALUE'];?></p>
                <a href="<?=$arItem['DETAIL_PAGE_URL'];?>">Подробнее &rarr;</a>
              </div>
            </div>
            <div data-label="время" class="cell"><?=FormatDate("H", MakeTimeStamp($arItem["ACTIVE_FROM"]));?><sup><?=FormatDate("i", MakeTimeStamp($arItem["ACTIVE_FROM"]));?></sup> &mdash; <?=FormatDate("H", MakeTimeStamp($arItem["ACTIVE_TO"]));?><sup><?=FormatDate("i", MakeTimeStamp($arItem["ACTIVE_TO"]));?></sup></div>
            <div data-label="условия участия" class="cell"><?=$arItem['PROPERTIES']['RULES']['VALUE'];?></div>
          </div>
        <?endforeach;?>
        </div>
      <?else:?>
          <div class="table"  >
            <div class="cell cell-tems">
              <b>В данном месяце семинаров не предвидится!</b>
            </div>
          </div>
      <?endif;?>
    </div>
  </div> <!--/characteristics-content-->
