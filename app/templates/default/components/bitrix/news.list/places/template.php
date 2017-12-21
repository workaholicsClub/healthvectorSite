<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
	<? Tools::IncludeModule('form'); ?>
<div class="page" style="overflow: hidden;">
	<div class="content-information-help">

		<form id="places" action="#places" method="get" class="ajax-selects">
			<!--RestartBuffer-->
			<div class="block-group">
				<div class="block coll-5 coll-6-desktop coll-6-tablet mw100 centers-reab-map">
					<div class="heading">Выберите страну:</div>
					<div class="select-centers select-parent">
						<?=CForm::GetDropDownField('COUNTRY', $arResult['SELECT_COUNTRY'], $_REQUEST['form_dropdown_COUNTRY'], ' class="js-select" ');?>
					</div>
				</div>
				<?if (count($arResult['SELECT_CITY']) > 1):?>
					<div class="block coll-5 coll-6-desktop coll-6-tablet mw100 centers-reab-map">
						<div class="heading">Выберите город:</div>
						<div class="select-centers select-parent">
							<?=CForm::GetDropDownField('CITY', $arResult['SELECT_CITY'], $_REQUEST['form_dropdown_CITY'], ' class="js-select" ');?>
						</div>
					</div>
				<?endif?>
			</div>
			<!--RestartBuffer-->
		</form>
	</div> <!--/content-information-help-->

	<?if (count($arResult['ITEMS']) > 0):?>
		<div class="info-list">
			<?foreach($arResult['ITEMS'] as $id => $item):?>
				<div class="item">
					<div class="image">
						<a href="<?=$item['DETAIL_PAGE_URL']?>">
							<img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>" />
						</a>
					</div>
					<div class="desc">
						<a href="<?=$item['DETAIL_PAGE_URL']?>" class="title"><?=$item['NAME']?></a>
						<?=$item['PREVIEW_TEXT']?>
					</div>
					<?if($item['DISPLAY_PROPERTIES']['ADDRESS']['DISPLAY_VALUE']):?>
						<div class="address"><?=$item['DISPLAY_PROPERTIES']['ADDRESS']['DISPLAY_VALUE']?></div>
					<?endif?>
					<?if($item['DISPLAY_PROPERTIES']['PHONE']['DISPLAY_VALUE']):?>
						<div class="phones"><?=$item['DISPLAY_PROPERTIES']['PHONE']['DISPLAY_VALUE']?></div>
					<?endif?>
					<?if($item['DISPLAY_PROPERTIES']['URL']['~VALUE']):?>
						<div class="url">
							<a href="<?=$item['DISPLAY_PROPERTIES']['URL']['~VALUE']?>" rel="nofollow" target="_blank">
								<?=$item['DISPLAY_PROPERTIES']['URL']['~VALUE']?>
							</a>
						</div>
					<?endif?>
				</div>
			<?endforeach;?>
		</div>
	<?else:?>
		Ничего не найдено, измените условия фильтра.
	<?endif;?>
</div>

	<!--<section class="section-contacts-map">
	  <div class="map-content">
		<div class="map map-main js-map" id="map" ></div>
  
	  </div>
	</section>-->


