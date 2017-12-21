// Сайт.

requirejs.config({
  paths: {
    site: '../app/site',
    lib:  '../app/lib',
    async: 'require/async'
  }
});

$(function() {
});

// ВНИМАНИЕ! 
//
// КОД, РАЗМЕЩАЕМЫЙ ЗДЕСЬ, ВЫПОЛНЯЕТСЯ СИНХРОННО В ГЛОБАЛЬНОМ ПРОСТРАНСТВЕ ИМЕН.
//
// ИСПОЛЬЗОВАНИЕ ЭТОГО ФАЙЛА ДЛЯ РАЗМЕЩЕНИЯ КОДА ДОПУСТИМО ТОЛЬКО ДЛЯ 
// СОВМЕСТИМОСТИ С РАНЕЕ НАПИСАННЫМ КОДОМ. ОБЪЕМ КОДА, РАЗМЕЩЕННОГО ЗДЕСЬ,
// ДОЛЖЕН БЫТЬ МИНИМАЛЬНЫМ.  В КОДЕ НЕДОСТУПНА НИ ОДНА БИБЛИОТЕКА, КРОМЕ JQUERY.
//
// ИСПОЛЬЗОВАНИЕ ЭТОГО ФАЙЛА ДЛЯ РАЗМЕЩЕНИЯ ОБЫЧНОГО КОДА ПРИЛОЖЕНИЯ СТРОГО
// ЗАПРЕЩЕНО.
//

$(function(){

	/**
	 * Фильтр на странице Реабилитационые центры
	 */
	$('#form_dropdown_COUNTRY, #form_dropdown_CITY').change(function(){
		if ($(this).attr('id') == 'form_dropdown_COUNTRY') {
			$('#form_dropdown_CITY').val('');
		}
		$(this).parents('form').submit();
	});

	/**
	 * Кнопка Наверх
	 */
	$('#top-button').click(function(){
		$('html').animate({ scrollTop:0 }, '500', 'swing');
	});

	$(window).scroll(function(){
		if ($(this).scrollTop() > 400){
			$('#top-button').show();
		} else {
			$('#top-button').hide();
		}
	});
});