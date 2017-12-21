<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arrQuestionsIDS = $arResult['PROPERTIES']['QUESTIONS']['VALUE'];
$arrQuestionsT = CIBlockElement::GetList(array(),array('ACTIVE'=>'Y','ID'=>$arrQuestionsIDS),false,false,array('*','PREVIEW_TEXT','DETAIL_TEXT','PROPERTY_ANSWER'));
$arrQuestions = array();
while($quest = $arrQuestionsT->GetNext()){
  $arrQuestions[$quest['ID']] = $quest;
}
$arrAnswersIDS = $arResult['PROPERTIES']['RESULTS']['VALUE'];
$arrAnswersT = CIBlockElement::GetList(array(),array('ACTIVE'=>'Y','ID'=>$arrAnswersIDS),false,false,array('*','PREVIEW_TEXT','DETAIL_TEXT','PROPERTY_COUNT_ANSWERS'));
$arrAnswers = array();
while($answer = $arrAnswersT->GetNext()){
  $arrAnswers[$answer['ID']] = $answer;
}
$arResult['QUESTIONS'] = $arrQuestions;
$arResult['ANSWERS'] = $arrAnswers;

?>