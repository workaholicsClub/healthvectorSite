<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div class="overlay"></div>
<div class="calendar-wrapper">
    <div class="block-calendar">
      <div class="calendar-head">
        <div class="wrap-in-calendar">
          <?if($arResult["PREV_MONTH_URL"]):?>
              <a class="calendar-prev" href="<?=$arResult["PREV_MONTH_URL"]?>" title="<?=$arResult["PREV_MONTH_URL_TITLE"]?>"></a>
          <?endif?>
          <span class="cur-month"><?=$arResult["TITLE"]?></span>
          <?if($arResult["NEXT_MONTH_URL"]):?>
              <a class="calendar-next"  href="<?=$arResult["NEXT_MONTH_URL"]?>" title="<?=$arResult["NEXT_MONTH_URL_TITLE"]?>"></a>
          <?endif?>
        </div>
      </div>
      <div class="calendar-head-days">
        <div class="wrap-in-calendar">
          <table>
            <tbody>
              <tr align="center">
                <?foreach($arResult["WEEK_DAYS"] as $WDay):?>
                  <td  class='NewsCalHeader'><?=$WDay["SHORT"]?></td>
                <?endforeach?>
              </tr >
            </tbody>
          </table>
         </div>
      </div>
      <div class="calendar--content js-calendar-table">
        <div class="wrap-in-calendar">
        <table>
          <tbody>
          <?foreach($arResult["MONTH"] as $arWeek):?>
          <tr align="center">
            <?foreach($arWeek as $arDay):?>
            <td  class='<?=$arDay["td_class"]?>  <?=count($arDay["events"])>0?'day-news':'';?>' >
              <?if(count($arDay["events"])>0):?>
                <a title="<?=$arDay["events"][0]["title"]?>" href="<?=$arDay["events"][0]["url"]?> " onClick="true"; class="<?=$arDay["day_class"]?>"><?=$arDay["day"]?></a>
              <?else:?>
                <span class="<?=$arDay["day_class"]?>"><?=$arDay["day"]?></span>
              <?endif;?>
            </td>
            <?endforeach?>
          </tr >
          <?endforeach?>
          </tbody>
        </table>
          </div>
      </div>
    </div>
</div>
