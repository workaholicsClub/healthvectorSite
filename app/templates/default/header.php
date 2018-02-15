<?php
  CModule::AddAutoloadClasses('', array('BitrixAdapter' => '/bitrixadapter/adapter.php'));
  BitrixAdapter::init();

  require_once($_SERVER["DOCUMENT_ROOT"]."/includes/tools.php");
  global $USER;
  $is404 = defined('ERROR_404') && ERROR_404 == 'Y';
  $isEditable = true;
  $isPrint = $_GET['print'] == 1;
  $curPage = $APPLICATION->GetCurDir();
  $isMainPage = ($curPage === '/');
  $isAuthorized = Tools::IsAuthorized();

  $healthVectorPage = new \HealthVector\Page($APPLICATION);

  //global $jso;
  //$jso = BFactory::getJso();
  //$jso->load('site');
  //$jso->enable('site/common');
  //$jso->enable('site/gmap');
  //$jso->enable('site/slider');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="yandex-verification" content="a669c71f3deb3d0b" />
	<meta name="google-site-verification" content="q4yyEzsoZT8n6X7xE21-L6hvHOy2UnvhqW7Zmr-NMf8" />
	<title><? $healthVectorPage->showBufferedPageTitle(); ?></title>
	<link rel="stylesheet" href="/css/site.css<?php echo '?'.filemtime($_SERVER['DOCUMENT_ROOT'].'/css/site.css'); ?>">
	<link type="text/css" rel="stylesheet" media="all" href="/css/my.css" />
	<link rel="shortcut icon" href="/favicon.ico">
	<script src="https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
	<script>
		var require = {
			baseUrl: '/js/lib'
		};
	</script>
	<script src="/js/require-jquery.js"></script>
	<script>
		require(['../app/site'], function() {
			require(['site/common', 'site/gmap', 'site/loader', 'site/news','site/places', 'site/slider', 'site/skintest'], function() {
			});
		});
	</script>
	<?php if($isEditable) $APPLICATION->ShowHead();?>
</head>
<body>

<?php if ($isEditable && !$isPrint) $APPLICATION->ShowPanel();?>

<div class="wrapper">
  <?if(!$isPrint):?>
    <div class="fixed-btn-form phone-hide"><a href=""></a></div>
  <?endif;?>
  <header class="header">
    <div class="top-header">
      <div class="page">
        <div class="phone-menu-btn"></div>
        <div class="popup-search">
          <form action="/search/">
            <input class="search-field" name="q" value="<?=$_REQUEST['q'];?>" placeholder="Я ищу..." type="text">
            <input class="search-submit" value="" type="submit">
          </form>
        </div>
        <div class="block-group">
          <div class="block coll-3 coll-4-tablet first">
            <a href="/" class="logo phone-hide"><img src="/image/logo.png" alt=""></a>
            <a href="/" class="logo phone-show"><img src="/image/LOGO.svg" alt=""></a>
          </div>
          <div class="block coll-5 coll-3-desktop coll-4-tablet phone-hide">
            <div class="header-name">Портал по реабилитации детей с ДЦП</div>
          </div>
          <div class="block coll-2 coll-3-desktop coll-3-tablet">
            <div class="header-icon-block">
              <a href="/" class="header-icon header-icon-home <?=($isMainPage?'active':'');?>"></a>
              <a href="/sitemap/" class="header-icon header-icon-map <?=($curPage == '/sitemap/'?'active':'');?>"></a>
              <a href="#request" class="header-icon header-icon-mail js-popup-req"></a>
              <a  class="header-icon header-icon-search  <?=($curPage == '/search/'?'active':'');?>"></a>
            </div>
          </div>
          <div class="block coll-2 coll-3-desktop coll-1-tablet callback-phone">
            <a href="#callback" class="header-callback js-popup"><span>Позвонить</span></a>
          </div>
        </div>
      </div>
    </div> <!--/top-header-->
    <div class="js-anchor"></div>
    <?$APPLICATION->IncludeComponent(
      "bitrix:menu",
      "top",
      Array(
        "ROOT_MENU_TYPE" => "top",
        "MAX_LEVEL" => "2",
        "CHILD_MENU_TYPE" => "top.submenu",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array()
      ),
      false
    );?>
  </header>
 <?if(!$isMainPage):?>

  <div class="middle middle--work">
    <div class="breadcrumbs">
      <div class="page">
        <?$APPLICATION->IncludeComponent(
          "bitrix:breadcrumb",
          "bread.healthvector",
          Array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "-"
          ),
          false
        );?>
      </div>
    </div>

    <div class="row-h1">
      <div class="page">
        <h1><?$healthVectorPage->showBufferedPageTitle()?></h1>
      </div>
    </div>
  <?endif;?>

