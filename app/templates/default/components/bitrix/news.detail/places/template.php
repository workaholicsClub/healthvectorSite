<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//echo "<pre>"; print_r($arResult); echo "</pre>";
?>
<div class="page">
	<div class="list-detail">
		<div class="image">
			<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>"/>
		</div>
		<div class="desc">
			<b>Как связаться:</b>
			<div class="phones"><?=$arResult['DISPLAY_PROPERTIES']['PHONE']['DISPLAY_VALUE']?></div>
			<div class="url">
				<a href="<?=$arResult['DISPLAY_PROPERTIES']['URL']['~VALUE']?>" rel="nofollow" target="_blank">
					<?=$arResult['DISPLAY_PROPERTIES']['URL']['~VALUE']?>
				</a>
			</div>
			<div class="address"><?=$arResult['DISPLAY_PROPERTIES']['ADDRESS']['DISPLAY_VALUE']?></div>
		</div>
		<h2><?=$arResult["NAME"]?></h2>
		<?=$arResult["DETAIL_TEXT"]?><br>
		<a href="<?=$arResult['LIST_PAGE_URL']?>">Назад к списку</a>
	</div>
</div>