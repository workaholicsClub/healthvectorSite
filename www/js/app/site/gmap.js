// JavaScript-код для страницы с картой.
//
define([
  'jquery'
], function ($) {

  "use strict";
  
  $(function() {
    if($('#mapsYandex').length){
      showYMap(".js-map");
    }
  });
  
  function showYMap(selector) {
    var $contentPoint = $(selector).data('content');
    var $gm1 = $(selector).data('gm1'); // Координата 1 берется из атрибута data-gm1 селектора selector
    var $gm2 = $(selector).data('gm2'); // Координата 2 берется из атрибута data-gm2 селектора selector

    $.getScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU', function () {
      ymaps.ready(function () {

        var Map = new ymaps.Map('mapsYandex', {
          center: [$gm1, $gm2],
          zoom: 15,
          controls: ['zoomControl']
        });
        Map.behaviors.disable('scrollZoom');
        var placemark = new ymaps.Placemark(
          [$gm1, $gm2],
          {
            //clusterCaption: point.title,
            //name: point.title,
            balloonContentBody: $contentPoint
          },
          {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: '/image/map_rehabilitation-experts_o.png',
            // Размеры метки.
            iconImageSize: [86, 98],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-3, -42],

          });

        Map.geoObjects.add(placemark);
      });
    });
  }

});
