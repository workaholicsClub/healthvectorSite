<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult)) {
global $APPLICATION;
$curPage = $APPLICATION->GetCurPage();
$menuArray = BitrixAdapterMenu::plainToArray($arResult);
$i = 0;
$services = array();
?>

  <div class="page">

    <div class="sitemap">
   <?foreach ($menuArray as $i => $menu):?>
      <ul class="main-ul">
        <li><a href="<?=$menu['LINK'];?>"><?=$menu['TEXT'];?></a></li>

        <?if(count($menu['CHILDS']) > 0):?>
        <li>
          <ul>
            <?foreach ($menu['CHILDS'] as $iS => $submenu):?>
              <li>
                <a href="<?=$submenu['LINK']?>"><?=$submenu['TEXT'];?></a>
              </li>
            <?endforeach;?>
          </ul>
        </li>
        <?endif;?>

      </ul>
    <?endforeach;?>

    </div>

  </div>


<? } ?>