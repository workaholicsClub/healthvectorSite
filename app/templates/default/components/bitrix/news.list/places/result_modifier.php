<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*$sArea = $sCity = $sSpec = $sBuild = array(
  "reference" => array(
      'не выбрано'
  ),
  "reference_id" =>array(
      ''
  )
);
$points = array();
$ajax = (int)$_REQUEST['ajax'];
foreach( $arResult['ITEMS'] as $id => $item ) {
    $item['_EDIT_AREA'] = Tools::GetIBlockElementEditLink( $item['ID'], $item['IBLOCK_ID'] );
    $arResult['ITEMS'][ $id ] = $item;

    if($item['DISPLAY_PROPERTIES']['CITIES']['VALUE']!='' && !in_array($item['DISPLAY_PROPERTIES']['CITIES']['VALUE'],$sCity['reference_id'])){
        $sCity['reference'][] = $item['DISPLAY_PROPERTIES']['CITIES']['DISPLAY_VALUE'];
        $sCity['reference_id'][] = $item['DISPLAY_PROPERTIES']['CITIES']['VALUE'];
    }
    if($item['DISPLAY_PROPERTIES']['AREA']['VALUE']!='' && !in_array($item['DISPLAY_PROPERTIES']['AREA']['VALUE'],$sArea['reference_id'])){
        $sArea['reference'][] = $item['DISPLAY_PROPERTIES']['AREA']['DISPLAY_VALUE'];
        $sArea['reference_id'][] = $item['DISPLAY_PROPERTIES']['AREA']['VALUE'];
    }
    if($item['DISPLAY_PROPERTIES']['SPEC']['VALUE']!='' && !in_array($item['DISPLAY_PROPERTIES']['SPEC']['VALUE'],$sSpec['reference_id'])){
        $sSpec['reference'][] = $item['DISPLAY_PROPERTIES']['SPEC']['DISPLAY_VALUE'];
        $sSpec['reference_id'][] = $item['DISPLAY_PROPERTIES']['SPEC']['VALUE'];
    }
    if($item['~NAME']!='' && !in_array($item['~NAME'],$sBuild['reference_id'])){
        $sBuild['reference'][] = $item['~NAME'];
        $sBuild['reference_id'][] = $item['~NAME'];
    }
    //если аякс формируем массив точек
    //фильтр бдут формироваться при запросе к странице так что доп фильтров не нужно
    if($ajax){
        $points[] = array(
            'title' => $item['~NAME'],
            'body' => $item['~PREVIEW_TEXT'],
            'coords' => $item['PROPERTIES']['COORDS']['VALUE'],
            'is_build' => ($item['PROPERTIES']['IS_BUILD']['VALUE'] == 'ДА'? 'true':'false')
        );
    }

}
$arResult['SELECT_AREA'] = $sArea;
$arResult['SELECT_CITY'] = $sCity;
$arResult['SELECT_SPEC'] = $sSpec;
$arResult['SELECT_BUILD'] = $sBuild;



if($ajax){
    $cp = $this->__component; // объект компонента
    if (is_object($cp))
    {
        // добавим в arResult компонента
        $cp->arResult['POINTS'] = $points;
        $cp->SetResultCacheKeys(array('POINTS'));
    }
    //дальше смотрним в component_epilog
}
*/


/**
 * Список свойств Страна и Город
 */
$arResult['SELECT_COUNTRY'] = $arResult['SELECT_CITY'] = array("reference" => array('Не выбрано'), "reference_id" => array(''));

//Список стран
$property_enums = CIBlockPropertyEnum::GetList(
	array("VALUE"=>"DESC", "SORT"=>"DESC"),
	array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "CODE" => array("COUNTRY"))
);
while($enum_fields = $property_enums->GetNext()) {
	$arResult['SELECT_COUNTRY']['reference'][] = $enum_fields['VALUE'];
	$arResult['SELECT_COUNTRY']['reference_id'][] = $enum_fields['VALUE'];
}

//Список городов, выбранной страны
if (!empty($_REQUEST['form_dropdown_COUNTRY'])) {
	$arCity = array();
	$res = CIBlockElement::GetList(
		array('property_CITY' => 'asc'),
		array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "PROPERTY_COUNTRY_VALUE" => htmlentities($_REQUEST['form_dropdown_COUNTRY'])),
		false,
		false,
		array("PROPERTY_CITY_VALUE")
	);
	while($arFields = $res->GetNext()){
		$arCity[] = $arFields['PROPERTY_CITY_VALUE'];
	}
	$arCity = array_unique($arCity);

	foreach ($arCity as $city) {
		$arResult['SELECT_CITY']['reference'][] = $city;
		$arResult['SELECT_CITY']['reference_id'][] = $city;
	}
}

?>