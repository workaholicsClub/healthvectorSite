<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//echo "<pre>"; print_r($arResult); echo "</pre>";
?>
<div class="section-news " id="<?=Tools::GetIBlockElementEditLink($arResult['ID'], $arResult['IBLOCK_ID'])?>">
	<div class="news-content news-content--work">
		<div class="page">
			<? if ($arResult['PREVIEW_PICTURE'] != ''): ?>
				<div class="pic-text-fl">
					<?=CFile::ShowImage($arResult['PREVIEW_PICTURE']);?>
				</div>
			<? endif; ?>
			<?=$arResult['~DETAIL_TEXT'];?>
			<a href="<?=$arResult["LIST_PAGE_URL"].htmlentities($_REQUEST['SECTION_CODE'])."/"?>" class="btn">&larr; Вернуться назад </a>
		</div>
	</div>
</div>