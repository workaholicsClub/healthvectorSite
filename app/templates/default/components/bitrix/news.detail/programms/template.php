<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="content-information-help">
   <?=$arResult['DETAIL_TEXT'];?>
</div> <!--/practic-address-->


<?if(sizeof($arResult['ADD_LINKS'])>0):?>
  <div class="content-information-help">
    <h2>Литература и полезные ссылки</h2>
  </div> <!--/content-information-help-->
  <section class="section-articles section-articles--page">
    <?foreach ($arResult['ADD_LINKS'] as $link):?>
    <div class="wrap-art">
      <div class="pic-articles">
        <?if($link['PREVIEW_PICTURE']):?>
          <?=CFile::ShowImage($link['PREVIEW_PICTURE']);?>
        <?else:?>
          <?=CFile::ShowImage(Config::DEFAULT_PIC_ADD_LINKS);?>
        <?endif;?>
        <img class="icon" src="/image/icon-art-inform.png" alt="">
        <div class="arrow-art"></div>
      </div>
      <div class="group-descript">
        <div class="heading"><?=$link['NAME'];?></div>
        <a href="<?=$link['PROPERTY_INFO_URL_VALUE'];?>" target="_blank" class="btn btn--articles">Подробнее →</a>
      </div>
    </div>
    <?endforeach;?>
  </section>
<?endif;?>
<?=$arResult['PROPERTIES']['TEXT_IN_END']['~VALUE']['TEXT'];?>
