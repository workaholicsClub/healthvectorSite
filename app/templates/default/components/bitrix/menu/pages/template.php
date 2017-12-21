<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult) && !(defined('ERROR_404') && ERROR_404 == 'Y')) {
  global $APPLICATION;
  $curPage = $APPLICATION->GetCurPage();

  $menuArray = BitrixAdapterMenu::plainToArray($arResult);

  ?>
  <div class="page">
    <div class="category-page-menu">
      <ul>
        <?foreach($menuArray as $item):?>
          <li>
            <a class="<?=$item['SELECTED'] ? 'active' : null;?>"  href="<?=$item['LINK']?>"><?=$item['TEXT'];?></a>
            <?if(count($item['CHILDS']) > 0):?>
              <ul class="submenu">
                <?foreach ($item['CHILDS'] as $i=> $child):?>
                  <li>
                    <a class="<?=$child['SELECTED'] ? 'active' : null;?>" href="<?=$child['LINK']?>"><?=$child['TEXT'];?></a>
                  </li>
                <?endforeach;?>
              </ul>
            <?endif;?>
          </li>
        <?endforeach;?>
      </ul>
    </div>
    <?if(!preg_match('#^/soc_life/(ruls_([^\?].+)/)?(\?.*)?$#',$curPage)
        && !preg_match('#^/treatment/pitanie/(([^\?].+)/)?(\?.*)?$#',$curPage)
        && !preg_match('#^/helpful_info/programms/(([^\?].+)/)?(\?.*)?$#',$curPage)
    ):?>
    <h2><?=$APPLICATION->ShowProperty('h2');?></h2>
    <?endif;?>
  </div>
  <!-- page menu -->
<?php } ?>



