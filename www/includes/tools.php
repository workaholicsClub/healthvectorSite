<?php
//вспомогательные функции

include_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" ); //подключение Bitrix API
include_once( $_SERVER["DOCUMENT_ROOT"]."/includes/config.php" );

class Tools {
    static private $_isInitialized = false;
    static public $documentRoot;
    static public $userInfo;
    //core
    static public function Init() {
        if( self::$_isInitialized !== false ) {
            return;
        }
        self::$documentRoot = $_SERVER["DOCUMENT_ROOT"];
        global $APPLICATION;
        if( !session_id() ) {
            session_start();
        }
        self::SetParms( 'scriptName', $APPLICATION->GetCurPage() );
        self::InitConfigValues();
        //self::InitRegion();
        //self::GetVisitedItems();

        self::$_isInitialized = true;
    }//Init

    //parms
    public static function SetParms( $name, $value ) {
        if( !empty( $name ) ) {
            $GLOBALS[ Config::PROJECT_NAME ][ $name ] = $value;
        }
    }//SetParms

    public static function GetParms( $name ) {
        return ( isset($GLOBALS[ Config::PROJECT_NAME ][ $name ]) ? $GLOBALS[ Config::PROJECT_NAME ][ $name ] : '' );
    }//GetParms

    //session
    public static function SetSession( $name, $value ) {
        $_SESSION[ $name ] = $value;
    }//SetSession

    public static function GetSession( $name ) {
        return ( isset( $_SESSION[ $name ] ) ? $_SESSION[ $name ] : false );
    }//GetSession

    //json/ajax
    public static function JSONResponse( $data ) {
        header( 'Content-Type: application/json; charset=utf-8' );
        die(
            json_encode(
                $data
            )
        );
    }//JSONResponse

    public static function IsAjax() {
        static $isAjax = null;
        if( $isAjax === null ) {
            $isAjax = ( $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' );
        }
        return $isAjax;
    }//IsAjax

    //вернуть json-ответ с помещением буфера в "content"
    //
    static function AjaxResponse( $success = true, $alert = false, $content = false, $additionalFields = array() ) {
        if( !self::IsAjax() ) {
            die();
        }
        $result = array(
            'content' => ( $content === false ? ob_get_clean() : $content ),
            'success' => $success,
        ) + ( array ) $additionalFields;
        if( $alert !== false && !empty( $alert ) ) {
            $result['alert'] = $alert;
        }
        self::JSONResponse( $result );
    }//AjaxResponse

    //подключить модуль Bitrix
    public static function IncludeModule( $moduleName = 'iblock' ) {
        if( !empty( $moduleName ) ) {
            CModule::IncludeModule( $moduleName );
        }
    }//IncludeModule

    //подключить произвольный файл с проверкой на повтор
    public static function IncludeFile( $fileName, $onlyOnce = true, $parameters = null ) {
        $oldDocumentRoot = $_SERVER['DOCUMENT_ROOT'];
        $_SERVER['DOCUMENT_ROOT'] = self::$documentRoot;
        extract( $parameters );
        if( $onlyOnce ) {
            require_once( self::$documentRoot.'/'.( $fileName ) );
        } else {
            require( self::$documentRoot.'/'.( $fileName ) );
        }
        $_SERVER['DOCUMENT_ROOT'] = $oldDocumentRoot;
    }//IncludeFile

    //"Включаемая область"
    //templatePath: полный путь к шаблону, например /bitrix/templates/default/components/bitrix/news.list/news_main/template.php
    //mode: php/html/text
    public static function IncludeTemplate( $templatePath, $parameters = array(), $mode = 'php' ) {
        global $APPLICATION;
        $APPLICATION->IncludeFile( $templatePath, $parameters,
            array(
                'MODE'  => $mode,
                'TEMPLATE'  => '',
            )
        );
    }//IncludeTemplate

    //URL страницы
    public static function GetCurPage() {
        global $APPLICATION;
        return $APPLICATION->GetCurPage();
    }//GetCurPage

    //возвращает дефолтный email из настроек сайта
    public static function GetDefaultEmail() {
        static $email = false;
        if( $email !== false ) {
            return $email;
        }

        $_by = 'id';
        $_order = 'asc';
        /*
        if( $res = CUser::GetList( $_by, $_order, array( 'ID' => 1 ), array( 'ID', 'EMAIL' ) ) ) {
            $_tmp = $res->GetNext();
            $email = $_tmp['EMAIL'];
        } else {
            $email = 'test@interlabs.ru';
        }
        */
        $email = COption::GetOptionString( 'main', 'email_from', 'test@interlabs.ru' );
        return $email;
    }

    public static function Redirect( $url ) {
        LocalRedirect( $url );
    }//Redirect

    //редирект на текущую страницу с учётом массива $_REQUEST
    public static function RedirectByRequest($request = false) {
        if ($request === false) {
            $request = $_REQUEST;
        }
        global $APPLICATION;
        LocalRedirect($APPLICATION->GetCurPage().(empty($request) ? '' : '?'.http_build_query($request)));
    }//Redirect

    public static function Do404() {
        self::Redirect( '/404.php' );
    }//Redirect

    //получить путь к файлу по его ID
    public static function GetFile( $fileId ) {
        if( !( $fileId > 0 ) ) {
            return false;
        }
        return CFile::GetPath( $fileId );
    }//GetFile

    public static function IsAuthorized() {
        global $USER;
        return $USER->IsAuthorized();
    }//IsAuthorized

    //Добавить элемент в хлебные крошки
    public static function AddChain( $name, $url = false ) {
        global $APPLICATION;
        $APPLICATION->AddChainItem( $name, $url );
    }//AddChain

    //itemCharacteristics: ассоциативный список параметров вида array( array("NAME" => "Цвет", "CODE" => "CLR", "VALUE" => "красный") )
    public static function AddItemToBasket( $itemId, $quantity, $itemCharacteristics = array() ) {
        CModule::IncludeModule( 'catalog' );
        return Add2BasketByProductID( $itemId, $quantity, $itemCharacteristics );
    }//AddItemToBasket

    public static function SetTitle( $title ) {
        global $APPLICATION;
        $APPLICATION->SetTitle( $title );
    }//SetTitle

    public static function GetTitle() {
        global $APPLICATION;
        return $APPLICATION->GetTitle();
    }//GetTitle

    public static function ShowTitle() {
        global $APPLICATION;
        return $APPLICATION->ShowTitle();
    }//ShowTitle

    //формирование скриптов/кнопок редактирования элемента инфоблока
    //возвращает id, который необходимо подставить в его DOM-представление
    public static function GetIBlockElementEditLink( $itemId, $iblockId ) {
        static $randNumber = 0;
        static $component = false;
        if( $component === false ) {
            self::IncludeModule( 'iblock' );
            $component = new CBitrixComponent();
            $component->initComponent( 'bitrix:news.list' );
        }
        ++$randNumber;
        $q = ( $randNumber ).'_'.( $itemId ).'_'.( $iblockId );
        $arButtons = CIBlock::GetPanelButtons( $iblockId, $itemId, 0, array( 'SECTION_BUTTONS' => false, 'SESSID' => false ) );
        $component->AddEditAction( $itemId.'_'.$q, $arButtons['edit']['edit_element']['ACTION_URL'], CIBlock::GetArrayByID( $iblockId, 'ELEMENT_EDIT' ) );
        $component->AddDeleteAction( $itemId.'_'.$q, $arButtons['edit']['delete_element']['ACTION_URL'], CIBlock::GetArrayByID( $iblockId, 'ELEMENT_DELETE' ) );
        return $component->GetEditAreaId( $itemId."_".$q );
    }//GetIBlockElementEditLink

    //mailEventType: тип почтового события
    //parametersList: список параметров, вставляемых в шаблон письма
    public static function SendMailBitrix( $mailEventType = 'FEEDBACK_FORM', $parametersList = array() ) {
        $parameters = ( array ) $parametersList + array( 'DEFAULT_EMAIL_FROM' => self::GetDefaultEmail(), 'PICTURE_LOGO' => self::GetBaseRef().'image/logo-big.png' );
        return CEvent::Send( $mailEventType, SITE_ID, $parameters );
    }//SendMailBitrix

    //забирает все значения блока config
    private static $configValuesList = array();
    private static function InitConfigValues() {
        self::IncludeModule( 'iblock' );
        $res = CIBlockElement::GetList( array(), array( 'ACTIVE' => 'Y', 'IBLOCK_CODE' => 'config' ), false, false, array( 'ID', 'PROPERTY_VALUE', 'PROPERTY_CODE' ) );
        while ($value = $res->Fetch()) {
            self::$configValuesList[$value['PROPERTY_CODE_VALUE']] = $value;
        }
    }//InitConfigValues

    //возвращает значение параметра "VALUE" инфоблока "configs" по указанному параметру "CODE"
    public static function GetValue( $code, $field = 'PROPERTY_VALUE' ) {
        if( empty( $code ) ) {
            return false;
        }
        if ($field !== 'PROPERTY_VALUE') {
            self::IncludeModule( 'iblock' );
            $res = CIBlockElement::GetList( array(), array( 'ACTIVE' => 'Y', 'IBLOCK_CODE' => 'config', 'PROPERTY_CODE' => $code ), false, false, array( 'ID', $field ) );
            if( !$res ) {
                return false;
            }
            $result = $res->Fetch();
            return (isset($result[$field.'_VALUE']) ? $result[$field.'_VALUE'] : $result[$field]);
        }
        return self::$configValuesList[$code]['PROPERTY_VALUE_VALUE'];
    }//GetValue

    //получить элемент инфоблока, свериться с ID инфоблока, при ошибках редирект на 404
    public static function GetIBlockElement( $itemId, $iblockId = false, $do404 = false, $propertiesList = array() ) {
        if( !( $itemId > 0 ) ) {
            if( $do404 === true ) {
                self::Do404();
            }
            return false;
        }
        $itemId = ( int ) $itemId;
        self::IncludeModule( 'iblock' );
        $res = CIBlockElement::GetByID( $itemId );
        if( !$res ) {
            if( $do404 === true ) {
                self::Do404();
            }
            return false;
        }
        $item = $res->GetNext();
        if( $iblockId !== false && $item['IBLOCK_ID'] != $iblockId ) {
            if( $do404 === true ) {
                self::Do404();
            }
            return false;
        }
        if( !empty( $propertiesList ) ) {
            $arFields = array();
            foreach( $propertiesList as $name ) {
                $arFields[] = 'PROPERTY_'.( $name );
            }
            $res = CIBlockElement::GetList( array(), array( 'ID' => $item['ID'] ), false, false, $arFields );
            $itemProps = $res->Fetch();
            $item += ( array ) $itemProps;
        }
        return $item;
    }//GetIBlockElement

    //получить раздел инфоблока, свериться с ID инфоблока, при ошибках редирект на 404
    public static function GetIBlockSection( $sectionId, $iblockId = false, $do404 = false, $propertiesList = array(), $userFieldsList = array() ) {
        if( !( $sectionId > 0 ) ) {
            if( $do404 === true ) {
                self::Do404();
            }
            return false;
        }
        $sectionId = ( int ) $sectionId;
        self::IncludeModule( 'iblock' );
        $res = CIBlockSection::GetByID( $sectionId );
        if( !$res ) {
            if( $do404 === true ) {
                self::Do404();
            }
            return false;
        }
        $section = $res->GetNext();
        if( $iblockId !== false && $section['IBLOCK_ID'] != $iblockId ) {
            if( $do404 === true ) {
                self::Do404();
            }
            return false;
        }
        if( !empty( $propertiesList ) || !empty( $userFieldsList ) ) {
            $arFields = array();
            foreach( $propertiesList as $name ) {
                $arFields[] = 'PROPERTY_'.( $name );
            }
            foreach( $userFieldsList as $name ) {
                $arFields[] = 'UF_'.( $name );
            }
            $res = CIBlockSection::GetList( array(), array( 'ID' => $section['ID'], 'IBLOCK_ID' => $iblockId ), false, $arFields );
            $itemProps = $res->Fetch();
            $section += ( array ) $itemProps;
        }
        return $section;
    }//GetIBlockSection

    //список разделов инфоблока
    public static function GetIBlockSectionsList( $iblockId, $extraFilter = array(), $keyFieldName = 'ID', $selectFields = array('*', 'UF_*') ) {
        self::IncludeModule( 'iblock' );
        $result = array();
        $res = CIBlockSection::GetList(array('SORT' => 'ASC', 'NAME' => 'ASC'), array('IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y') + ( array ) $extraFilter, false, $selectFields);
        while( $section = $res->Fetch() ) {
            $result[ $section[ $keyFieldName ] ] = $section;
        }
        return $result;
    }//GetIBlockSectionsList

    //получить список элементов и вернуть массивом с заданным ключом
    public static function GetIblockElementsList( $arSort = array( 'SORT' => 'ASC', 'NAME' => 'ASC' ), $arFilter = array(), $keyFieldName = 'ID', $arSelectFields = array( 'ID', 'NAME' ) ) {
        self::IncludeModule( 'iblock' );
        $result = array();
        $res = CIBlockElement::GetList( $arSort, $arFilter, false, false, $arSelectFields );
        while( $item = $res->Fetch() ) {
            $result[ $item[ $keyFieldName ] ] = $item;
        }
        return $result;
    }//GetIblockElementsList

    public static function GetBaseRef() {
        static $ref = null;
        if( $ref === null ) {
            $ref = 'http://'.( $_SERVER['HTTP_HOST'] ).'/';
        }
        return $ref;
    }//GetBaseRef

    public static function HideH1() {
        echo '<style>.text-content h1.js-first { display: none; }</style>';
    }//HideH1

    public static function SetH1( $h1 ) {
        global $APPLICATION;
        $APPLICATION->SetPageProperty( 'h1', $h1 );
    }//SetH1

    public static function ShowH1() {
        global $APPLICATION;
        $APPLICATION->ShowTitle( 'h1' );
    }//ShowH1

    //отобразить ссылку "Оплата и доставка"
    public static function ShowLinkDelivery() {
        echo '<style>.wrapper .btn-right.app-link-delivery { display: block; }</style>';
    }

    //разбивка строк разного формата в массив [lat, lng] (например, "123.456,321.654" или "123.456 321.654")
    public static function ParseCoords( $coordsStr ) {
        list( $lat, $lng ) = explode( ' ', trim( preg_replace( '/[,\s]+/', ' ', $coordsStr ) ) );
        return array(
            'lat' => ( float ) $lat,
            'lng' => ( float ) $lng,
        );
    }//ParseCoords

    //изменение размера изображения
    //resizeType:
    //  BX_RESIZE_IMAGE_EXACT - масштабирует в прямоугольник width/height c сохранением пропорций, обрезая лишнее
    //  BX_RESIZE_IMAGE_PROPORTIONAL - масштабирует с сохранением пропорций, размер ограничивается width/height
    //  BX_RESIZE_IMAGE_PROPORTIONAL_ALT - масштабирует с сохранением пропорций, размер ограничивается width/height, улучшенная обработка вертикальных картинок
    public static function ResizePicture( $pictureId, $width, $height, $resizeType = BX_RESIZE_IMAGE_EXACT, $quality = 100 ) {
        if( !( $pictureId > 0 ) ) {
            return false;
        }
        $result = CFile::ResizeImageGet( $pictureId, array( 'width' => $width, 'height' => $height ), $resizeType, false, false, false, $quality );
        return $result['src'];
    }//ResizePicture

    //создание объекта капчи, вывод капчи
    public static function CreateCapcha( $writePicture = false ) {
        include_once( self::$documentRoot."/bitrix/modules/main/classes/general/captcha.php" );
        $capcha = new CCaptcha();
        $capcha->SetCode();
        if( $writePicture ) {
            echo
                '<input type="hidden" name="captcha_sid" value="'.( $capcha->GetSID() ).'">'
                .'<img src="/bitrix/tools/captcha.php?captcha_code='.( $capcha->sid ).'" width="180" height="40" alt="CAPTCHA" />'
                ;
        }
        return $capcha;
    }//CreateCapcha

    //проверка на наличие куки, устанавливаемые при движении мыши (типа капча)
    static function CheckMouseMove() {
        $cookieName = md5( 'insat-site'.date( 'd.m.Y', time() ) );
        return isset( $_COOKIE[ $cookieName ] )
            && $_COOKIE[ $cookieName ] == md5( 'insat-site'.date( 'd.m.Y', time() ).'u60pjhyouh;wp897uyp9jyh9o0' )
            ;
    }//CheckMouseMove

    //проверка капчи
    public static function CheckCapcha( $customRequestData = false ) {
        $request = ( is_array( $customRequestData ) ? $customRequestData : $_REQUEST );
        include_once( self::$documentRoot."/bitrix/modules/main/classes/general/captcha.php" );
        $capcha = new CCaptcha();
        return $capcha->CheckCode( $request['captcha_word'], $request['captcha_sid'] );
    }//CheckCapcha

    //получение кода параметра инфоблока
    public static function GetIBlockPropertyID( $iblockId, $parameterCode ) {
        $res = CIBlockProperty::GetList( array(), array( 'IBLOCK_ID' => $iblockId, 'CODE' => $parameterCode ) );
        if( !$res ) {
            return 0;
        }
        $propertyInfo = $res->GetNext();
        return ( int ) $propertyInfo['ID'];
    }//GetIBlockPropertyID

    //получение списка значений параметра инфоблока
    public static function GetIBlockPropertyValues( $iblockId, $parameterCode, $sort = array() ) {
        $res = CIBlockProperty::GetList( array(), array( 'IBLOCK_ID' => $iblockId, 'CODE' => $parameterCode ) );
        if( !$res ) {
            return 0;
        }
        $propertyInfo = $res->GetNext();
        $result = array();
        $res = CIBlockPropertyEnum::GetList( $sort, array( 'PROPERTY_ID' => $propertyInfo['ID'] ) );
        while( $prop = $res->GetNext() ) {
            $result[ $prop['ID'] ] = $prop;
        }
        return $result;
    }//GetIBlockPropertyValues

    //получение кода значения параметра инфоблока, если параметр - список
    public static function GetIBlockPropertyValueID( $iblockId, $parameterCode, $xmlID ) {
        $res = CIBlockProperty::GetList( array(), array( 'IBLOCK_ID' => $iblockId, 'CODE' => $parameterCode ) );
        $propertyInfo = $res->GetNext();
        if( !$propertyInfo ) {
            return 0;
        }
        $res = CIBlockPropertyEnum::GetList( array(), array( 'PROPERTY_ID' => $propertyInfo['ID'], 'XML_ID' => $xmlID ) );
        $valueInfo = $res->GetNext();
        return ( int ) $valueInfo['ID'];
    }//GetIBlockPropertyValueID

    //Инициализация текущего города
    //Определяется, необходимо ли показывать popup-предложение подтверждения региона
    public static $regionsList = array();
    public static $regionCookieName = 'vistex-region-id';
    const SAVE_REGION_IN_COOKIES = true; //сохраняться ли регион в куки и устанавливать по умолчанию
    public static function InitRegion() {
        if( empty( self::$regionsList ) ) {
            self::IncludeModule( 'iblock' );
            $res = CIBlockElement::GetList( array( 'SORT' => 'ASC', 'NAME' => 'ASC' ), array( 'ACTIVE' => 'Y', 'IBLOCK_ID' => Config::IBLOCK_CITIES ), false, false, array( 'ID', 'IBLOCK_SECTION_ID', 'NAME', 'PREVIEW_TEXT', 'PROPERTY_COORDS' ) );
            while( $region = $res->Fetch() ) {
                self::$regionsList[ $region['ID'] ] = $region;
            }
        }
        $regionSelected = false;
        if( self::IsAjax() || self::SAVE_REGION_IN_COOKIES ) {
            if( $_COOKIE[ self::$regionCookieName ] ) {
                $activeRegion = ( int ) $_COOKIE[ self::$regionCookieName ];
                $regionSelected = true;
            } else if( $_SESSION[ self::$regionCookieName ] ) {
                $activeRegion = ( int ) $_SESSION[ self::$regionCookieName ];
                $regionSelected = true;
            } else {
                $activeRegion = ( int ) reset( array_keys( self::$regionsList ) );
            }
        } else {
            if( isset( $_REQUEST['POINT'] ) && $_REQUEST['POINT'] && isset( self::$regionsList[ $_REQUEST['POINT'] ] ) ) {
                $activeRegion = ( int ) $_REQUEST['POINT'];
            } else {
                $activeRegion = ( int ) reset( array_keys( self::$regionsList ) );
            }
        }
        $region = self::$regionsList[ $activeRegion ];
        self::SetParms( 'regionSelected', $regionSelected );
        self::SetParms( 'regionName', $region['NAME'] );
        self::SetParms( 'region', $region );
        self::SetParms( 'regionId', $region['ID'] );
        setcookie( Tools::$regionCookieName, $region['ID'], 0, '/' );
        $_SESSION[ Tools::$regionCookieName ] = $region['ID'];
    }//InitRegion
    public function humanFileSize($size,$unit="") {
        if( (!$unit && $size >= 1<<30) || $unit == "ГБ")
            return number_format($size/(1<<30),2)." ГБ";
        if( (!$unit && $size >= 1<<20) || $unit == "МБ")
            return number_format($size/(1<<20),2)." МБ";
        if( (!$unit && $size >= 1<<10) || $unit == "КБ")
            return number_format($size/(1<<10),2)." КБ";
        return number_format($size)." Б ";
    }
    //возвращает название класса для отображения иконка файла
    public static function GetFileTypeIconClass( $fileName, $defaultClass = 'pdf' ) {
        static $extension2class = array(
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'xls' => 'excel',
        );
        $info = pathinfo( $fileName );
        $ext = strtolower( $info['extension'] );
        return ( isset( $extension2class[ $ext ] ) ? $extension2class[ $ext ] : $defaultClass );
    }//GetFileTypeIconClass

    private static $documentRootStack = array();
    public static function PushDocRoot() {
        self::$documentRootStack[] = $_SERVER['DOCUMENT_ROOT'];
        $_SERVER['DOCUMENT_ROOT'] = self::$documentRoot;
    }//PushDocRoot

    public static function PopDocRoot() {
        $count = count( self::$documentRootStack );
        $_SERVER['DOCUMENT_ROOT'] = self::$documentRootStack[ $count - 1 ];
        unset( self::$documentRootStack[ $count - 1 ] );
    }//PushDocRoot

    private static $catalogVisitedItems = false;
    public static function AddVisitedItem( $itemId ) {
        $itemId = ( int ) $itemId;
        if( !( $itemId > 0 ) ) {
            return;
        }
        $catalogId = self::GetCatalogIBlockID();
        while( in_array( $itemId, self::$catalogVisitedItems[ $catalogId ] ) ) {
            unset( self::$catalogVisitedItems[ $catalogId ][ array_search( $itemId, self::$catalogVisitedItems[ $catalogId ] ) ] );
        }
        self::$catalogVisitedItems[ $catalogId ][ $itemId ] = $itemId;
        self::$catalogVisitedItems[ $catalogId ] = array_reverse( array_slice( array_reverse( self::$catalogVisitedItems[ $catalogId ], true ), 0, Config::CATALOG_MAX_COUNT_VISITED_ITEMS ), true );
        foreach( self::$catalogVisitedItems[ $catalogId ] as $key => $value ) {
            if( !( $value > 0 ) ) {
                unset( self::$catalogVisitedItems[ $catalogId ][ $key ] );
            }
        }
        setcookie( Config::PROJECT_NAME.'-visited-items', serialize( self::$catalogVisitedItems ), 0, '/' );
    }//AddVisitedItem

    public static function GetVisitedItems() {
        if( self::$catalogVisitedItems === false ) {
            self::$catalogVisitedItems = ( array ) unserialize( $_COOKIE[ Config::PROJECT_NAME.'-visited-items' ] );
        }
        return self::$catalogVisitedItems[ self::GetCatalogIBlockID() ];
    }//GetVisitedItems

    //получить код видео ролика из ссылки
    public static function GetYouTubeId( $href, $defaultValue = false ) {

        if( preg_match( '/^http:\/\/(www\.)?youtube\.com\/.*?[&?]v=(.*?)(($)|([&]))/i', $href, $tmp )   //http://www.youtube.com/?v=###
          || preg_match( '/^http:\/\/(www\.)?youtu\.be\/(.+)$/i', $href, $tmp )             //http://youtu.be/###
          || preg_match( '/^http:\/\/(www\.)?youtube\.com\/embed\/(.+)$/i', $href, $tmp )   //http://www.youtube.com/embed/###
          || preg_match( '/^https:\/\/(www\.)?youtube\.com\/.*?[&?]v=(.*?)(($)|([&]))/i', $href, $tmp )   //http://www.youtube.com/?v=###
          || preg_match( '/^https:\/\/(www\.)?youtu\.be\/(.+)$/i', $href, $tmp )             //http://youtu.be/###
          || preg_match( '/^https:\/\/(www\.)?youtube\.com\/embed\/(.+)$/i', $href, $tmp )   //http://www.youtube.com/embed/###
          ) {
            return $tmp[2];
        }
        return $defaultValue;
    }//GetYouTubeId

    //получить url картинки-превью для ролика
    public static function GetYouTubeThumbnailUrl( $videoCode ) {
        return ( empty( $videoCode ) ? false : 'http://img.youtube.com/vi/'.( $videoCode ).'/hqdefault.jpg' );
    }//GetYouTubeThumbnailUrl

    //получить видеофрейма по урлу
    public static function GetYouTubeVideo( $videostring,$width = 560, $height = 315 ) {
        return "<iframe width=\"".$width."\" height=\"".$height."\" src=\"https://www.youtube.com/embed/".self::GetYouTubeId($videostring)."\" frameborder=\"0\" allowfullscreen></iframe>";
    }//GetYouTubeVideo

    //список типов пользователей (физ, юр)
    public static function GetUserTypeList() {
        static $typesList = false;
        if( $typesList === false ) {
            $typesList = array();
            $res = CUserFieldEnum::GetList(array(), array('USER_FIELD_NAME' => 'UF_USER_TYPE'));
            while( $type = $res->Fetch() ) {
                $typesList[ $type['XML_ID'] ] = $type;
            }
        }
        return $typesList;
    }//GetUserTypeList

    //компания или частное лицо
    public static function IsCompany() {
        if( !self::IsAuthorized() ) {
            return false;
        }
        global $USER;
        $res = CUser::GetList($by, $order, array('ID' => $USER->GetID()), array('SELECT' => array('UF_*')));
        $userInfo = $res->Fetch();
        $userTypesList = self::GetUserTypeList();
        return ( $userInfo['UF_USER_TYPE'] == $userTypesList['COMPANY']['ID'] );
    }//IsCompany

    //приведение номера телефона к ссылочному виду
    public static function GetPhoneClean() {
        $phone = trim( preg_replace('/[^0-9]/', '', self::GetValue('TOP_PHONE')));
        preg_match('/^([0-9])([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})$/', $phone, $tmp);
        return '+'.$tmp[1].substr($phone, -10);
    }//GetPhoneClean

    //на всякий случай т.к незнаю где может еще использоваться
    public static function GetPhoneClean2($phone) {
        $phone = trim( preg_replace('/[^0-9]/', '', $phone));
        preg_match('/^([0-9])([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})$/', $phone, $tmp);
        return '+'.$tmp[1].substr($phone, -10);
    }//GetPhoneClean

    //древовидная структура меню
    //можно указать несколько типов меню, тогда они смержатся. сделано для страницы 404
    const MENU_TREE_ITEM_TYPE_UNKNOWN   = -1;
    const MENU_TREE_ITEM_TYPE_TREE      = 0;
    const MENU_TREE_ITEM_TYPE_SINGLE    = 1;
    public static function GetFullMenuTree($menuTypesList = array('top' => 'top')) {
        $menu = array();
        foreach ($menuTypesList as $type => $subType) {
            $menu = array_merge_recursive($menu, self::GetMenuTree($type, '/', $subType));
        }
        return self::__FixMenuDuplicates($menu);
    }//GetFullMenuTree

    //удалить дубликаты полей, появившихся из-за array_merge_recursive()
    private static function __FixMenuDuplicates($menu) {
        foreach ($menu as $id => $item) {
            if (is_array($item['NAME'])) {
                $menu[$id]['NAME'] = reset($item['NAME']);
            }
            $menu[$id]['SUBMENU'] = self::__FixMenuDuplicates($item['SUBMENU']);
        }
        return $menu;
    }//__FixMenuDuplicates

    //формирование дерева меню заданного типа
    public static function GetMenuTree($menuType = 'top', $dirName = '/', $subType = false) {
        $main = new CMain();
        if (!file_exists(self::$documentRoot.$dirName.'.'.$menuType.'.menu.php')) {
            return array();
        }
        $cMenu = $main->GetMenu($menuType, false, false, $dirName);
        $menu = array();

        foreach ($cMenu->arMenu as $item) {
            $name = $item[0];
            $link = $item[1];
            $menu[$link] = array(
                'NAME' => $name,
                'SUBMENU' => self::GetMenuTree($subType === false ? $type : $subType, $link),
            );
        }

        unset($main);
        return $menu;
    }//GetMenuTree

    //преобразовать get-параметры в URL
    public static function ModifyUrl($url, $setParms = array(), $unsetParms = array()) {
        $urlPath = parse_url($url, PHP_URL_PATH);

        $query = (array) $_REQUEST;
        foreach ($setParms as $name => $value) {
            $query[$name] = $value;
        }
        foreach ($unsetParms as $paramName) {
            unset($query[$paramName]);
        }
        $url = $urlPath.(empty($query) ? '' : '?'.http_build_query($query));
        return $url;
    }//ModifyUrl

    public static function GetCatalogSectionIdByXMLID($XML_ID, $iblockId = Config::IBLOCK_CATALOG) {
        $res = CIBlockSection::GetList(array(), array('XML_ID' => $XML_ID, 'IBLOCK_ID' => $iblockId), false, array('ID', 'IBLOCK_SECTION_ID'));
        $section = $res->Fetch();
        while ($section['IBLOCK_SECTION_ID']) {
            $res = CIBlockSection::GetList(array(), array('ID' => $section['IBLOCK_SECTION_ID'], 'IBLOCK_ID' => $iblockId), false, array('ID', 'IBLOCK_SECTION_ID'));
            $section = $res->Fetch();
        }
        return $section['ID'];
    }//GetCatalogSectionIdByXMLID

    //возвращает строку с ценой товара и символом валюты
    //$priceWrapperTagName - обернуть число в html-тег
    //$precision - округление до указанного числа
    public static function GetItemPriceText($item, $precision = 2, $priceWrapperTagName = false, $currencyWrapperTagName = false) {
        static $currencyToSymbol = array(
            'RUB' => '&#8381;',
            'USD' => '$',
            'EUR' => '&euro;',
        );
        if (isset($item['PRICES']['BASE'])) {
            $price = (float) $item['PRICES']['BASE']['VALUE'];
            $currency = $item['PRICES']['BASE']['CURRENCY'];
        } else if (isset($item['CATALOG_PRICE_'.self::GetCatalogPriceTypeID()])) {
            $price = (float) $item['CATALOG_PRICE_'.self::GetCatalogPriceTypeID()];
            $currency = $item['CATALOG_CURRENCY_'.self::GetCatalogPriceTypeID()];
        } else {
            $price = (float) $item['PRICE'];
            $currency = $item['CURRENCY'];
        }
        return
            ($priceWrapperTagName === false ? '' : '<'.$priceWrapperTagName.'>')
            .number_format($price, $precision, '.', ' ')
            .($priceWrapperTagName === false ? '' : '</'.preg_replace('/\s.+$/', '', $priceWrapperTagName).'>')
            .($currencyWrapperTagName === false ? '' : '<'.$currencyWrapperTagName.'>')
            //.' '.$currencyToSymbol[$currency]
            .($currencyWrapperTagName === false ? '' : '</'.preg_replace('/\s.+$/', '', $currencyWrapperTagName).'>')
        ;
    }//GetItemPriceText

    //ID типа цены
    public static function GetCatalogPriceTypeID() {
        return 1;
    }//GetCatalogPriceTypeID

    //возвращает первое существующее изображение из списка, либо заглушку
    public static function SelectPicture($picturesList = array()) {
        foreach ($picturesList as $picture) {
            if (strlen($picture) && file_exists(self::$documentRoot.'/'.ltrim($picture, '/'))) {
                return $picture;
            }
        }
        return Config::DEFAULT_PICTURE;
    }//SelectPicture

    //сформировать список параметров, по которым возможно фильтровать товары раздела
    static private $catalogFiltersBySectionID = array();
    public static function GetCatalogFilters($sectionId, $skipParameters = false, $brandId = false) {
        $sectionIdSerialized = serialize($sectionId).serialize($skipParameters).serialize($brandId);
        if (isset(self::$catalogFiltersBySectionID[$sectionIdSerialized])) {
            return self::$catalogFiltersBySectionID[$sectionIdSerialized];
        }

        $result = array();
        $filtersList = array();
        $brandsList = array();
        $currenciesList = array();
        $pricesRange = array(
            'min' => array(),
            'max' => array(),
        );
        if (!$sectionId) {
            return $filtersList;
        }

        //id всех товаров раздела
        $res = CIBlockElement::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_ID' => Config::IBLOCK_1C_CATALOG, 'SECTION_ID' => $sectionId), false, false, array('ID', 'PROPERTY_BRAND'));
        $idsList = array();
        $brandsIds = array();
        while ($item = $res->Fetch()) {
            $idsList[$item['ID']] = $item['ID'];
            if ($item['PROPERTY_BRAND_VALUE']) {
                $brandsIds[$item['PROPERTY_BRAND_VALUE']] = $item['PROPERTY_BRAND_VALUE'];
            }
        }

        if (empty($idsList)) {
            return $filtersList;
        }

        //все параметры всех товаров
        if (!$skipParameters) {
            self::IncludeModule('sale');
            $res = CIBlockElement::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_ID' => Config::IBLOCK_CATALOG_PARAMETERS, 'PROPERTY_ITEM' => $idsList), false, false, array('ID', 'PROPERTY_PARAMETER', 'PROPERTY_VALUE'));
            while ($parameter = $res->Fetch()) {
                $filtersList[$parameter['PROPERTY_PARAMETER_ENUM_ID']][$parameter['PROPERTY_VALUE_VALUE']] = $parameter['PROPERTY_VALUE_VALUE'];
            }
            foreach ($filtersList as $id => $valuesList) {
                if (count($valuesList) < 2) {
                    unset($filtersList[$id]);
                } else {
                    sort($filtersList[$id]);
                }
            }

            //подробная информация о параметрах
            $parametersList = self::GetIBlockPropertyValues(Config::IBLOCK_CATALOG_PARAMETERS, 'PARAMETER', array('SORT' => 'ASC', 'ID' => 'ASC'));

            //сортировка параметров
            $sortedFiltersList = array();
            foreach ($parametersList as $parameter) {
                if (isset($filtersList[$parameter['ID']])) {
                    $sortedFiltersList[$parameter['ID']] = $filtersList[$parameter['ID']];
                }
            }

            //бренды
            if (!empty($brandsIds)) {
                $res = CIBlockElement::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_ID' => Config::IBLOCK_CATALOG_BRANDS, 'ID' => $brandsIds), false, false, array('ID', 'NAME'));
                while ($parameter = $res->Fetch()) {
                    $brandsList[$parameter['ID']] = $parameter['NAME'];
                }
            }
        }

        //список валют
        $order = 'sort';
        $dir = 'ASC';
        $res = CCurrency::GetList($order, $dir);
        while ($currency = $res->Fetch()) {
            $currenciesList[] = $currency['CURRENCY'];
        }

        //диапазон цен по всем валютам
        $filterAdd = array();
        if ($brandId) {
            $filterAdd['PROPERTY_BRAND'] = $brandId;
        }
        $priceTypeId = self::GetCatalogPriceTypeID();
        $res = CIBlockElement::GetList(array('CATALOG_PRICE_'.$priceTypeId => 'ASC'), array('ACTIVE' => 'Y', 'IBLOCK_ID' => Config::IBLOCK_1C_CATALOG, 'SECTION_ID' => $sectionId) + $filterAdd, false, false, array('ID', 'CATALOG_GROUP_'.$priceTypeId));
        $item = $res->Fetch();
        $pricesRange['min'][$item['CATALOG_CURRENCY_'.$priceTypeId]] = round(( float ) $item['CATALOG_PRICE_'.$priceTypeId]);
        $sourceMinCurrency = $item['CATALOG_CURRENCY_'.$priceTypeId];

        $res = CIBlockElement::GetList(array('CATALOG_PRICE_'.$priceTypeId => 'DESC'), array('ACTIVE' => 'Y', 'IBLOCK_ID' => Config::IBLOCK_1C_CATALOG, 'SECTION_ID' => $sectionId) + $filterAdd, false, false, array('ID', 'CATALOG_GROUP_'.$priceTypeId));
        $item = $res->Fetch();
        $pricesRange['max'][$item['CATALOG_CURRENCY_'.$priceTypeId]] = round(( float ) $item['CATALOG_PRICE_'.$priceTypeId]);
        $sourceMaxCurrency = $item['CATALOG_CURRENCY_'.$priceTypeId];

        foreach ($currenciesList as $currency) {
            if (!isset($pricesRange['min'][$currency])) {
                $pricesRange['min'][$currency] = round(CCurrencyRates::ConvertCurrency($pricesRange['min'][$sourceMinCurrency], $sourceMinCurrency, $currency));
            }
            if (!isset($pricesRange['max'][$currency])) {
                $pricesRange['max'][$currency] = round(CCurrencyRates::ConvertCurrency($pricesRange['max'][$sourceMaxCurrency], $sourceMaxCurrency, $currency));
            }
        }

        //текстовые обозначения валют
        $currenciesText = array();
        foreach ($currenciesList as $currency) {
            $currenciesText[$currency] = self::GetValue('CURRENCY_'.$currency);
        }

        //результат
        //$result['parameters'] = $parametersList;
       // $result['filters'] = $sortedFiltersList;
       // $result['brands'] = $brandsList;
        $result['prices'] = $pricesRange;
       // $result['currencies'] = $currenciesList;
       // $result['currencies_text'] = $currenciesText;

        self::$catalogFiltersBySectionID[$sectionIdSerialized] = $result;
        return $result;
    }//GetCatalogFilters

    //обрезка текста до нужной длины до конца слова
    public static function Cut( $text, $maxLength = 100, $postFix = '...', $cutByWord = false ) {
        if( $cutByWord ) {
            return ( mb_strlen( $text, 'UTF-8' ) <= $maxLength ? $text : preg_replace( '/^(.{'.( ( int ) $maxLength ).'}.*?)[\.\,\!\?\s\-\+\:\"\'\<\>\[\]\(\)\{\}\*\&\^\%\$\#\№\@].*$/', '\\1', $text ).$postFix );
        }
        return ( mb_strlen( $text, 'UTF-8' ) <= $maxLength ? $text : mb_substr( $text, 0, $maxLength, 'UTF-8' ).$postFix );
    }//Cut
    
    //Проверяем наличие в каталоге элемента(подкаталога), для секций
    //Действительно для сата insat.ru 
    public static function CheckParents($parent = false, $idElement){
      $IBLOCK_ID = 10;
      $res = false;
      if($parent){
        $rs = CIBlockSection::GetList(
           array(),
           array('ID'=>$parent,'IBLOCK_ID'=>$IBLOCK_ID)
        );
          $ar = $rs->GetNext();
          $res = CIBlockSection::GetList(
               array('LEFT_MARGIN'=>'ASC'),
               array(
                  'IBLOCK_ID'=>$IBLOCK_ID,
                  '>LEFT_MARGIN'=>$ar['LEFT_MARGIN'],
                  '<RIGHT_MARGIN'=>$ar['RIGHT_MARGIN'],
               ),
               false,
               array('ID','NAME','XML_ID')
            );
          while( $item = $res->Fetch() ) {
              $result[ $item['XML_ID'] ] = $item;
          }
       // $items = self::GetIblockElementsList(array(),array('IBLOCK_ID'=>10,'SECTION_ID'=>(int)$parent,'INCLUDE_SUBSECTIONS'=>'Y'),'ID',array('ID','NAME','XML_ID'));
        //die(print_r($result));
       $res = in_array((int)$idElement , array_keys($result)); 
      }
      
      return $res;
    }//CheckParents
    //возвращает название раздела сайта для страницы поиска
    public static function GetSearchPartNameByType($moduleId, $itemId = 0) {
        static $partNameByIblock = array(
          Config::IBLOCK_NEWS => 'В новостях',
          Config::IBLOCK_OPINIONS=>'В отзывах',
          Config::IBLOCK_SHARES=>'В Акциях',
        );
        switch ($moduleId) {
            case 'iblock': {
                if (isset($partNameByIblock[$itemId])) {
                    return $partNameByIblock[$itemId];
                }
            } break;
        }
        return 'На страницах сайта';
    }//GetSearchPartNameByType
    
    
    //проверяем попадает ли текущий товар в нужную секцию
    public static function CheckItem($parent = false, $idElement){
      $IBLOCK_ID = 10;
      $res = false;
      if($parent){
        $items = self::GetIblockElementsList(array(),array('SECTION_ID'=>$parent,'IBLOCK_ID'=>$IBLOCK_ID,'INCLUDE_SUBSECTIONS'=>'Y'),'XML_ID',array('ID','NAME','XML_ID'));
        $res = in_array((int)$idElement , array_keys($items));
      }
      
      return $res;
    }

    //социальные иконки
    public static  function GetSocIcon(){
        return file_get_contents(self::$documentRoot.'/includes/content/social-icons.php');
    }

    //Форматируем размер файла


    
}//Tools

Tools::Init();
