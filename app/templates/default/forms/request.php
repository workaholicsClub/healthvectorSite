
  <div  id="request" class="form-block">
    <h2>Сделать запрос:</h2>
    <div class="js-error"></div>
    <form action="/ajax/request.php" enctype="multipart/form-data"  class="callback-form ajaxform req">

      <div class="left">
        <input name="FIO" type="text" placeholder="Ф.И.О. *">
        <input name="PHONE" type="text" placeholder="Телефон *">
        <input  name="EMAIL" type="text" placeholder="E-mail *">
        <label class="file" ><img src="/image/attach_ico.png"><input name="ATTACH"  type="file"><span class="js-name">Прикрепить файл</span></label>
      </div>
      <div class="right">
        <textarea name="TEXT" placeholder="Ваше сообщение"></textarea>
        <input class="btn-submit btn-submit--red" type="submit" value="Отправить →">
      </div>
      <div class="star-small-text">* - поля, обязательные для заполнения</div>
    </form>
  </div>