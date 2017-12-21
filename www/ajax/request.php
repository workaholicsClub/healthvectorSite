<?php
ob_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/tools.php");
$tmp = ob_get_contents();
ob_end_clean();


if(!preg_match('/^[a-zA-Zа-яА-Я0-9-].*$/', $_POST['FIO'])){
  $alert = 'Укажите Ваше имя!';
  Tools::JSONResponse(array(1, $alert));
}
if(!preg_match('/^[a-zA-Zа-яА-Я0-9-()\+].*$/', $_POST['PHONE'])){
  $alert = 'Укажите Ваш контактный телефон!';
  Tools::JSONResponse(array(1, $alert));
}
if(!preg_match('/^[0-9A-Za-z._-]+@([0-9a-z_-]+\.)+[a-z]{2,4}$/', $_POST['EMAIL'])){
  $alert = 'Укажите правильный e-mail!';
  Tools::JSONResponse(array(1, $alert));
}

CModule::IncludeModule("iblock");
$el = new CIBlockElement;

$PROP = array();
$PROP['PHONE'] = $_POST['PHONE'];
$PROP['FIO'] = $_POST['FIO'];
$PROP['EMAIL'] = $_POST['EMAIL'];
//$PROP['MESSAGE'] = array('VALUE'=>array('TYPE'=>'TEXT','TEXT'=>$_POST['TEXT']));

$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  "IBLOCK_ID"      => Config::IBLOCK_REQUESTS,
  "PROPERTY_VALUES"=> $PROP,
  "PREVIEW_TEXT" => $_POST['TEXT'],
  "ACTIVE"         => "N",           // активен
  "NAME"           => "Запрос 'Сделать запрос' - ".$_POST['FIO']
);

if($PRODUCT_ID = $el->Add($arLoadProductArray)){

  $arEventFields = array(
    "USER_PHONE"          => $_POST['PHONE'],
    "USER_NAME"           => $_POST['FIO'],
    "USER_EMAIL"           => $_POST['EMAIL'],
    "USER_TEXT"           => $_POST['TEXT'],
    "EMAIL_TO"      => Tools::GetValue('REQUEST_EMAIL')
  );


  Tools::SendMailBitrix("REQUEST",$arEventFields);

  $alert = Tools::GetValue('REQUEST_REQUEST');
  Tools::JSONResponse(array(0, $alert));
}
else{
  $alert = "Error: ".$el->LAST_ERROR;
  Tools::JSONResponse(array(0, $alert,'alert'));
}