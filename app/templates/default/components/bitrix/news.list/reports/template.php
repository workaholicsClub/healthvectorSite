<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>
  <div class="report-accordeon">

    <?foreach($arResult["ITEMS"] as $arItem):?>
      <section class="nano report-accordeon-item" id="<?=$arItem['_EDIT_AREA']?>">
        <div class="title_block"><?=$arItem['~NAME'];?></div>
        <div class="nano-content info">
          <?if(count($arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'])>0):?>
            <?if(isset($arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['ID'])):
              $file = $arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'];
              ?>
              <div class="doc doc--<?=Tools::GetFileTypeIconClass($file['SRC']);?>"><a title="<?=$file['NAME'];?>" href="<?=$file['SRC']?>" download>Скачать</a><br>(<?=Tools::humanFileSize($file["FILE_SIZE"])?>)</div>
            <?else:?>
              <?foreach ($arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'] as $file):?>
                <div class="doc doc--<?=Tools::GetFileTypeIconClass($file['SRC']);?>"><a title="<?=$file['NAME'];?>" href="<?=$file['SRC']?>" download>Скачать</a><br>(<?=Tools::humanFileSize($file["FILE_SIZE"])?>)</div>
              <?endforeach;?>
            <?endif;?>
          <?endif;?>
        </div>
      </section>
    <?endforeach;?>
  </div> <!--/report-accordeon-->
<?endif;?>

