<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0):?>

  <section class="section-test">
  <div class="figure-test"></div>
  <div class="page">
    <div class="block-group">
      <div class="block coll-8 first mw100">
        <div class="test-content-left">
          <h2 class="h2">Пройти тест</h2>
          <div class="swiper-container swiper-container--main-test">
            <div class="swiper-wrapper">

              <?foreach($arResult["ITEMS"] as $arItem):?>
                <div class="swiper-slide">
                  <div class="subheading"><?=$arItem['NAME'];?></div>
                  <p class="text-test"><?=$arItem['~PREVIEW_TEXT'];?></p>
                  <p class="start-test">Если готовы — нажмите «Начать тест»</p>
                  <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="btn btn--red">Начать тест &rarr;</a>
                </div>
              <?endforeach;?>

            </div>
            <div class="swiper-button-next sl-next-black js-sl-test-next"></div>
            <div class="swiper-button-prev sl-prev-black js-sl-test-prev"></div>
          </div> <!--/swiper-container--main-test-->
        </div> <!--/test-content-left-->
      </div>
      <div class="block coll-4 mw100">
        <div class="test-content-right">
          <div class="link-all-test"><a href="<?=$arResult['LIST_PAGE_URL'];?>">Другие тесты данной категории</a></div>
          <img class="img-test" src="/image/pic-test.jpg" alt="">
        </div>
      </div>
    </div>
  </div>
  <!--<div class="figure-test figure-test--bottom"></div>-->
</section>

<?endif;?>