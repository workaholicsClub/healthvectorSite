define([
  'jquery',
//  'jquery/colorbox'
], function($) {

  "use strict";


  $(function() {
    var questions=[];
    var step=5;
    //$('#js-start-skin').on('click', nextStep); //кнопка начать тест

    //фиксим скроку сначала
    //

    var wrap = $('.js-wrap'),
      widthWrap = 0,
      widthElement = 0,
      currentWidth =0;
     $('.progress-element').each(function () {
       widthWrap +=$(this).outerWidth(true);
       widthElement = $(this).outerWidth(true);
     });
    var
      widthProgress = $('.progress-bar').width()-widthElement;
    widthWrap+=$('.progress-end').outerWidth(true);
    wrap.css({width:+widthWrap});
    $('.js-next-step').on('click', doStep);
    $('.js-prev-step').on('click', doBackStep);

    $('.answer').on('click',recheck);

    function recheck(){
      var checklist = $('.answer',this.parentElement);
      checklist.removeClass('active');
      $(this).addClass('active');
    }

    $('.skin-test .welcome .start').click(function(){
		$('.skin-test .welcome').hide();
		$('.skin-test #test-view').show();
    });

    function doBackStep(){

      var currentStep=$(this).data('step');
      if($('#frame'+(currentStep-1)).length){

        $('#frame'+currentStep).hide();
        $('#frame'+(currentStep-1)).show();
        $('#progress-item-'+(currentStep-1)).addClass('progress-element-active');
        $('#progress-item-'+(currentStep-1)).addClass('progress-element-pass');
        $('#progress-item-'+currentStep).removeClass('progress-element-active');
        $('#progress-item-'+currentStep).removeClass('progress-element-pass');
        $('.first-number').text(currentStep-1);
        if (screen.width <= '767') {
          $(".progress-bar").offset(function (i, val) {
            if (currentStep == 2)
              return {top: val.top, left: val.left};
            else
              return {top: val.top, left: val.left + widthElement};
          });
        }else if(currentWidth >= widthProgress){
          wrap.offset(function (i, val) {
              return {top: val.top, left: val.left + widthElement};
          });
        }

        currentWidth -= widthElement;
      }
    }
    function doStep()
    {
      //questions[$(this).data('step')]=$(this).data('val');
      var currentStep=$(this).data('step');
      if(!$('.answer.active','#frame'+currentStep).length){
        return false;
      }
      currentWidth += widthElement;
      if (!$('#frame'+currentStep).hasClass('last')){
        $('#frame'+currentStep).hide();
        $('#frame'+(1+currentStep)).show();
        $('#progress-item-'+(1+currentStep)).addClass('progress-element-active');
        $('#progress-item-'+(1+currentStep)).addClass('progress-element-pass');
        $('#progress-item-'+currentStep).removeClass('progress-element-active');
        $('.first-number').text(1+currentStep);
        if (screen.width <= '767') {
          $(".progress-bar").offset(function (i, val) {
            if (currentStep == 1)
              return {top: val.top, left: val.left};
            else
              return {top: val.top, left: val.left - widthElement};
          });
        }else if(currentWidth >= widthProgress){
          wrap.offset(function (i, val) {
            if (currentStep == 1)
              return {top: val.top, left: val.left};
            else
              return {top: val.top, left: val.left - widthElement};
          });
        }
      }
      else{
        $('#frame'+currentStep).hide();
        $('#progress-item-'+currentStep).removeClass('progress-element-active');
        $('.progress-end').addClass('active');

        var c_r_answers = $('.answer.active[value=1]').length;
        console.log('Баллов - '+c_r_answers)
        if($('#result'+c_r_answers).length){
          $('#result'+c_r_answers).show();
        }else{
          $('#notanswer').show();
        }
        if (screen.width <= '767'){
          $(".progress-bar").offset(function(i,val){
            return {top:val.top, left:val.left-110};
          });
        }else if(currentWidth >= widthProgress){
          wrap.offset(function (i, val) {
              return {top: val.top, left: val.left - 100};
          });
        }

      }
    }
  });
 /* function nextStep()
  {
    $('#frame0').hide();
    $('#frame1').show();
    $('#progress-item-1').addClass('progress-element-active');
    $('#progress-item-1').addClass('progress-element-pass');
    $('.progress-number').addClass('show');
  }
*/
});
