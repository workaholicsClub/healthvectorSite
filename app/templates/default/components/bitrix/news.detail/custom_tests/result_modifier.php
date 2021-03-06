<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $main_data, $stage;
$main_data = array(
	1 => array( //Стадия развития
		'name' => 'Ранний ствол мозга и спинной мозг', //Название стадии
		'params' => array(
			'high' => array(0.25, 0.75), //опережающее развитие (возраст ребенка от и до мес.)
			'normal' => array(0.75, 1.5), //нормальное развитие (возраст ребенка от и до мес.)
			'low' => array(1.5, 2.5) //задержка в развитии (возраст ребенка от и до мес.)
		)
	),
	2 => array(
		'name' => 'Ствол мозга и ранние подкорковые области',
		'params' => array(
			'high' => array(0.625, 1.875),
			'normal' => array(1.875, 3.75),
			'low' => array(3.75, 6.25)
		)
	),
	3 => array(
		'name' => 'Средний мозг и подкорковые области',
		'params' => array(
			'high' => array(1.75, 5.25),
			'normal' => array(5.25, 10.5),
			'low' => array(10.5, 17.5)
		)
	),
	4 => array(
		'name' => 'Начальная кора',
		'params' => array(
			'high' => array(3, 9),
			'normal' => array(9, 18),
			'low' => array(18, 30)
		)
	),
	5 => array(
		'name' => 'Ранняя кора',
		'params' => array(
			'high' => array(4.5, 13.5),
			'normal' => array(13.5, 27),
			'low' => array(27, 45)
		)
	),
	6 => array(
		'name' => 'Примитивная кора',
		'params' => array(
			'high' => array(9, 27),
			'normal' => array(27, 54),
			'low' => array(54, 90)
		)
	),
	7 => array(
		'name' => 'Сложная кора', //Название стадии
		'params' => array(
			'high' => array(18, 54),
			'normal' => array(54, 108),
			'low' => array(108, 180)
		)
	)
);

$questions = array(
	'test-domana-motorn-podvizhnost' => array(
		1 => 'Двигает ли ребенок руками и ногами без перемещения туловища?',
		2 => 'Ползает ли ребенок на животе в положении "лицом вниз", переходя на перекрестное ползанье на животе (при перекрестном ползанье правая нога выдвигается одновременно с левой рукой и наоборот, создавая четкие и слаженные движения)?',
		3 => 'Ползание на руках и коленях, переходящее в перекрестное ползание на четвереньках (когда руки с ногами движутся синхронно)',
		4 => 'Ходит ли ребенок по комнате с поднятыми для равновесия руками на уровне плеч (или выше)?',
		5 => 'Ходит ли ребенок по комнате с опущенными вниз руками, не используя их в роли баланса?',
		6 => 'Может ли ребенок ходить и бегать "перекрестным" способом без затруднений?',
		7 => 'Может ли ребенок удерживать равновесие на одной ноге или играть с мячом, ударяя по нему ногой?'
	),
	'test-domana-motorn-rech' => array(
		1 => 'Новоорожденный кричит и плачет?',
		2 => 'Ребенок плачет в ответ на угрозу или опасность?',
		3 => 'Говорит ли ребенок звуками свои желания, хочет ли он есть, пить, спать?',
		4 => 'Ребенок говорит два слова, пользуется ими как спонтанно, так и осознанно?',
		5 => 'Ребенок использует от 10 до 25 слов речи и фразы из двух слов?',
		6 => 'Ребенок использует порядка 2000 слов в речи и короткие предложения?',
		7 => 'Ребенок имеет большой словарный запас и правильно строит предложения в меру своего возраста?'
	),
	'test-domana-motorn-podvizhnost-paltsev-ruk' => array(
		1 => 'Если вложить в ладонь ребенка предмет, сжимает (хватает) ли он его?',
		2 => 'Может ли ребенок отпустить предмет, несущий в себе опасность? Ребенок разжимает пальцы при наличии опасности (горячий, холодный, колючий предмет).',
		3 => 'Может ли ребенок поднять предмет любой рукой? В данном случае ребенок использует свои четыре пальца, сжатые против ладони его руки, в то время как большой палец часто не используется вообще.',
		4 => 'Может ли ребенок одной из рук поднимать предметы, помещая их между большим и указательным пальцем (например, крошки с поверхности)?',
		5 => 'Может ли ребенок поднимать предметы обеими руками одновременно, помещая их между указательным и большим пальцем?',
		6 => 'Ребенок в полной мере владеет обеими руками (может  открутить крышку с бутылки или баночки), при этом одна рука выполняет доминирующую роль?',
		7 => 'Пишет ли ребенок самостоятельно (пользуясь доминирующей рукой)?'
	),
	'test-domana-sensor-zrenie' => array(
		1 => 'Сужаются ли зрачки вашего ребенка, когда вы светите фонариком ему в глаза?',
		2 => 'Следит ли ребенок взглядом за движущимся человеком или лучом света в темноте?',
		3 => 'Много ли ребенок распознает известных предметов в достигаемой для него области (на полу, в манеже, в комнате)?',
		4 => 'Расположены ли глаза ребенка по прямой линии в течение дня (отсутствие косоглазия)? Не косят ли глаза ребенка независимо от его состояния: усталость, болезнь, нервное возбуждение?',
		5 => 'Может ли ребенок находить различия у разных символов одного вида (например, различия в буквах, цифрах)?',
		6 => 'Знает ли ребенок буквы или цифры?',
		7 => 'Ребенок читает без затруднений и может объяснить прочитанное?'
	),
	'test-domana-sensor-sluh' => array(
		1 => 'Вздрагивает ли ваш ребенок, когда слышит неожиданный или резкий звук?',
		2 => 'Ребенок реагирует на громкие угрожающие звуки? Естественной реакцей ребенка на резкие угрожающие звуки будет реакция, которая основывается на рефлексе Моро (рефлекс обхватывания или объятия).',
		3 => 'Ребенок реагирует на значащие звуки (например: он реагирует усмешкой, улыбкой на приятную интонацию голоса, реагирует на дверной звонок, на различные бытовые шумы).',
		4 => 'Ребенок понимает два слова?',
		5 => 'Ребенок понимает 10-25 слов и две-три фразы?',
		6 => 'Ребенок понимает порядка 2000 слов, а также простые предложения?',
		7 => 'Ребенок понимает обращенную к нему речь в размере словарного запаса своего возраста?'
	),
	'test-domana-sensor-osyazanie' => array(
		1 => 'Имеется ли Рефлекс Бабинского? Необходимо ногтем большого пальца провести по подошве от пятки к пальцам: в ответ на раздражение происходит веерообразное разгибание пальцев стопы.',
		2 => 'Ребенок реагирует на естественные разражители? Ребенок реагирует моментально на боль в любом месте его тела, различает холод/тепло. Его реакция адекватна.',
		3 => 'Ребенок реагирует на холод, влажность, неудобство (мокрая пеленка, тесная обувь) адекватно?',
		4 => 'Ребенок благодаря тактильности понимает, что предмет объемный (например: кубик на столе кажется плоским, но если его подержать в руках, понимаешь, что он объемный)?',
		5 => 'Ребенок распознает хорошо знакомые предметы наощупь? Это можно проверить на кубике и шарике из одного материала одинакового размера. Сначала дать потрогать что-то одно, назвать и показать, потом другое, далее давать по одному, в конце показать и шарик и кубик и спросить, что ребенок трогал. Сделать так по 3 раза на каждую руку. Если ребенок выбирает правильно - результат отличный.',
		6 => 'Ребенок может тактильно дать характеристику предметам (шершавый, гладкий, мягкий)?',
		7 => 'Ребенок тактильным путем узнает разные предметы (например, может отличить орла от решки на монете наощупь) обеими руками одинаково?'
	)
);


$arResult['AGE'] = empty($_REQUEST['age']) ? intval($_REQUEST['age_year']) * 12 + intval($_REQUEST['age_month']) : intval($_REQUEST['age']); //Возраст ребенка в мес.
if ($arResult['AGE'] > 0) {
	$arResult['STAGE'] = empty($_REQUEST['stage']) ? initStage($arResult['AGE']) : intval($_REQUEST['stage']); //Стадия развития
	$arResult['QUESTION'] = $questions[$arResult['CODE']][$arResult['STAGE']]; //Вопрос
}
if (isset($_REQUEST['answer']) && empty($_REQUEST['direction'])) {
	if ($_REQUEST['answer'] == 'ДА') {
		$arResult['DIRECTION'] = 'up';
	} elseif($_REQUEST['answer'] == 'НЕТ') {
		$arResult['DIRECTION'] = 'down';
	}
} else {
	$arResult['DIRECTION'] = htmlentities($_REQUEST['direction']);
}

/*
 * Определяет стадию развития по возрасту
 * предполагая, что развитие нормальное или замедленное
 */
function initStage($age){
	global $main_data;
	$stage = "";
	foreach ($main_data as $n => $item) {
		if ($age >= $item['params']['normal'][0] && $age <= $item['params']['normal'][1]) {
			$stage = $n;
			break;
		}
	}
	
	//Ищем по замедленному развитию
	if (empty($stage)) {
		foreach ($main_data as $n => $item) {
			if ($age >= $item['params']['low'][0] && $age <= $item['params']['low'][1]) {
				$stage = $n;
				break;
			}
		}
	}
	return $stage;
}

/**
 * Результат теста
 */
function getResult($age, $stage, $direction) {
	global $main_data;
	$output = array();
	$output['NAME'] = $main_data[$stage]['name'];
	foreach ($main_data[$stage]['params'] as $n => $item) {
		//echo "<pre>"; var_dump($stage); echo "</pre>-------------------<br>";
		if ($age >= $item[0] && $age <= $item[1]) {
			if ($n == 'high') {
				$output['RESULT'] = 'Опережающее развитиe';
			} elseif ($n == 'normal') {
				$output['RESULT'] = 'Нормальное развитиe';
			} elseif ($n == 'low') {
				$output['RESULT'] = 'Замедленное развитие';
			}
			break;
		}
	}
	
	if (empty($output['RESULT'])) {
		$output['RESULT'] = ($direction == 'up') ? 'Опережающее развитиe' : 'Замедленное развитие' ;
	}
	
	return $output;
}

if (isset($_REQUEST['answer'])) {
	if ($arResult['DIRECTION'] == 'up') {
		if ($_REQUEST['answer'] == 'ДА' && $arResult['STAGE'] < 7) { //продолжаем тест
			$arResult['STAGE']++;
			$arResult['QUESTION'] = $questions[$arResult['CODE']][$arResult['STAGE']]; //Вопрос
		} else { //завершаем тест
			if ($arResult['STAGE'] == 1) {
				$result_stage = 1;
			} elseif ($arResult['STAGE'] == 7) {
				$result_stage = 7;
			} else {
				$result_stage = $arResult['STAGE'] - 1;
			}
			$arResult['TEST_RESULT'] = getResult($arResult['AGE'], $result_stage, 'up');
		}
	} elseif ($arResult['DIRECTION'] == 'down') {
		if ($_REQUEST['answer'] == 'НЕТ' && $arResult['STAGE'] > 1) { //продолжаем тест
			$arResult['STAGE']--;
			$arResult['QUESTION'] = $questions[$arResult['CODE']][$arResult['STAGE']]; //Вопрос
		} else { //завершаем тест
			$arResult['TEST_RESULT'] = getResult($arResult['AGE'], $arResult['STAGE'], 'down');
		}
	}
	
}

//echo "<pre>"; print_r($_REQUEST); echo "</pre>";
//echo "<pre>"; var_dump($arResult['AGE']); echo "</pre>";
//echo "<pre>"; var_dump($arResult['STAGE']); echo "</pre>";
//echo "<pre>"; var_dump($arResult['QUESTION']); echo "</pre>";
//echo "<pre>"; var_dump($arResult['TEST_RESULT']); echo "</pre>";




?>