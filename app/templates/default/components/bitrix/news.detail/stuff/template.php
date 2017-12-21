<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="page">
  <div class="block-group">
    <div class="team-item team-item--cart block coll-3 coll-4-tablet first">
      <div class="pic">
        <?=CFile::ShowImage($arResult['PREVIEW_PICTURE']);?>
        <?if($arResult['PROPERTIES']['ICON']['VALUE']):?>
          <?=CFile::ShowImage($arResult['PROPERTIES']['ICON']['VALUE'],0,0,' class="icon" ');?>
        <?else:?>
          <?=CFile::ShowImage(Config::DEFAULT_ICO_DOC,0,0,' class="icon" ');?>
        <?endif;?>
        <div class="arrow-color"></div>
      </div>
    </div>
    <div class="block coll-9 coll-8-tablet">
      <?if($arResult['PROPERTIES']['POSITION']['VALUE']):?>
        <p><b>Должность:</b> <i><?=$arResult['PROPERTIES']['POSITION']['VALUE'];?></i></p>
      <?endif;?>
      <?if($arResult['PROPERTIES']['SPEC']['VALUE']):?>
        <p><b>Специализация:</b> <i><?=$arResult['PROPERTIES']['SPEC']['VALUE'];?></i></p>
      <?endif;?>
      <?if($arResult['PROPERTIES']['STAGE']['VALUE']):?>
        <p><b>Стаж:</b> <i><?=$arResult['PROPERTIES']['STAGE']['VALUE'];?></i></p>
      <?endif;?>
    </div>
  </div>
  <div class="tabs-cart">
    <ul class="tabs-links">
      <li class="tabs-links-item active">Профессиональные навыки</li>
      <li class="tabs-links-item">Образование</li>
      <li class="tabs-links-item">Характеристика</li>
    </ul>
    <div class="tabs-content">
      <div class="tabs-content-item active">
        <?=$arResult['PROPERTIES']['PROF_SPEC']['~VALUE']['TEXT'];?>
      </div>
      <div class="tabs-content-item">
        <?=$arResult['PROPERTIES']['EDUCATION']['~VALUE']['TEXT'];?>
      </div>
      <div class="tabs-content-item">
        <?=$arResult['PROPERTIES']['CHARACT']['~VALUE']['TEXT'];?>
      </div>
    </div>
  </div>
  <?=$arResult['DETAIL_TEXT'];?>
  <a class="btn" onClick="window.history.back();" href="">Вернуться назад &rarr;</a>
</div>