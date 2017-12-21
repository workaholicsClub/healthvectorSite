<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>
  <?php Tools::IncludeModule('form'); ?>
  <div class="content-information-help">
    <h3>Выберите интересующую методику реабилитации:</h3>
    <div class="select-parent">
      <?=CForm::GetDropDownField("PROG",$arResult['SELECT'],$_REQUEST['ELEMENT_CODE'], ' class="js-select-pager" data-url="'.$arResult['LIST_PAGE_URL'].'"');?>
    </div>
  </div>
<?endif;?>

