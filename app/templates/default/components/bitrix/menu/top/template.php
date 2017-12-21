<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)) {
  global $APPLICATION;
  $curPage = $APPLICATION->GetCurPage();

  $menuArray = BitrixAdapterMenu::plainToArray($arResult);
  ?>


  <div class="top-menu">
    <div class="page">
      <ul class="menu">
        <?php $first = true; $i = 1; ?>

        <?foreach($menuArray as $item):?>

          <li>
            <input type="checkbox" id="i<?=$i;?>" <?=$item['SELECTED'] ? 'checked' : null;?> >
            <a class="<?=$item['SELECTED'] ? 'current' : null;?>  <?=$first?'first-item':''; $first = false;?>"  href="<?=$item['LINK']?>"><?=$item['TEXT'];?></a>
            <label class="i" for="i<?=$i;?>"></label>
            <?if(count($item['CHILDS']) > 0):?>
                <ul class="submenu">
                  <?foreach ($item['CHILDS'] as $i=> $child):?>
                    <li>
                      <a class="<?=$child['SELECTED'] ? 'current' : null;?>" href="<?=$child['LINK']?>"><?=$child['TEXT'];?></a>
                    </li>
                  <?endforeach;?>
                </ul>
            <?endif;?>
          </li>
          <?$i++;?>
        <?endforeach;?>
      </ul>
    </div>
  </div> <!--/top-menu-->
<?php } ?>



