define([
  'jquery',
  'lib/forms',
  'jquery/colorbox',
  'jquery/ikSelect',
  'jquery/flash'
], function($, forms) {

  "use strict";
  var ikParms = {
    ddFullWidth: false,
    filter: true,
    onShow:function(inst){
      inst.fakeSelect.addClass('active');
    },
    onHide:function(inst){
      inst.fakeSelect.removeClass('active');
    }
  };

  $(function() {
    forms.setup();
    stylizeSelect(".js-select-pager, .js-select", ikParms, ".select-parent .ik_select_link");
    stylizeSelect(".js-select-pager-table", ikParms, ".select-parent .ik_select_link");
    taskShow();
    search();
    mobileMenu();
    //textShow();
    calendarShow();
    accordeonReport();
    //setTest();
    initPagerSelects();
    allText();
    accordeon();
    sendForm();
    tabsCart();
    tableSort();
    videoPopup();
    requestForm();
    inputFile();
    setPopup();
    setRequest();
    setGroupTest();
    if($(document).width() > 425){
      scrollElementWithAnchor('.top-menu');
    }else{
      centeringSlide();
    }
  });
  function     setGroupTest() {
    if($('.js-open').length){
      $(document).on('click','.js-open',function(e){
        e.preventDefault();
        $(this).parent().find('.group-body').slideToggle();
      });
    }
  }
  //Данная функция как фикс для стиля object-fit
  //Так как не все телефоны его поддерживают поэтому будем изменять так
  function centeringSlide() {
    var $slides = $('.swiper-container--main-header .swiper-slide');
    if($slides.length){
      $slides.css({overflow:'hidden'});
      $slides.find('img').css({maxWidth:'initial',width:'initial', objectFit:'none',height:'auto'})
              .each(function(){
              var image = $(this), imageWidth = image.width();

                //проверяем если слайд меньше то заварачиваем( чтобы не было пустого пространства )
                if( imageWidth * 0.58 < 425 ) return;

                image.css({
                  marginLeft: - ( 0.42 * imageWidth )
                });
        });
    }
  }
  function scrollElementWithAnchor(element,anchor){
    anchor = anchor || '.js-anchor';
    var $obj = $(element),
        $anch = $(anchor),
        winTop = $("body").scrollTop(),
        anchTop =  $anch.offset().top;

    var activate = function(){
        $anch.css({height:$obj.height()});
        $obj.css({
          position:'fixed',
          top:0,
          zIndex: 1000
        })
          .attr('scrolled','');
    };

    var deactivate = function(){
      $anch.css({height:0});
      $obj.css({
        position:'static'
      })
        .removeAttr('scrolled');
    };

    function posTop() {
      return typeof window.pageYOffset != 'undefined' ? window.pageYOffset: document.documentElement.scrollTop? document.documentElement.scrollTop: document.body.scrollTop? document.body.scrollTop:0;
    }
    if(winTop>=anchTop){
      activate();
    }

    $(document).scroll(function () {

      winTop = posTop();

      if(winTop >= anchTop){
        if(!$obj.is('[scrolled]')) {
          activate();
        }
      }else if($obj.is('[scrolled]')){
        deactivate();
      }

    });

  }
  function setPopup(){
      $('.js-popup').colorbox({
        inline:true,
        className:'popup ',
        width:'80%',
        maxWidth:'500px'
      });
  }
  function setRequest(){
      $('.js-popup-req').colorbox({
        inline:true,
        className:'popup request'
      });
  }
  function inputFile() {
    var $input = $('.file input'),
        $span = $input.parent().find('.js-name');
    if($input.length){
      $input.on('change',function(){
        var files = this.files;
        if(files.length > 0){
          //делаем для 1 файла
          $span.text(files[0]['name']);
        }else{
          $span.text('Прикрепить файл');
        }
      });
    }
  }
  function requestForm() {
    var $btn = $('.fixed-btn-form a');
    if($btn.length){
      $btn.on('click',function(e){
        e.preventDefault();
        $.colorbox({
          href:'#request',
          inline:true,
          className:'popup request',
          onComplete:function(){
            $btn.hide();
          },
          onClosed:function(){
            $btn.show();
          }
        });
      })
    }
  }
  function videoPopup () {
    var $btn = $('.btn-video-play');
    if($btn.length){
      $btn.colorbox({
        width:'80%',
        maxWidth:'540px',
        inline:true
      });
    }
  }
  function tableSort() {
    var $select = $('.js-select-pager-table'),
        $rows = $('.js-row');

    if($select.length){
      $select.on('change',function(){
        var key = $(this).val();
        if(key==''){
          $rows.show();
        }else{
          $rows.hide().filter('[data-city='+key+']').show();
        }
      });
    }
  }

  function tabsCart(){
    var
      $links = $('.tabs-links li'),
      $blocks = $('.tabs-content-item'),
      $this,
      index;

    $links.on('click', function(){
      if ($(this).hasClass('active')) {
        return false;
      }

      $this = $(this);

      $links.removeClass('active');
      $blocks.removeClass('active');

      $this.addClass('active');
      index = $links.index($this);
      $($blocks[index]).addClass('active');
    });
  }    
  
  function stylizeSelect(selector, style, parentSelector) {
    var $item = $(selector);
    if ($item.length) {
      $item.ikSelect(style);
    }
    $(parentSelector).append('<div class="ik-arrow"></div>');
  }
  function accordeon(){
    var o, n;
    $(".content-accordeon .title_block").on("click", function() {
      o = $(this).parents(".content-accordeon--item"), n = o.find(".info"),
        o.hasClass("active_block") ? (o.removeClass("active_block"),
          n.slideUp()) : (o.addClass("active_block"), n.stop(!0, !0).slideDown()
          /*o.siblings(".active_block").removeClass("active_block").children(".info").stop(!0, !0).slideUp()*/)
    });
  }
  
  function initPagerSelects(){
    var $selects = $('.js-select-pager'),
      is_slash = $selects.is('[get]')?'':'/';
    if($selects.length){
      $selects.on('change',function(){
        document.location.href = $(this).data('url')+this.value+is_slash;
      });
    }
  }
  function allText() {
    $('.show-link-all').on('click', function(){
      if ($(this).html() == 'Свернуть') {
          $(this).html('Развернуть &darr;');
      }
      else {
          $(this).html('Свернуть');
      }
      $('.js-text-hide').toggle('500');
    });
  }
  
  function setTest() {
    var c_r_answers = 0;
    var $btns = $('.js-radio'),
      $btn_result = $('.js-result');

    $btn_result.on('click',function(e){
      e.preventDefault();
      $('.active-js').removeClass('active-js').hide();
       c_r_answers = $('.js-radio[value=1]:checked').length;
       $('#r_'+c_r_answers).addClass('active-js').show();
    });


  }
  function accordeonReport(){
    var o, n;
    $(".report-accordeon .title_block").on("click", function() {
      o = $(this).parents(".report-accordeon-item"), n = o.find(".info"),
        o.hasClass("active_block") ? (o.removeClass("active_block"),
          n.slideUp()) : (o.addClass("active_block"), n.stop(!0, !0).slideDown()
          /*o.siblings(".active_block").removeClass("active_block").children(".info").stop(!0, !0).slideUp()*/)
    });
  }
  
  function taskShow() {
    $('.show-item-all').on('click', function(){
      $('.task-content-item.tablet-hide').slideDown(500);
      $(this).hide();
      $('.figure-task-bottom').removeClass('small-tablet');
    });
  }
  
  function calendarShow() {
    $('.btn-calendar').on('click', function(){
      $(this).addClass('active');
      if ($(this).hasClass('active')) {
        $('.wrapper-calendar').slideDown(500);
        $('.close-icon').on('click', function(){
          $('.wrapper-calendar').slideUp(500);
          $('.btn-calendar').removeClass('active');
        });
      }
    });
  }

  function textShow() {
    $('.show-link-all').on('click', function(){
      $('.content-slidedown').slideDown(500);
      $(this).hide();
    });
  }
  
  function search() {

      $('.header-icon-search').on('click', function() { return false; });
      $('.header-icon-search').on('mouseover', function() { $('.popup-search').slideDown(500); });
      $('.header-icon-search').on('touchstart', function() { $('.apopup-search').slideToggle(500); });
      $('.top-header').on('mouseleave', function() { $('.popup-search').stop(true, true).slideUp(500); });

    //$('.header-icon-search').on('click', function(){
     // $('.popup-search').slideToggle(500);
   // });
  }

  function mobileMenu() {
    $('.phone-menu-btn').on('click', function(){
      $('.top-menu').slideToggle(500);
      $('.top-menu').addClass('active');
      if ($('.top-menu').hasClass('active')) {
         $('.header-icon-block').slideToggle(300);
         $('.popup-search').slideToggle(300);
      }
      if ($(this).hasClass('active')) {
         $(this).removeClass('active');
      } else
        $(this).addClass('active');
    });
  }

  function sendForm() {
    var
      $form = $('.ajaxform'),
      $currentForm,
      milliseconds;

    $form.on('submit', function(e){
      e.preventDefault();

      $currentForm = $(this);
      milliseconds = new Date().getTime();

      $.ajax({
        url: $currentForm.attr('action'),
        data: $currentForm.serialize()+'&ajax=1',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
          //response[0]: Если 0 - успех, если 1 - ошибка
          //response[1]: Текст ответа
          //response[2]: Тип формы для вывода ошибки: alert - ошибки выводятся в виде alert, colorbox - ошибки выводятся в тело окна колорбокса
          //response[3]: Флаг новой капчи, если она есть
          //response[4]: редирект, если нужен

          //Удаляем все возможные предыдущие сообщения об ошибках
          $('.js-error').empty();
          //Если нам надо вывести только алерт с ошибкой (для форм на страницах сайта) или сообщение об успехе
          if (response[2] == 'alert' || response[0] == 0 || $currentForm.hasClass('static')) {
            $.colorbox({
              maxWidth: '80%',
              width: '540px',
              html: '<div class="form-block">'+response[1]+'</div>',
              className: "popup",
              onClosed:function(){
                if($currentForm.hasClass('req')){
                  $('.fixed-btn-form a').show();
                }
              }

            });
          }
          //Иначе надо вставить сообщение о ошибке в окно колорбокса
          else {
            if (response[0] == 1) {
              //Выводим ошибку
              $currentForm.parent().find('.js-error').html(response[1]);
              $.colorbox.resize();
            }
          }

          //Обновляем капчу, если требуется
          if ($('.captcha_sid').length && response[3]) {
            $('.captcha_img').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + response[3]);
            $('.captcha_sid').val(response[3]);
          }

          //Очищаем форму в случае успеха
          if (response[0] == 0) $currentForm[0].reset();
        }
      });
    });
  }

});

