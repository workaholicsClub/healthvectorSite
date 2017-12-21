<?php 
ob_start();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$tmp = ob_get_contents();
ob_end_clean();
header("Content-type: application/json; charset=utf-8");

if(!preg_match('/^[0-9A-Za-z._-]+@([0-9a-z_-]+\.)+[a-z]{2,4}$/', $_POST['email'])){
  $alert = 'Укажите правильный e-mail!';
  echo json_encode(array(1, $alert,'alert'));
  exit();
}

if(CModule::IncludeModule("subscribe")){  
      
  $subscriber = CSubscription::GetByEmail($_POST['email']);
  if($subscriber = $subscriber->GetNext()){
    $alert = 'Даный  email уже зарегестрирован в системе!';
    echo json_encode(array(1, $alert,'alert'));
    exit();
  }
  unset($subscriber);
  //Добавляем в случае успеха
  $arFields = Array(
        "EMAIL" => $_POST['email'],
        "SEND_CONFIRM" => "Y"
    );
    $subscr = new CSubscription;

    //can add without authorization
    $ID = $subscr->Add($arFields);
    if($ID>0){
      $alert = 'Подписка на новости выполнена, на Ваш E-mail выслано письмо с подтверждением!';
      echo json_encode(array(0,$alert,'success'));
      exit();
    }
    else{
        $strWarning .= "Error adding subscription: ".$subscr->LAST_ERROR."<br>"; 
        echo json_encode(array(1, $strWarning,'error-popup'));
        exit();
    }

  
      
}else{
  
  $alert = 'Технический проблемы, свяжитесь с администратором!';
  echo json_encode(array(1, $alert,'error-popup'));
  exit();
}