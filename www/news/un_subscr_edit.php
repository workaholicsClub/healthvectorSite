<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписка на новости");
?>
  <div class="page"> 
  <h3>Подписка была отменена! </h3>
  <div class="hide" ><?$APPLICATION->IncludeComponent(
    "bitrix:subscribe.edit",
    "",
    Array(
      "SHOW_HIDDEN" => "N",
      "ALLOW_ANONYMOUS" => "Y",
      "SHOW_AUTH_LINKS" => "Y",
      "CACHE_TIME" => "3600",
      "SET_TITLE" => "Y"
    )
  );?>
  </div  >
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>