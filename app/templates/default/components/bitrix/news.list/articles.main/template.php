<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0):?>
  <div class="swiper-container swiper-container--main-articles">
    <div class="swiper-wrapper">


      <?foreach($arResult["ITEMS"] as $arItem):?>
        <div class="swiper-slide">
          <div class="wrap-art">
            <div class="pic-articles">
              <?=CFile::ShowImage($arItem['PREVIEW_PICTURE']);?>
            </div>
            <div class="heading"><?=$arItem['NAME'];?></div>
            <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="btn btn--articles">Подробнее &rarr;</a>
            <span class="art-date"><?=FormatDate('d.m.Y',MakeTimeStamp($arItem['ACTIVE_FROM']));?></span>
          </div>
        </div>
      <?endforeach;?>
      
    </div>
  </div> <!--/swiper-container--main-articles-->
  <div class="swiper-button-next sl-next-white tablet-art js-sl-articles-next"></div>
  <div class="swiper-button-prev sl-prev-white tablet-art js-sl-articles-prev"></div>
  <a href="<?=$arResult['LIST_PAGE_URL'];?>" class="btn btn--articles-white">Все статьи &rarr;</a>

<?endif;?>