<?php 
ob_start();
  require_once($_SERVER["DOCUMENT_ROOT"]."/includes/tools.php");
$tmp = ob_get_contents();
ob_end_clean();



if(!preg_match('/^[a-zA-Zа-яА-Я0-9-].*$/', $_POST['FIO'])){
    $alert = 'Укажите Ваше Ф.И.О!';
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

Tools::IncludeModule();

$el = new CIBlockElement;

$PROP = array();
$PROP['EMAIL'] = $_POST['EMAIL'];
$PROP['PHONE'] = $_POST['PHONE'];
$PROP['FIO'] = $_POST['FIO'];

$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  
  "IBLOCK_ID"      => Config::IBLOCK_FEEDBACK,//Заявки с сайта
  "PROPERTY_VALUES"=> $PROP,
  "PREVIEW_TEXT" => $_POST['TEXT'],
  "ACTIVE"         => "N",            // активен
  "NAME"           => 'форма обратной связи'
  );

if($PRODUCT_ID = $el->Add($arLoadProductArray)){
  
  
  $arEventFields = array(
    "AUTHOR_EMAIL"          => $PROP['EMAIL'],
    "AUTHOR"           => $PROP['FIO'],
    "TEXT"           => $_POST['TEXT'],
    "EMAIL_TO"           =>Tools::GetValue('FEEDBACK_EMAIL')
    );
  Tools::SendMailBitrix("FEEDBACK_FORM",$arEventFields);
  
  
  
  $alert = Tools::GetValue('FEEDBACK_REQUEST');
  Tools::JSONResponse(array(0, $alert));
}
else{
  $alert = "Error: ".$el->LAST_ERROR;
  Tools::JSONResponse(array(1, $alert));
}