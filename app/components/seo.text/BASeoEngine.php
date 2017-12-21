<?php
class BASeoEngine {

  private $arParams;
  public function __construct($arParams)
  {
    CModule::IncludeModule("iblock");
    $this->arParams = $arParams;
    $this->arParams["IBLOCK_ID"] = intVal(intVal($this->arParams["IBLOCK_ID"]) > 0 ? $this->arParams["IBLOCK_ID"] : $_REQUEST["ID"]);
    $this->arParams["ELEMENT_ID"] = intVal(intVal($this->arParams["ELEMENT_ID"]) > 0 ? $this->arParams["ELEMENT_ID"] : $_REQUEST["ELEMENT_ID"]);
  }
  
  private $announce, $fulltext;
  public function execute()
  {
    if (trim(strip_tags($this->arParams['ANNOUNCE'])))
    {
      $this->getPageText();
    }
    else
    {
      try
      {
        $this->getBlockText();
      }
      catch (Exception $e)
      {
        if ($e->getCode() == self::NO_ELEMENT)
        {
          $this->getPageText();
        }
        else
        {
          throw new Exception('Uncatched exception', 0, $e);
        }
      }
    }
    
    return array
    (
      'ANNOUNCE' => $this->announce,
      'FULL_TEXT' => $this->fulltext,
      'TEXT_IS_PRESENT' => trim(strip_tags($this->announce)) !='' || trim(strip_tags($this->fulltext)) != ''
    ); 
  }
  
  private function getPageText()
  {
    $this->announce = $this->arParams['ANNOUNCE'];
    $this->fulltext = $this->arParams['FULL_TEXT'];
  }
  
  const NO_ELEMENT = 800;
  private function getBlockText()
  {
    $blockId = (int)$this->arParams["IBLOCK_ID"];
    $elementId = (int)$this->arParams["ELEMENT_ID"];
    if ($elementId == 0 || $blockId == 0) throw new Exception('No enough params', self::NO_ELEMENT);
    CModule::IncludeModule("iblock");
    
    $arSelect = array($this->arParams['ANNOUNCE_FIELD'], $this->arParams['FULL_TEXT_FIELD']);
    $elementList = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>$blockId, "ID"=>$elementId), false, false, $arSelect);
    if ($elementList->SelectedRowsCount() != 1) throw new Exception('No such element', self::NO_ELEMENT);
    $element = $elementList->Fetch();
    $this->announce = $element[$this->arParams['ANNOUNCE_FIELD'] . '_VALUE']['TEXT'];
    $this->fulltext = $element[$this->arParams['FULL_TEXT_FIELD'] . '_VALUE']['TEXT'];
  }


}