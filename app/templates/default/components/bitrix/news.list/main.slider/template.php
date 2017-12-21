<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>
  <div class="slider-container-main">
    <div class="swiper-container swiper-container--main-header">
      <div class="swiper-wrapper">

        <?foreach($arResult["ITEMS"] as $arItem):?>

          <div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['_EDIT_AREA']);?>">

            <?=CFile::ShowImage($arItem['PREVIEW_PICTURE']);?>
            <?// для полного контроля выводим полностью разметку( из орписания ) ?>
            <?=$arItem['~PREVIEW_TEXT'];?>
          </div>

        <?endforeach;?>

      </div>
    </div>
    <div class="page">
      <div class="swiper-button-next sl-next-white js-sl-main-next"></div>
      <div class="swiper-button-prev sl-prev-white js-sl-main-prev"></div>
    </div>
  </div>
<?endif;?>

