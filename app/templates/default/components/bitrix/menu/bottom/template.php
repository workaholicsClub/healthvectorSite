<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)) {
  global $APPLICATION;
  $curPage = $APPLICATION->GetCurPage();

  $menuArray = BitrixAdapterMenu::plainToArray($arResult);
  ?>


      <ul class="menu bottom">
        <?php $first = true; ?>
        <?foreach($menuArray as $item):?>
          <li>
            <a class="<?=$item['SELECTED'] ? 'current' : null;?>  <?=$first?'first-item':''; $first = false;?>"  href="<?=$item['LINK']?>"><?=$item['TEXT'];?></a>
          </li>
        <?endforeach;?>
      </ul>
<?php } ?>



