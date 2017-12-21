СЕО-текст
=========

Модуль interlabs:seo.text

Пример для статической страницы:

    <?$APPLICATION->IncludeComponent(
      "interlabs:seo.text",
      "global",
      Array(
        "ANNOUNCE" => "Анонс",
        "FULL_TEXT" => "Полный текст",
        "IBLOCK_ID" => "",
        "ELEMENT_ID" => "",
        "ANNOUNCE_FIELD" => "",
        "FULL_TEXT_FIELD" => "",
        "READ_MORE" => "Развернуть текст",
        "READ_MORE_HIDE" => "Свернуть текст"
      )
    );?>

Пример для динамической страницы (нет анонса, передаем BLOCK_ID и ELEMENT_ID, а также поля элемента, содержание СЕО-текст):

    <?$APPLICATION->IncludeComponent(
      "interlabs:seo.text",
      "global",
      Array(
        "ANNOUNCE" => "",
        "FULL_TEXT" => "",
        "IBLOCK_ID" => BFactory::_()->articles,
        "ELEMENT_ID" => $_REQUEST["ID"],
        "ANNOUNCE_FIELD" => "PROPERTY_SEO_ANNOUNCE",
        "FULL_TEXT_FIELD" => "PROPERTY_SEO_TEXT",
        "READ_MORE" => "Развернуть текст",
        "READ_MORE_HIDE" => "Свернуть текст"
      )
    );?>

При использовании шаблона "global" вывод сохраняется в переменной `INTERLABS_SEO_BLOCK`:

    <div>
        <?=$GLOBALS['INTERLABS_SEO_BLOCK'];?>
    </div>