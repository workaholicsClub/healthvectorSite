/**
 * Настраивает валидацию форм и дополнительные возможности, например, работу
 * с placeholder.
 */
define([
  'jquery',
  'jquery/validate',
  'jquery/validate/messages-ru',
  'jquery/placeholder'
], function($) {

  "use strict";

  validators();

  return {

    /**
     * Устанавливает настройки форм по умолчанию.
     */
    setup: function(defaults) {

      if (defaults) {
        $.validation.setDefaults(defaults);
      }

      // Включаем поддержку placeholer.
      this.placeholder(':input[placeholder]');

      this.validate(
        'form[data-validate-style="alert"]',
        this.validation.alert())
//        .on('keypress', function(e) { console.debug(e); if (e.keyCode == 13) e.preventDefault();});

      // Проверка с показом span.
      this.validate(
        'form[data-validate-style="inline"]',
        this.validation.inline());
    },

    validation: {

      /**
       * Валидация с выводом сообщений об ошибках в alert.
       *
       * <form data-validate-style="alert">
       */
      alert: function (options) {

        return $.extend(
          {},
          {
            onkeyup: false,
            onfocusout: false,
            onclick: false,
            showErrors: function(errorMap, errorList) {
              if (errorList.length) {
                alert(errorList[0].message);
              }
            },
            errorPlacement: function (error, element) {}
          },
          options || {}
        );
      },

      /**
       * Валидация с выводом сообщений об ошибках в span,
       * вариант по умолчанию.
       *
       * Пока ничего не настраиваем, разберемся позже.
       */
      inline: function (options) {
        return options || {};
      }

    },

    /**
     * Показ placeholder-ов.
     */
    placeholder: function (selector) {
      $(selector).placeholder();
    },

    /**
     * Метод валиации, вызывает плагин, передавая
     * дополнительные опции.
     */
    validate: function (selector, options) {
      $(selector).each(function() { $(this).validate(options || {}) });
      return $(selector);
    }
  };

  /**
   * Определяет несколько дополнительных валидаторов.
   */
  function validators() {
    /** Проверка регулярного выражения.
     *
     * <input
     *  data-rule-regexp="^[A-Za-z][0-9]*$"
     *   data-msg-regexp="Введите идентификатор"
     * />
     */
    $.validator.addMethod('regexp', function(value, element, param) {
      return (this.optional(element) == true) || (value.match(param) !==null) ;
    }, 'Ошибка заполнения поля, проверьте пожалуйста!');

    /**
     * Проверка пароля.
     *
     * <input
     *  data-rule-password="true"
     * />
     */
    $.validator.addMethod('password', function(value, element) {
      return this.optional(element) || value.match(/^([0-9a-zA-Z_]+)$/);
    }, 'Укажите пароль! Пароль может состоять из цифр, букв латинского алфавита и символа _');
  }

});
