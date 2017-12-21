// JavaScript-код для новостей.
//
define([
  'jquery'
], function ($) {

  "use strict";
  var
    $ajaxPageContent = $('#lazy'),
    $preloader = $('.load'),
    $pageCount = $ajaxPageContent.data('page'),
    senderObj = {PAGEN_1: 2, AJAX_PAGE: 'Y'},
    inProgress = false,
    isFinal = false,
    onlyMobile =  $ajaxPageContent.is('[mobile]'),
    fixPos = $ajaxPageContent.data('fix')|0,// фикс скрола где это нужно
    isMobile = $(window).width()<=425; //проверка только на моб версии подгрузка
  $(function() {


    if (senderObj.PAGEN_1 <= $pageCount ) {
      if(!onlyMobile){ // когда нет ключа только для моб
        lazyLoad(); 
      }else if(isMobile){
        $('.pagination').hide();//Убираем пагинацию, дизы белены объелись
        lazyLoad(); // когда есть ключ и моб версия
      }
    }

  });
  //для ИЕ
  function posTop() {
    return typeof window.pageYOffset != 'undefined' ? window.pageYOffset: document.documentElement.scrollTop? document.documentElement.scrollTop: document.body.scrollTop? document.body.scrollTop:0;
  }
  function isEnd() {
// корректируем положение относительно начала +
    var contentHeight = $ajaxPageContent.height() ;
    //+ $ajaxPageContent.offset().top; если 
  //корректируем относительно конца контейнера
    var windowScroll = $(document).scrollTop()+50;

    // верхняя граница elem в пределах видимости ИЛИ нижняя граница видима
    var topVisible = contentHeight > 0 && windowScroll >= contentHeight-fixPos;

    return topVisible;
  }
  function lazyLoad() {
    $(document).scroll(function(){
      //var windowScroll =  posTop();
      //var anchorPos =  $preloader.offset().top;
      if (!inProgress && !isFinal && isEnd() /*(windowScroll >= anchorPos)*/) {
        ajaxPreloader();
      }
    });
  }

	function getUrlParam(e) {
		var param = new RegExp("[?&]" + e + "=([^&#]*)").exec(window.location.href);
		return null == param ? null : decodeURI(param[1]) || 0
	}

  function ajaxPreloader() {
    $preloader.show();
    inProgress = true;
    setTimeout(ajaxGo, 500);
  }

  function ajaxGo() {
	var date = getUrlParam('DATE');
	if (date != null)
		senderObj.DATE = date;

    $.ajax({
      url: $ajaxPageContent.data('url'),
      type: 'GET',
      data: senderObj,
      success: function(response) {
        $ajaxPageContent.append(response);

        $preloader.hide();
        senderObj.PAGEN_1++;
        if (senderObj.PAGEN_1 > $pageCount) {
          isFinal = true;
        }else{

        }
      },
      complete: function() {
        inProgress = false;
      }
    });
  }
});
