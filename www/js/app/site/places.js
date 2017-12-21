// JavaScript-код для страницы с картой.
//
define([
  'jquery',
  'jquery/ikSelect'
], function ($, gmaps) {

  "use strict";
  var myMap=null;
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
    initSelects();
    initReset();
    /*$.getScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU',function(){
      ymaps.ready(function () {
        myMap = customMap();
        myMap();
      });
    });*/
  });
  function initSelects(){
    $(document).on('change','[name ^= form_dropdown_]',function(){
        var $selects = myMap.update();
        $('.ajax-selects').html($selects);
        stylizeSelect(".js-select", ikParms, ".select-parent .ik_select_link");
    });
  }
  function initReset(){
    var $btn = $('.js-reset');
    $btn.on('click',function(e){
      e.preventDefault();
      $('[name ^= form_dropdown_]').val('');
      var $selects = myMap.update();
      $('.ajax-selects').html($selects);
      stylizeSelect(".js-select", ikParms, ".select-parent .ik_select_link");
    })
  }

  function customMap() {

    var Map = null,
      // Создание макета балуна .
      MyBalloonLayout = ymaps.templateLayoutFactory.createClass(
      '<div class="position-block">' +
      '<a class="close" href="#">&times;</a>' +
      '<div class="popover-inner">' +
      '$[[options.contentLayout observeSize minWidth=584 maxWidth=584 maxHeight=267]]' +
      '</div>' +
      '</div>', {
        /**
         * Строит экземпляр макета на основе шаблона и добавляет его в родительский HTML-элемент.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/layout.templateBased.Base.xml#build
         * @function
         * @name build
         */
        build: function () {
          this.constructor.superclass.build.call(this);

          this._$element = $('.position-block', this.getParentElement());

          this.applyElementOffset();

          this._$element.find('.close')
            .on('click', $.proxy(this.onCloseClick, this));
        },

        /**
         * Удаляет содержимое макета из DOM.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/layout.templateBased.Base.xml#clear
         * @function
         * @name clear
         */
        clear: function () {
          this._$element.find('.close')
            .off('click');

          this.constructor.superclass.clear.call(this);
        },

        /**
         * Метод будет вызван системой шаблонов АПИ при изменении размеров вложенного макета.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
         * @function
         * @name onSublayoutSizeChange
         */
        onSublayoutSizeChange: function () {
          MyBalloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);

          if(!this._isElement(this._$element)) {
            return;
          }

          this.applyElementOffset();

          this.events.fire('shapechange');
        },

        /**
         * Сдвигаем балун, чтобы "хвостик" указывал на точку привязки.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
         * @function
         * @name applyElementOffset
         */
        applyElementOffset: function () {
          this._$element.css({
            left: 50,
            top: -(this._$element[0].offsetHeight-50)
          });
        },

        /**
         * Закрывает балун при клике на крестик, кидая событие "userclose" на макете.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
         * @function
         * @name onCloseClick
         */
        onCloseClick: function (e) {
          e.preventDefault();

          this.events.fire('userclose');
        },

        /**
         * Используется для автопозиционирования (balloonAutoPan).
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ILayout.xml#getClientBounds
         * @function
         * @name getClientBounds
         * @returns {Number[][]} Координаты левого верхнего и правого нижнего углов шаблона относительно точки привязки.
         */
        getShape: function () {
          if(!this._isElement(this._$element)) {
            return MyBalloonLayout.superclass.getShape.call(this);
          }

          var position = this._$element.position();

          return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
            [position.left, position.top], [
              position.left + this._$element[0].offsetWidth,
              position.top + this._$element[0].offsetHeight
            ]
          ]));
        },

        /**
         * Проверяем наличие элемента (в ИЕ и Опере его еще может не быть).
         * @function
         * @private
         * @name _isElement
         * @param {jQuery} [element] Элемент.
         * @returns {Boolean} Флаг наличия.
         */
        _isElement: function (element) {
          return element && element[0] && element.find('.arrow')[0];
        }
      }),

      // Создание вложенного макета содержимого балуна.
      MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
        '<h3 class="popover-title">$[properties.name]</h3>' +
        '<div class="popover-content">$[properties.balloonContentBody]</div>'
      );


    function init() {
      Map = new ymaps.Map('map', {
        center: [0, 0],
        zoom: 8,
        controls: ['zoomControl']
      });
      init.update();
    };

    init.setPoints = function (jsonPoints) {
      var points = [], coords = [], point = [], geoObj = null;

      for (var i = 0; i < jsonPoints.length; i++) {
        point = jsonPoints[i];
        coords = point.coords.split(',');
        points[i] = new ymaps.Placemark(
          [coords[0], coords[1]],
          {
            clusterCaption: point.title,
            name: point.title,
            balloonContentBody:  point.body
          },
          {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: (point.is_build=='true' ? '/image/map_rehabilitation-centers_o.png' : '/image/map_rehabilitation-experts_o.png'),
            // Размеры метки.
            iconImageSize: [86, 98],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-3, -42],
            balloonShadow: false,
            balloonLayout: MyBalloonLayout,
            balloonContentLayout: MyBalloonContentLayout,
            balloonPanelMaxMapArea: 425*350,//ширину на высоту карты ( для моб версии )
            // Не скрываем иконку при открытом балуне.
             hideIconOnBalloonOpen: false,

            // И дополнительно смещаем балун, для открытия над иконкой.
            // balloonOffset: [3, -40]
          }
        );
      }
      geoObj = ymaps.geoQuery(points).clusterize();
      /*clasters.options.set({

       clusterIcons: [{
       href: 'image/i-marker.png',
       size: [38, 61],
       offset: [-3, -42]
       }],
       });*/
      Map.geoObjects.removeAll();
      Map.geoObjects.add(geoObj);
      Map.setBounds(geoObj.getBounds(), {checkZoomRange:true});

    };
    //собираем инфу

    init.update = function () {
      var result = '';
      var parms = $('.ajax-selects').serialize();
      $.ajax({
        url: '/helpful_info/places/',
        data: parms + "&ajax=1&points=1",
        async: false,
        method: "POST",
        dataType: 'json',
        success: function (data) {
          init.setPoints(data.points);
          result = data.html_data;
        }
      });
      return result;
    };

    return init;

  }
  function stylizeSelect(selector, style, parentSelector) {
    var $item = $(selector);
    if ($item.length) {
      $item.ikSelect(style);
    }
    $(parentSelector).append('<div class="ik-arrow"></div>');
  }

});
