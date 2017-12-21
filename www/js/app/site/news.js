// JavaScript-код для новостей.
//
define([
  'jquery'
], function ($) {

  "use strict";
  var
    $ajaxPageContent = $('#lazy'),
    $preloader = $('.preloader'),
    $pageCount = $ajaxPageContent.data('page'),
    senderObj = {PAGEN_1: 2, AJAX_PAGE: 'Y'},
    inProgress = false,
    isFinal = false;

  $(function() {

    calendar();

    if (senderObj.PAGEN_1 <= $pageCount) {
      lazyLoad();
    }

  });

  function calendar() {

    var $viewMonth;
    var $viewYear;
    
    $("#field_month,#field_year").on('change', setDateForm);
    $("#news-calendar-table").on('click', "div.app-calendar-prev", setDatePrev);
    $("#news-calendar-table").on('click', "div.app-calendar-next", setDateNext);
    
    function setDateForm() {
        $viewMonth = $("#field_month option:selected").val();
        $viewYear = $("#field_year option:selected").val();
        load();
    }
    
    function setDatePrev() {
        $viewMonth = $(this).data('prev_month');
        $viewYear = $(this).data('prev_year');
        $("#field_month").attr('value', $viewMonth);
        $("#field_year").attr('value', $viewYear);
        load();
    }

    function setDateNext() {
        $viewMonth = $(this).data('next_month');
        $viewYear = $(this).data('next_year');
        $("#field_month").attr('value', $viewMonth);
        $("#field_year").attr('value', $viewYear);
        load();
    }

    function load() {
      var lang = '';

      $.post(
        "/news/viewcalendar",
        { "month": $viewMonth,
          "year":  $viewYear,
          "lang":  lang || ''
        })
      .success(function (response) {
        $("#news-calendar-table").html(response);
      });
    }
  }
  function lazyLoad() {
    $('.preloader-btn').on('click', function() {
      if (!inProgress && !isFinal) {
        ajaxPreloader();
      }
    });
  }

  function ajaxPreloader() {
    $preloader.show();
    inProgress = true;
    setTimeout(ajaxGo, 500);
  }

  function ajaxGo() {
    $.ajax({
      url: '/about/news/',
      type: 'GET',
      data: senderObj,
      success: function(response) {
        $preloader.hide();
        $ajaxPageContent.append(response);

        senderObj.PAGEN_1++;
        if (senderObj.PAGEN_1 > $pageCount) {
          isFinal = true;
          $('.preloader-btn').hide();
        }else{

          $('.preloader-btn').show();
        }
      },
      complete: function() {
        inProgress = false;
      }
    });
  }
});
