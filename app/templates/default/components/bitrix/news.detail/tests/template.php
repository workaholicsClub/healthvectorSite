<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//echo "<pre>"; print_r($arResult); echo "</pre>";
?>
<?/*?>
<?if(count($arResult['QUESTIONS'])>0):?>
 <?foreach ($arResult['QUESTIONS'] as $qID=>$quest):?>

  <h3><?=$quest['NAME'];?></h3>
  <div><?=$quest['PREVIEW_TEXT'];?></div>
   <ul>
     <li><label><input type="radio" class="js-radio" name="quest_<?=$qID;?>" value="<?=($quest['PROPERTY_ANSWER_VALUE'] == 'ДА'? '1':'0');?>" checked>ДА</label></li>
     <li><label><input type="radio"  class="js-radio" name="quest_<?=$qID;?>" value="<?=($quest['PROPERTY_ANSWER_VALUE'] == 'НЕТ'? '1':'0');?>" >НЕТ</label></li>
   </ul>
  <?endforeach;?>
<?endif;?>

<?if(count($arResult['ANSWERS'])>0):?>
  <?foreach ($arResult['ANSWERS'] as $rID=>$result):?>
    <div style="display: none" сlass="results" id="r_<?=$result['PROPERTY_COUNT_ANSWERS_VALUE'];?>">
      <?=$result['PREVIEW_TEXT'];?>
    </div>
  <?endforeach;?>
<?endif;?>
<a href="#" class="js-result">результат</a>

<?*/?>


<?if(count($arResult['QUESTIONS'])>0):?>
<div class="page test">
  <div class="app-pagecontent">
    <div class="skin-test"><!-- class="hidden" -->
	    <div class="welcome">
		    <?=$arResult['~DETAIL_TEXT']?>
		    <div class="test-text">
		        <a class="btn-submit start">Начать тестирование →</a>
		    </div>
	    </div>
      <div id="form-test" class="form-test">
        <div id="test-view">
          <div class="progress-wraper">
            <div class="progress-bar">
              <div class="js-wrap">
                <?php
                $first = true;
                for($i=1;$i<=sizeof($arResult['QUESTIONS']);$i++) {
                ?>
                  <span id="progress-item-<?=$i;?>" class="progress-element <?=$first?'progress-element-active progress-element-pass':''; $first=false;?>"><?=$i;?></span>
                <?php } ?>
                <span class="progress-end">Результат теста</span>
              </div>
            </div>
          </div>
          <div class="progress-number show"><span class="first-number">1</span><span class="second-number">/<?=sizeof($arResult['QUESTIONS']);?></span></div>

          <?
          $i=1;
          $first = true;
          foreach ($arResult['QUESTIONS'] as $qID=>$quest):?>
            <div id="frame<?=$i;?>" class="skin-frame <?=(!$first?' hidden ':'');$first=false;?> <?=($i==sizeof($arResult['QUESTIONS'])?'last':'');?>" >
              <div class="m30">
                <b><?=$quest['~PREVIEW_TEXT'];?></b>
              </div>
              <?if($quest['~DETAIL_TEXT']!=''):?>
              <div class="m30-90">
                ПРИМЕР:<br>
                <i><?=$quest['~DETAIL_TEXT'];?></i>
              </div>
              <?endif;?>

                    <div class=" answer" value="<?=($quest['PROPERTY_ANSWER_VALUE'] == 'ДА'? '1':'0');?>">да</div>
                    <div class=" answer" value="<?=($quest['PROPERTY_ANSWER_VALUE'] == 'НЕТ'? '1':'0');?>">нет</div>

              <div class="btns">
                <a class="btn prev js-prev-step"  data-step="<?=$i;?>" >&larr; Назад</a>
                <a class="btn next js-next-step"  data-step="<?=$i;?>" >Вперед &rarr;</a>
              </div>
            </div>
            <?$i++;?>
          <?endforeach;?>

          <?foreach ($arResult['ANSWERS'] as $rID=>$result):?>

            <div id="result<?=$result['PROPERTY_COUNT_ANSWERS_VALUE'];?>" class="skin-result hidden " >
              <div class="m30">
                <b><?=$result['~PREVIEW_TEXT'];?></b>
              </div>
              <?if($result['~DETAIL_TEXT']!=''):?>
                <div class="m30-90">
                  <i><?=$result['~DETAIL_TEXT'];?></i>
                </div>
              <?endif;?>
              <div class="btns">
                <a class="btn result"  onclick="window.print();" >Распечатать результат &rarr;</a>
              </div>
            </div>

          <?endforeach;?>
          <div id="notanswer" class="skin-result hidden ">
              <div class="m30">
                <b>Ответа не найдено</b>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?endif;?>