<?php
//конвертация старой базы в битриксовую
include_once($_SERVER["DOCUMENT_ROOT"]."/includes/tools.php");
global $DB, $ldb;
Tools::IncludeModule('catalog');
$ldb = new DataBaseMysql('192.168.0.197', 'root', '', 'insat');
const CATALOG_IBLOCK_ID = 10;
const CATALOG_PARAMETERS_IBLOCK_ID = 11;
const CATALOG_DOCS_IBLOCK_ID = 12;
const CATALOG_UPDATE_SECTIONS = false;
const CATALOG_UPDATE_ELEMENTS = true;
const CATALOG_UPDATE_ELEMENTS_PICTURES = true; //обновлять картинки
const CATALOG_UPDATE_PARAMETERS = false; //обновлять характеристики товаров
const CATALOG_ITEM_MEASURE = 4; //ID единицы измерения товара, 4 - килограмм (CODE: 166)
set_time_limit(0);

echo '<pre>';

//begin

//ImportSubsections();
ImportItems();
//ImportParameters();
//ImportDocs();

function ImportSubsections($parentId = 0, $parentXMLID = 0)
{
    static $existSectionsList = false;
    global $ldb;

    if ($existSectionsList === false) {
        $res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => CATALOG_IBLOCK_ID), false, array('ID', 'XML_ID'));
        while ($section = $res->Fetch()) {
            $existSectionsList[$section['XML_ID']] = $section['ID'];
        }
    }

    $sectionsList = $ldb->SelectSet("SELECT * FROM `products_tree` WHERE `parent_id` = ".((int) $parentXMLID), 'id');
    foreach ($sectionsList as $section) {
        $newSection = new CIBlockSection;
        $fields = array(
            'IBLOCK_ID' => CATALOG_IBLOCK_ID,
            'XML_ID' => (int) $section['id'],
            'NAME' => $section['comment'],
            'IBLOCK_SECTION_ID' => $parentId,
            'DESCRIPTION_TYPE' => 'html',
            'DESCRIPTION' => $section['page_contents'],
            'SORT' => (int) $section['id_order'],
            'ACTIVE' => ($section['category_is_activated'] === 'on' ? 'Y' : 'N'),
            'CODE' => $section['code'],

            'UF_SECTION_CODE' => $section['code'],
            'UF_SECTION_MARKS' => $section['marks'],
            'UF_SECTION_SHOW_ID' => ($section['show_id'] === 'on' ? 'Y' : 'N'),
            'UF_SECTION_BASEPRICE' => ($section['is_base_price'] === 'on' ? 'Y' : 'N'),
            'UF_SECTION_DELIVERY' => $section['delivery_date'],
            'UF_SECTION_DISC_VAL' => number_format((float) $section['discount_value'], 1, '.', ''),
            'UF_SECTION_DISC_DATE' => $section['discount_date'],
            'UF_SECTION_DISC_MARK' => $section['discount_marks'],
            'UF_SECTION_WEIGHT' => number_format((float) $section['weight_value'], 1, '.', ''),

            'IPROPERTY_TEMPLATES' => array(
                'SECTION_META_KEYWORDS' => $section['meta_keywords'],
                'SECTION_META_DESCRIPTION' => $section['meta_description'],
            ),
        );
        if (isset($existSectionsList[$fields['XML_ID']])) {
            $id = (int) $existSectionsList[$fields['XML_ID']];
            if (CATALOG_UPDATE_SECTIONS) {
                unset($fields['IBLOCK_ID'], $fields['XML_ID'], $fields['IBLOCK_SECTION_ID']);
                $newSection->Update($id, $fields);
            }
        } else {
            $id = (int) $newSection->Add($fields);
        }
        ImportSubsections($id, $fields['XML_ID']);
    }
}//ImportSubsections

function ImportItems()
{
    global $ldb;
    $existItemsList = array();
    $existSectionsList = array();
    $itemInfoByItemXMLID = array();

    $res = CIBlockElement::GetList(array(), array('IBLOCK_ID' => CATALOG_IBLOCK_ID), false, false, array('ID', 'XML_ID'));
    while ($item = $res->Fetch()) {
        $existItemsList[$item['XML_ID']] = $item['ID'];
    }

    $res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => CATALOG_IBLOCK_ID), false, array('ID', 'XML_ID'));
    while ($section = $res->Fetch()) {
        $existSectionsList[$section['XML_ID']] = $section['ID'];
    }

    $itemsTreeList = $ldb->SelectSet("SELECT * FROM `products_tree_links`", 'id');
    foreach ($itemsTreeList as $item) {
        $itemInfoByItemXMLID[$item['products_id']]['sections'][] = $existSectionsList[$item['products_tree_id']];
        $itemInfoByItemXMLID[$item['products_id']]['sort'] = (int) ($item['is_main'] === 'on' || !$itemInfoByItemXMLID[$item['products_id']]['sort'] ? $item['id_order'] : 0);
    }

    $offset = 0;
    $perPage = 100;
    while ($itemsList = $ldb->SelectSet("SELECT * FROM `products` ORDER BY `id` LIMIT ".($offset).", ".($perPage), 'id')) {
        foreach ($itemsList as $item) {
            $newElement = new CIBlockElement;
            $fields = array(
                'IBLOCK_ID' => CATALOG_IBLOCK_ID,
                'XML_ID' => (int) $item['id'],
                'NAME' => $item['comment'],
                'IBLOCK_SECTION' => $itemInfoByItemXMLID[$item['id']]['sections'],
                'PREVIEW_TEXT' => $item['description'],
                'SORT' => (int) $itemInfoByItemXMLID[$item['id']]['sort'],
                'ACTIVE' => ($item['is_active'] === 'on' ? 'Y' : 'N'),
                'PROPERTY_VALUES' => array(
                    'PRODUCER' => $item['producer'],
                    'MARKS' => array(
                        'VALUE' => array(
                            'TYPE' => 'html',
                            'TEXT' => $item['marks'],
                        ),
                    ),
                    'DYNAMICS' => $item['dunamics'],
                    'POP_HEADER' => $item['pop_header'],
                    'POP_DESC' => array(
                        'VALUE' => array(
                            'TYPE' => 'html',
                            'TEXT' => $item['pop_desc'],
                        ),
                    ),
                    'ORDER_VIA_EMAIL' => ($item['order_via_email'] === 'on' ? 'Y' : 'N'),
                    'PRICE_IS_SET' => $item['price_is_set'],
                    'PRICE_LINK' => $item['price_link'],
                    'DELIVERY_DATE' => $item['delivery_date'],
                    'DISCOUNT_VALUE' => $item['discount_value'],
                    'DISCOUNT_DATE' => $item['discount_date'],
                    'DISCOUNT_MARKS' => $item['discount_marks'],
                    'CURRENCY' => $item['currency'],
                    'PRICE' => $item['price'],
                ),

                'IPROPERTY_TEMPLATES' => array(
                    'ELEMENT_META_KEYWORDS' => $item['meta_keywords'],
                    'ELEMENT_META_DESCRIPTION' => $item['meta_description'],
                ),
            );

            $elementExists = isset($existItemsList[$fields['XML_ID']]);

            //грузим картинку для нового товара либо при обновлении с флагом CATALOG_UPDATE_ELEMENTS_PICTURES
            if (!$elementExists || (CATALOG_UPDATE_ELEMENTS && CATALOG_UPDATE_ELEMENTS_PICTURES && !empty($item['pop_img']))) {
                $image = CFile::MakeFileArray('http://insat.ru/i/prices/'.($item['pop_img']));
                $fields['DETAIL_PICTURE'] = $image;

                $tmpFields = array(
                    'image' => $image,
                );
                CFile::SaveForDB($tmpFields, 'image', 'iblock');
                $smallImage = CFile::MakeFileArray($tmpFields['image']);
                CFile::ResizeImage($smallImage, array( 'width' => 250, 'height' => 140 ), BX_RESIZE_IMAGE_PROPORTIONAL);
                $fields['PREVIEW_PICTURE'] = $smallImage;
            }

            $currency = GetValidCurrency($item['currency']);
            if ($elementExists) {
                $id = (int) $existItemsList[$fields['XML_ID']];
                if (CATALOG_UPDATE_ELEMENTS) {
                    unset($fields['IBLOCK_ID'], $fields['XML_ID']);
                    $newElement->Update($id, $fields);

                    $newProduct = new CCatalogProduct;
                    $productFields = array(
                        'QUANTITY' => (float) $item['is_warehouse'],
                        'PURCHASING_PRICE' => (float) $item['price'],
                        'PURCHASING_CURRENCY' => $currency,
                        'WEIGHT' => (float) $item['weight_value'],
                        'MEASURE' => CATALOG_ITEM_MEASURE,
                    );
                    $newProduct->Update($id, $productFields);
                    CPrice::SetBasePrice($id,  (float) $item['price'], $currency);
                }
            } else {
                $id = (int) $newElement->Add($fields);

                $product = CCatalogProduct::GetByID($id);
                $newProduct = new CCatalogProduct;
                if ($product == false) {
                    $productFields = array(
                        'QUANTITY' => (float) $item['is_warehouse'],
                        'PURCHASING_PRICE' => (float) $item['price'],
                        'PURCHASING_CURRENCY' => $currency,
                        'WEIGHT' => (float) $item['weight_value'],
                        'MEASURE' => CATALOG_ITEM_MEASURE,
                    );
                    $newProduct->Update($id, $productFields);
                    $productId = $id;
                } else {
                    $productFields = array(
                        'ID' => $id,
                        'QUANTITY' => (float) $item['is_warehouse'],
                        'PURCHASING_PRICE' => (float) $item['price'],
                        'PURCHASING_CURRENCY' => $currency,
                        'WEIGHT' => (float) $item['weight_value'],
                        'MEASURE' => CATALOG_ITEM_MEASURE,
                    );
                    $productId = $newProduct->Add($productFields);
                }
                CPrice::SetBasePrice($productId,  (float) $item['price'], $currency);
            }
        }
        $offset += $perPage;
    }
}//ImportItems

//характеристики товаров
function ImportParameters() {
    if (!CATALOG_UPDATE_PARAMETERS) {
        return;
    }
    global $ldb;
    $existItemsList = array();
    $existParametersList = array();
    $allItemsList = array();

    $res = CIBlockElement::GetList(array(), array('IBLOCK_ID' => CATALOG_IBLOCK_ID), false, false, array('ID', 'XML_ID'));
    while ($item = $res->Fetch()) {
        $existItemsList[$item['XML_ID']] = $item['ID'];
        $allItemsList[$item['ID']] = $item;
    }

    $res = CIBlockElement::GetList(array(), array('IBLOCK_ID' => CATALOG_PARAMETERS_IBLOCK_ID), false, false, array('ID', 'XML_ID', 'PROPERTY_ITEM'));
    while ($item = $res->Fetch()) {
        $existParametersList[$item['XML_ID']][$allItemsList[$item['PROPERTY_ITEM_VALUE']]['XML_ID']] = $item['ID'];
    }

    $parametersEnum = array();
    $res = CIBlockPropertyEnum::GetList(array('SORT' => 'ASC'), array('IBLOCK_ID' => CATALOG_PARAMETERS_IBLOCK_ID, 'PROPERTY_ID' => 'PARAMETER'));
    while ($item = $res->Fetch()) {
        $parametersEnum[$item['VALUE']] = (int) $item['ID'];
    }

    //формирование "списка" значений параметра PARAMETER (enum)
    $parametersList = $ldb->SelectSet("SELECT * FROM `products_tree_fields`", 'id');
    foreach ($parametersList as $parameter) {
        if (!isset($parametersEnum[$parameter['comment']])) {
            $newParameter = new CIBlockPropertyEnum;
            $fields = array(
                'PROPERTY_ID' => 41, //parameter
                'VALUE' => $parameter['comment'],
                'SORT' => $parameter['id'],
            );
            $id = (int) $newParameter->Add($fields);
            $parametersEnum[$parameter['comment']] = $id;
        }
    }

    //parameters
    $itemsParametersValues = $ldb->SelectSet("SELECT * FROM `products_fields_values`", 'id');
    foreach ($itemsParametersValues as $parameterValue) {
        if (!isset($existItemsList[$parameterValue['products_id']])) {
            continue;
        }
        if (isset($existParametersList[$parameterValue['id']][$parameterValue['products_id']])) {
        } else {
            $newParameter = new CIBlockElement;
            $name = $parametersList[$parameterValue['products_tree_fields_id']]['comment'];
            $fields = array(
                'IBLOCK_ID' => CATALOG_PARAMETERS_IBLOCK_ID,
                'XML_ID' => (int) $parameterValue['id'],
                'NAME' => $name,
                'ACTIVE' => 'Y',
                'PROPERTY_VALUES' => array(
                    'ITEM' => $existItemsList[$parameterValue['products_id']],
                    'PARAMETER' => $parametersEnum[$name],
                    'VALUE' => $parameterValue['field_value'],
                ),
            );
            $newParameter->Add($fields);
        }
    }
}//ImportParameters

//документы
function ImportDocs()
{
    global $ldb;
    $existItemsList = array();
    $allItemsList = array();
    $allDocsListByMD5 = array();

    $res = CIBlockElement::GetList(array(), array('IBLOCK_ID' => CATALOG_IBLOCK_ID), false, false, array('ID', 'XML_ID'));
    while ($item = $res->Fetch()) {
        $existItemsList[$item['XML_ID']] = $item['ID'];
        $allItemsList[$item['ID']] = $item;
    }

    $res = CIBlockElement::GetList(array(), array('IBLOCK_ID' => CATALOG_DOCS_IBLOCK_ID), false, false, array('ID', 'XML_ID'));
    while ($item = $res->Fetch()) {
        $allDocsListByMD5[$item['XML_ID']] = $item;
    }

    //загрузка доков
    $itemsDocs = array();
    $docsList = $ldb->SelectSet("SELECT * FROM `products_doc`", 'id');
    foreach ($docsList as $doc) {
        $md5 = md5($doc['documentation']);
        if (isset($allDocsListByMD5[$md5])) {
            $docId = (int) $allDocsListByMD5[$md5]['ID'];
        } else {
            $newParameter = new CIBlockElement;
            $fields = array(
                'IBLOCK_ID' => CATALOG_DOCS_IBLOCK_ID,
                'XML_ID' => $md5,
                'NAME' => $doc['documentation'],
                'ACTIVE' => 'Y',
                'PROPERTY_VALUES' => array(
                    'FILE' => CFile::MakeFileArray('http://www.insat.ru/files/products/'.($doc['documentation'])),
                ),
            );
            $docId = (int) $newParameter->Add($fields);
        }
        $itemsDocs[$existItemsList[$doc['products_id']]][] = $docId;
    }

    //привязка документов к товарам
    foreach ($itemsDocs as $itemId => $docs) {
        $newElement = new CIBlockElement;
        $fields = array(
            'PROPERTY_VALUES' => array(
                'DOCS' => $docs,
            ),
        );
        $newElement->Update($itemId, $fields);
    }
}//ImportDocs

function GetValidCurrency($currency)
{
    static $currenciesList = array(
        'RUR' => 'RUB',
        '' => 'RUB',
        'USD' => 'USD',
        'EUR' => 'EUR',
        'APR' => 'RUB', //% от базовой стоимости
    );
    return (isset($currenciesList[$currency]) ? $currenciesList[$currency] : 'RUB');
}//GetValidCurrency


//Done
echo "\nDone at ".(date('H:i:s d.m.Y'))."\n";



//tools

class DataBaseMysql {
   var $dbId;
   function DataBaseMysql($host, $user, $password, $database) { if (!$this->dbId = @mysql_connect($host, $user, $password)) trigger_error("<b>MySQL</b>: Unable to connect to database", ERROR); @mysql_query('SET NAMES UTF8'); if (!mysql_select_db($database)) trigger_error("<b>MySQL</b>: Unable to select database <b>".$database."</b>", ERROR); }
   function Query($sqlString) { /*echo $sqlString."<br />";*/ if (!$resourseId =@mysql_query($sqlString, $this->dbId)) trigger_error("<b>MySQL</b>: Unable to execute<br /><b>SQL</b>: ".$sqlString."<br /><b>Error (".mysql_errno().")</b>: ".@mysql_error(), ERROR); return $resourseId; }
   function SelectValue($sqlString) { $resourseId = DataBaseMysql::Query($sqlString); $row = array(); $row = mysql_fetch_row($resourseId); @mysql_free_result($resourseId); return $row[0]; }
   function SelectRow($sqlString) { $resourseId = DataBaseMysql::Query($sqlString); $row = array(); $row = mysql_fetch_assoc($resourseId); @mysql_free_result($resourseId); return $row; }
   function SelectSet($sqlString, $idTable = '') { $resourseId = DataBaseMysql::Query($sqlString); $row = array(); while ($rowOne = mysql_fetch_assoc($resourseId)) { if ($idTable) $row[$rowOne[$idTable]] = $rowOne; else $row[] = $rowOne; } @mysql_free_result($resourseId); return $row; }
   function SelectLastInsertId() { return @mysql_insert_id($this->dbId); }
   function SelectAffectedRows() { return @mysql_affected_rows($this->dbId); }
   function Destroy() { if (!@mysql_close($this->dbId)) trigger_error("<b>MySQL</b>: Cann't disconnect from database", ERROR); }
}
