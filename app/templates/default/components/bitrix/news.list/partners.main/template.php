<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0):?>
    
  <section class="section-partners">
    <div class="figure figure-partners"></div>
    <div class="page">
      <div class="partners-content">
        <h2 class="h2 h2--center">Партнеры</h2>
        <div class="swiper-container swiper-container--scroll-partners">
          <div class="swiper-wrapper">

            <?foreach($arResult["ITEMS"] as $arItem):?>
              <div class="swiper-slide">
                <div class="logo-item">
                  <?if($arItem['PROPERTIES']['SITE_URL']['VALUE'] !=''):?><noindex><a rel="nofollow" href="<?=$arItem['PROPERTIES']['SITE_URL']['VALUE'];?>" target="_blank"><?endif;?>
                    <?=CFile::ShowImage($arItem['PREVIEW_PICTURE']);?>
                  <?if($arItem['PROPERTIES']['SITE_URL']['VALUE'] !=''):?></a></noindex><?endif;?>
                </div>
              </div>
            <?endforeach;?>
          </div>
          <!-- Add Scrollbar -->
          <div class="swiper-scrollbar js-scrollbar-partners"></div>
        </div>
        <a href="<?=$arResult['LIST_PAGE_URL'];?>" class="btn">Все партнеры &rarr;</a>
      </div>
    </div>
  </section>
<?endif;?>