<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>
  <?php //Tools::IncludeModule('form'); ?>
	<div class="category-page-menu">
		<h3>Выберите интересующую методику реабилитации:</h3>
		<ul>
			<?foreach( $arResult['ITEMS'] as $item):?>
				<li>
					<a <?if($_REQUEST["ELEMENT_CODE"] == $item['CODE']):?> class="active"<?endif?> href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
				</li>
			<?endforeach;?>
		</ul>
	</div>
<?endif;?>

