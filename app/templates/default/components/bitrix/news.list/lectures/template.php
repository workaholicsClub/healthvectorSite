<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>

  <div class="characteristics-content" >
    <section class="section-news section-news--lectures">
      <div class="news-content news-content--work">
        <div class="block-group"  mobile  data-url="<?=$arResult['LIST_PAGE_URL'];?>" id="lazy" data-page="<?=$arResult['NAV_RESULT']->NavPageCount; ?>">
            <div class="block coll-4 coll-6-tablet mw100 item-news">
              <div class="calendar-news">
                <div class="btn-calendar">Календарь</div>
                <div class="wrapper-calendar">
                  <div class="calendar-block">
                    <div class="calendar-content js-calc-content">
                      <?//так как вызов аякс мода не работает внутри других компонентов( ну я по крайней мере не вкурсе как это сделать )
                      // будет все обычнми ссылками + спасибо за подгрузку на мобиле дизайнерам
                      ?>
                      <?$APPLICATION->IncludeComponent(
                        "interlabs:news.calendar.interlabs",
                        "healthvector.news",
                        Array(
                          "FILTER_NAME" => "calendar",
                          "LIST_URL" => "/experts_cooperation/lectures/",
                          "AJAX_MODE" => "Y",
                          "IBLOCK_TYPE" => "experts_com",
                          "IBLOCK_ID" => "17",
                          "MONTH_VAR_NAME" => "month",
                          "YEAR_VAR_NAME" => "year",
                          "WEEK_START" => "1",
                          "DATE_FIELD" => "DATE_ACTIVE_FROM",
                          "TYPE" => "EVENTS",
                          "SHOW_YEAR" => "Y",
                          "SHOW_TIME" => "Y",
                          "TITLE_LEN" => "0",
                          "SET_TITLE" => "N",
                          "SHOW_CURRENT_DATE" => "Y",
                          "SHOW_MONTH_LIST" => "Y",
                          "NEWS_COUNT" => "0",
                          "DETAIL_URL" => "",
                          "CACHE_TYPE" => "N",
                          "CACHE_TIME" => "36000000",
                          "AJAX_OPTION_JUMP" => "N",
                          "AJAX_OPTION_STYLE" => "Y",
                          "AJAX_OPTION_HISTORY" => "N"
                        )
                      );?>
                    </div>
                  </div> <!--/calendar-block-->
                </div>
              </div> <!--/calendar-news-->
            </div>

          <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>

            <?foreach($arResult["ITEMS"] as $arItem):?>
              <div class="block coll-4 coll-6-tablet mw100 item-news">
                <div class="data">
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
                <div class="address">
                  <?=$arItem['PROPERTIES']['ADDRESS']['VALUE'];?>
                </div>
                <div class="heading"><?=$arItem['NAME'];?></div>
                <div class="anounce"><?=$arItem['PREVIEW_TEXT'];?></div>
                <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="btn btn--news">Подробнее &rarr;</a>
              </div>
            <?endforeach;?>


          <? if(isset($_GET['AJAX_PAGE'])) { echo '<!--RestartBuffer-->'; } ?>
        </div>
      </div>
    </section>
    <?=$arResult['NAV_STRING'];?>
    <div class="load"><img src="/image/default-2.gif" alt=""></div>
  </div> <!--/characteristics-content-->






<?endif;?>