<?php
AddEventHandler("main", "OnEpilog", "My404PageInSiteStyle");
AddEventHandler("main", "OnEndBufferContent", "OnEndBufferContentHandler");

function My404PageInSiteStyle()
{
  if(defined('ERROR_404') && ERROR_404 == 'Y')
  {
    global $APPLICATION;
    $APPLICATION->RestartBuffer();
    require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/404.php';
    require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
  }
}

// Размещение комментариев по всем страницам сайта
// Входные данные : URL страницы
//Результат: HTML код который будет вставлятья в текст по средству якорей ( определяются из инфоблока )
//Якорь прописывается в теле страницы

function OnEndBufferContentHandler(&$content)
{
  global $APPLICATION;
  $groupedComments = array();
  $html = '';
  $url = $APPLICATION->GetCurPage();
  $arrAnchors = $arrHtml =  array();

  //если не админка то работам
  if(defined( "ADMIN_SECTION" ) && ADMIN_SECTION === true) {
    return true;
  }


  require_once($_SERVER["DOCUMENT_ROOT"]."/includes/tools.php");
  Tools::IncludeModule('iblock');
  // гребем данные и строим массивы инфы ( в будущем если будет желание можно закешировать )
  $arFilter = array(
    'IS_ACTIVE' => 'Y',
    'IBLOCK_ID' => Config::IBLOCK_COMMENTS,
    'PROPERTY_URL' => $url,
    '!PROPERTY_TYPE_COMMENTS' =>false
  );
  $arrComments = CIBlockElement::GetList(array('SORT'=>'ASC'),$arFilter);

  while($comment = $arrComments->GetNext()){
    $propertiesT = CIBlockElement::GetProperty(Config::IBLOCK_COMMENTS, $comment['ID']);
    $propeties = array();
    while ($prop = $propertiesT->Fetch())
    {
      switch($prop['CODE']){
        case 'URL':
          if($prop['VALUE']==$url){//на случай множественной привязки как на одной странице так и на остальных
            $propeties['POSITION'][] = $prop['DESCRIPTION'];
          }
          break;
        case 'TYPE_COMMENTS'://заодно забираем тип
          $propeties['TYPE'] = $prop['VALUE_ENUM'];
          break;
      }
    }

    // распределяем все в массив
    if(sizeof($propeties['POSITION'])>0){//на всякий случай хотя это условие всегда будет соблюдаться
      foreach ($propeties['POSITION'] as $position){//по позициям
        $groupedComments[$position][$propeties['TYPE']][$comment['ID']] = $comment;
      }
    }
    
  }
  //формируем массивы 1 - ключей, 2 - html для preg_replace

  if(sizeof($groupedComments)>0){
    
    foreach ($groupedComments as $anchor => $typesComments){
      $html = '';
      $arrAnchors[] = "/{".$anchor."}/";
      ob_start();
        include($_SERVER["DOCUMENT_ROOT"]."/includes/content/comments.php");
        $html = ob_get_contents();
      ob_end_clean();
      $arrHtml[] = $html;
    }
  }
  $content = preg_replace($arrAnchors,$arrHtml,$content,1);
  //echo'<pre>';var_dump(Config::IBLOCK_COMMENTS);echo'</pre>';die();


}