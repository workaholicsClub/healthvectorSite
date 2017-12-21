/**
 * Выполняет дополнительную настройку datepicker, в частности, 
 * интернационалиацию в зависимости от установленного атрибута html[lang].
 */
define([

  'jquery',
  'jquery-ui/datepicker',
  'jquery-ui/i18n/datepicker-en',
  'jquery-ui/i18n/datepicker-ru'

], function($) {

    $.datepicker.setDefaults(
      $.datepicker.regional[$('html').attr('lang') || 'ru']
    ); 

});
