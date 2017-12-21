define([
  'jquery',
  'jquery/swiper'
], function($) {

  "use strict";
  
  $(function() {
    sliderMain();
    sliderTest();
    sliderTask();
    sliderNews();
    sliderArticles();
    sliderPublics();
    scrollbarPartners();
    scrollbarStory();
    tabs();
    sliderExpertComment();
  });

  function sliderExpertComment() {

    var sliders = [];
    var $slidersObj = $('.js-slider-comm');
    var $btns = $('.comment');
    if($slidersObj.length){
      $slidersObj.each(function(){
        var key =$(this).data('key'),
            $slider = $(this);
        sliders[key] = new Swiper($slider, {
          prevButton: '.js-sl-expert-comment-prev-'+key,
          nextButton: '.js-sl-expert-comment-next-'+key,
          slidesPerView: 1,
          speed: 800,
          autoHeight: true
        });
      });
    }
    if($btns.length){
      //из-за кривой разметки и моих кривых рук делаем ход конем
      $('a',$btns).on('click',function(e){
        e.preventDefault();
        var $this = $(this);
        var $parent = $(this.parentElement);
        if($parent.hasClass('active')){
          $parent.closest('.comments-view-helpful')
            .find('.active')
              .removeClass('active');
        }else{
          $parent.closest('.comments-view-helpful')
            .find('.active')
              .removeClass('active');
          $parent.addClass('active');
          $('#'+$this.data('slider')).addClass('active');
          if($this.data('slider') in sliders){
            sliders[$this.data('slider')].update();//упдейтим
          }
        }
      });
    }



  }
  
  function sliderMain() {
    var swiper = new Swiper('.swiper-container--main-header', {
        prevButton: '.js-sl-main-prev',
        nextButton: '.js-sl-main-next',
        speed: 800,
        autoplay: 10000,
        slidesPerView: 1,
    });
  }

  function sliderTest() {
    var swiper = new Swiper('.swiper-container--main-test', {
        prevButton: '.js-sl-test-prev',
        nextButton: '.js-sl-test-next',
        slidesPerView: 1,
        speed: 800,
    });
  }

  function sliderTask() {
    var swiper = new Swiper('.swiper-container--main-task', {
        prevButton: '.js-sl-task-prev',
        nextButton: '.js-sl-task-next',
        slidesPerView: 4,
        speed: 800,
    });
  }

  function sliderNews() {
    var swiper = new Swiper('.swiper-container--main-news', {
        prevButton: '.js-sl-news-prev',
        nextButton: '.js-sl-news-next',
        spaceBetween: 40,
        slidesPerView: 3,
        speed: 800,
        breakpoints: {
          980: {
            slidesPerView: 2,
            spaceBetween: 30
          },
          765: {
            slidesPerView: 1,
            spaceBetween: 0
          }
        }
    });
  }
  
  function sliderArticles() {
    var swiper = new Swiper('.swiper-container--main-articles', {
        prevButton: '.js-sl-articles-prev',
        nextButton: '.js-sl-articles-next',
        spaceBetween: 30,
        slidesPerView: 4,
        speed: 800,
        breakpoints: {
          980: {
            slidesPerView: 3,
            spaceBetween: 30
          },
          765: {
            slidesPerView: 1,
            spaceBetween: 0
          }
        }
    });

    $(document).on("click", ".tabs-links-item", function() {
      swiper.update();
    });
  }

  function sliderPublics() {
    var swiper = new Swiper('.swiper-container--main-publics', {
        prevButton: '.js-sl-publics-prev',
        nextButton: '.js-sl-publics-next',
        spaceBetween: 30,
        slidesPerView: 4,
        speed: 800,
        breakpoints: {
          980: {
            slidesPerView: 3,
            spaceBetween: 30
          },
          765: {
            slidesPerView: 1,
            spaceBetween: 0
          }
        }
    });

    $(document).on("click", ".tabs-links-item", function() {
      swiper.update();
    });
  }

  function scrollbarPartners() {
    var swiper = new Swiper('.swiper-container--scroll-partners', {
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: false,
        spaceBetween: 23,
        slidesPerView: 4,
        grabCursor: false,
        scrollbarDraggable: true,
        breakpoints: {
          980: {
            slidesPerView: 3,
            spaceBetween: 30
          },
          765: {
            slidesPerView: 1,
            spaceBetween: 20
          }
        }
    });
  }

  function scrollbarStory() {
    var swiper = new Swiper('.swiper-container--scroll-story', {
        scrollbar: '.js-scrollbar-story',
        scrollbarHide: false,
        spaceBetween: 25,
        slidesPerView: 4,
        grabCursor: true,
        scrollbarDraggable: true,
        breakpoints: {
          980: {
            slidesPerView: 3,
            spaceBetween: 30
          },
          765: {
            slidesPerView: 1,
            spaceBetween: 10
          }
        }
    });
  }
  
  function tabs(){
    var
      $swiper = $('.swiper-container--main-articles'),
      $links = $('.tabs-links-item'),
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

});