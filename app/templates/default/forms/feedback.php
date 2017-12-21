<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div  id="feedback" class="form-block full-width">
  <h2>Обратная связь</h2>
  <div class="js-error"></div>
  <form action="/ajax/feedback.php" class="callback-form ajaxform ">

    <div class="left">
      <input name="FIO" type="text" placeholder="Ф.И.О. *">
      <input name="PHONE" type="text" placeholder="Телефон *">
      <input  name="EMAIL" type="text" placeholder="E-mail *">
      <textarea name="TEXT" placeholder="Ваше сообщение"></textarea>
      <input class="btn-submit btn-submit--red" type="submit" value="Отправить →">
    </div>
    <div class="star-small-text">* - поля, обязательные для заполнения</div>
  </form>
</div>