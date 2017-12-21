<?
$is_component = true;
if(!defined('ERROR_404')){
  $is_component = false;
}


CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

if(!$is_component){
  require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
}
//сбрасываем цепочку
$APPLICATION->arAdditionalChain = array();
$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->AddChainItem('Страница не найдена');
//$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>

  <div class="page">
    <div class="block-group">
      <div class="block coll-3 first mw100 mw100--center-center-img">
        <img src="/image/404.png" alt="">
      </div>
      <div class="block coll-9 mw100">
        <div class="text404">
          <p><b>Запрошенная вами страница не существует или недоступна в данный момент.</b></p>
          <p>Возможно, она была перемещена, либо производится ее обновление. Возможно, вы ошиблись при наборе адреса страницы. Если вы уверены в его правильности и считаете, что эта ошибка произошла по нашей вине, пожалуйста, сообщите об этом:</p>
          <div class="form-block form-block--404">
            <h2>Обратная связь:</h2>
            <form action="/ajax/feedback.php" class="callback-form ajaxform static">
              <div class="left">
                <input name="FIO" type="text" placeholder="Ф.И.О. *">
                <input name="PHONE" type="text" placeholder="Телефон *">
                <input name="EMAIL" type="text" placeholder="E-mail *">
              </div>
              <div class="right">
                <textarea name="TEXT" placeholder="Ваше сообщение"></textarea>
                <input class="btn-submit btn-submit--red" type="submit" value="Отправить &rarr;">
              </div>
              <div class="star-small-text">* - поля, обязательные для заполнения</div>
            </form>
          </div>
          <p><b>Мы приносим свои извинения за доставленные неудобства и предлагаем следующие пути решения:</b></p>
          <ul>
            <li>Воспользоваться поиском по сайту</li>
            <li>Воспользоваться <a href="/sitemap/">картой сайта</li>
          </ul>
        </div>
        <a href="#" onclick="window.history.back();" class="btn">Вернуться назад &rarr;</a>
      </div>
    </div>
  </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>