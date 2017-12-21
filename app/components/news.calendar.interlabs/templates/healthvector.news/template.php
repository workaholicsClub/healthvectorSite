<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>




        <div class="calendar-head">
          <?=$arResult["TITLE"]?>
            <?if($arResult["PREV_MONTH_URL"]):?>
              <a class="calendar-head-prev " href="<?=$arResult["PREV_MONTH_URL"]?>" title="<?=$arResult["PREV_MONTH_URL_TITLE"]?>"></a>
            <?endif?>
          <?if($arResult["NEXT_MONTH_URL"]):?>
            <a class="calendar-head-next"  href="<?=$arResult["NEXT_MONTH_URL"]?>" title="<?=$arResult["NEXT_MONTH_URL_TITLE"]?>"></a>
          <?endif?>
        </div>
        <div class="calendar-table">
          <table>
            <thead>
            <tr>
              <?foreach($arResult["WEEK_DAYS"] as $WDay):?>
                <th ><?=$WDay["SHORT"]?></th>
              <?endforeach?>
            </tr>
            </thead>
            <tbody>
            <?foreach($arResult["MONTH"] as $arWeek):?>
              <tr>
                <?foreach($arWeek as $arDay):?>
                  <td  class='<?=$arDay["td_class"]?>  <?=count($arDay["events"])>0?'post':'';?>' >
                    <?if(count($arDay["events"])>0):?>
                      <a title="<?=$arDay["events"][0]["title"]?>" href="<?=$arDay["events"][0]["url"]?> " onClick="true"; class="<?=$arDay["day_class"]?>"><?=$arDay["day"]?></a>
                    <?else:?>
                      <?=$arDay["day"]?>
                    <?endif;?>
                  </td>
                <?endforeach?>
              </tr >
            <?endforeach?>

            </tbody>
          </table>
        </div>

   
