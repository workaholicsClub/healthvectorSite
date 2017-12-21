<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section class="section-news">
  <div class="page">
    <div class="news-content">
      <h2 class="h2 h2--center">Новости</h2>
      <div class="swiper-container swiper-container--main-news">
        <div class="swiper-wrapper">

          <?foreach($arResult["ITEMS"] as $arItem):?>
          <div class="swiper-slide" id="<?=$arItem['_EDIT_AREA'];?>">
            <div class="data">
              <table class="data">
                <tr> <td class="year" style="border-image: initial;"><?=FormatDate('Y',MakeTimeStamp($arItem['ACTIVE_FROM']));?></td>
                  <td class="day" style="border-image: initial;"><?=FormatDate('d',MakeTimeStamp($arItem['ACTIVE_FROM']));?></td>
                  <td class="month" style="border-image: initial;"><?=FormatDate('F',MakeTimeStamp($arItem['ACTIVE_FROM']));?></td>
                </tr>
              </table>
            </div>
            <div class="heading"><a href="<?=$arItem['DETAIL_PAGE_URL'];?>"> <?=$arItem['NAME'];?></a></div>
            <div class="anounce"><?=TruncateText($arItem['~PREVIEW_TEXT'], 150);?></div>
            <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="btn btn--news">Подробнее &rarr;</a>
          </div>


          <?endforeach;?>
        </div>
        <div class="swiper-button-next sl-next-black js-sl-news-next"></div>
        <div class="swiper-button-prev sl-prev-black js-sl-news-prev"></div>
      </div> <!--/swiper-container--main-news-->
      <div class="subscribe-news">
        <form action="/ajax/subscribe.news.php" class="ajaxform">
          <input class="subscribe-field" name="email" placeholder="E-mail для подписки на новости" type="text">
          <input class="subscribe-submit" value="" type="submit">
        </form>
      </div>
      <a href="<?=$arResult['LIST_PAGE_URL'];?>" class="btn btn--all-news">Все новости &rarr;</a>
    </div>
  </div>
</section>
