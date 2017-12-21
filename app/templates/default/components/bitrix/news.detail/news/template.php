<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="section-news " id="<?=Tools::GetIBlockElementEditLink( $arResult['ID'], $arResult['IBLOCK_ID']) ?>">
  <div class="news-content news-content--work">
    <div class="page">
      <?if($arResult['PREVIEW_PICTURE']!=''):?>
        <div class="pic-text-fl">
          <?=CFile::ShowImage($arResult['PREVIEW_PICTURE']);?>
        </div>
      <?endif;?>
      <table class="data">
        <tbody>
        <tr>
          <td class="year"><?=FormatDate('Y',MakeTimeStamp($arResult['ACTIVE_FROM']));?></td>
          <td class="day"><?=FormatDate('d',MakeTimeStamp($arResult['ACTIVE_FROM']));?></td>
          <td class="month"><?=FormatDate('F',MakeTimeStamp($arResult['ACTIVE_FROM']));?></td>
        </tr>
        </tbody>
      </table>
      <?=$arResult['~DETAIL_TEXT'];?>
      <a href="" class="btn" onClick="window.history.back()">Вернуться назад →</a>
    </div>
  </div>
</div>