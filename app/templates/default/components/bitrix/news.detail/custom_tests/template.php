<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="page">
	<?if (!isset($_REQUEST['start']) && !isset($_REQUEST['age'])):?>
		<div><?=$arResult['~DETAIL_TEXT'];?></div>
	<?endif?>
</div>

<div class="page test">
	<div class="app-pagecontent">
		<div class="skin-test">
			<div id="form-test" class="form-test">
				<?if ((!isset($_REQUEST['start']) && !isset($_REQUEST['next'])) || intval($arResult['AGE']) == 0):?>
					<div class="form-block">
						<form action="" method="post">
							Введите возраст ребенка<br>
							
							<?if (isset($_REQUEST['start']) && intval($arResult['AGE']) == 0):?>
								<div class="js-error">Не заполнен возраст ребенка!</div>
							<?endif?>
							
							<input name="age_year" type="text" placeholder="Лет" value="" />
							<input name="age_month" type="text" placeholder="Месяцев" value="" /><br>
							<input class="btn-submit" type="submit" name="start" value="Начать тестирование →">
						</form>
					</div>
				<?else:?>
					<div id="test-view-custom">
						<div class="skin-frame">
							<?if (isset($arResult['AGE']) && !isset($arResult['TEST_RESULT']) && intval($arResult['AGE']) > 0):?>
								
								<div class="m30">
									<b><?=$arResult['QUESTION']?></b>
								</div>
								<div class="form-block questions">
									<form action="" method="post">
										<input name="age" type="hidden" value="<?=intval($arResult['AGE'])?>" />
										<input name="stage" type="hidden" value="<?=intval($arResult['STAGE'])?>" />
										<input name="direction" type="hidden" value="<?=htmlentities($arResult['DIRECTION'])?>" />
										<label for="yes">
											<input type="radio" id="yes" name="answer" value="ДА" checked/> ДА
										</label><br>
										<label for="no">
											<input type="radio" id="no" name="answer" value="НЕТ" /> НЕТ
										</label><br><br>
										<!--<input class="btn-submit" type="submit" name="prev" value="← Назад">--->
										<input class="btn-submit" type="submit" name="next" value="Далее →">
									</form>
								</div>
								
							<?endif?>
							<?if (isset($arResult['TEST_RESULT'])):?>
								<div class="m30">
									<b>Стадия развития: <?=$arResult['TEST_RESULT']['NAME']?></b>
								</div>
								<div class="m30">
									<b><?=$arResult['TEST_RESULT']['RESULT']?></b>
								</div>
								<a class="btn-submit" href="<?=$arResult['DETAIL_PAGE_URL']?>">← Начать сначала</a>
							<?endif?>
						</div>
					</div>
				<?endif?>
			</div>
		</div>
	</div>
</div>