<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0):?>   
    <div class="page">
      <div class="partners-content-page">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <div class="logo-item">
              <?if($arItem['PROPERTIES']['SITE_URL']['VALUE'] !=''):?><noindex><a rel="nofollow" href="<?=$arItem['PROPERTIES']['SITE_URL']['VALUE'];?>" target="_blank"><?endif;?>
                <?=CFile::ShowImage($arItem['PREVIEW_PICTURE']);?>
              <?if($arItem['PROPERTIES']['SITE_URL']['VALUE'] !=''):?></a></noindex><?endif;?>
            </div>
        <?endforeach;?>
      </div>
    </div>
<?endif;?>