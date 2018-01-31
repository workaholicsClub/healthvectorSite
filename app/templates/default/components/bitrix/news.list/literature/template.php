<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (count($arResult['ITEMS']) > 0): ?>

	<section class="section-articles" data-fix="100" data-url="<?=$arResult['LIST_PAGE_URL'];?>" id="lazy" data-page="<?=$arResult['NAV_RESULT']->NavPageCount;?>">
		<table>
		<? if (isset($_GET['AJAX_PAGE'])) echo '<!--RestartBuffer-->'; ?>
		<? foreach ($arResult["ITEMS"] as $arItem): ?>
			<tr>
				<?if($arItem['PREVIEW_PICTURE']['SRC']):?>
					<td>
						<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
					</td>
				<?endif?>
				<td <?if(empty($arItem['PREVIEW_PICTURE']['SRC'])):?> rowspan="2"<?endif?>>
					<h3><?=$arItem['NAME']?></h3>
					<?=$arItem['PREVIEW_TEXT']?>
					<div class="links">
						<a href="<?=$arItem['DISPLAY_PROPERTIES']['DOCUMENT']['FILE_VALUE']['SRC']?>">Скачать</a>
						<a href="https://docs.google.com/viewer?url=https://<?=SITE_SERVER_NAME.$arItem['DISPLAY_PROPERTIES']['DOCUMENT']['FILE_VALUE']['SRC']?>" rel="nofollow" target="_blank">Читать</a>
					</div>
				</td>
			</tr>
		<? endforeach; ?>
		<? if (isset($_GET['AJAX_PAGE'])) echo '<!--RestartBuffer-->'; ?>
		</table>
	</section>
	<div class="load"><img src="/image/default-2.gif" alt=""></div>
<? endif; ?>


