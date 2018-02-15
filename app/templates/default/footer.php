


<?if(!$isMainPage):?>
  </div> <!--/middle -->
<?endif;?>

<div class="fixed"></div>
</div> <!--/wrapper -->

<footer class="footer">
  <div class="page">
    <div class="footer-content">
      <?php /* ?><div class="block-footer block-footer--n1"><span>КОНТАКТЫ</span></div> <?php */ ?>
      <div class="block-footer block-footer--n2">

        <p>
          Материалы, размещенные на сайте, носят ознакомительный характер и предназначены для образовательных целей. Перед применением любых лекарств и методов лечения, а также для постановки диагноза необходимо проконсультироваться с врачом. ГУП «Стройэкспром» не несет ответственности за возможные негативные последствия, возникшие в результате использования информации, размещенной на портале <a href="/">healthvector.ru</a>
        </p>
        <?php /* ?><p>Адрес: 109316, г. Москва, Волгоградский проспект, д. 42</p>
        <p>Телефон: <a class="tel-link" href="tel:+74956470818">+7 495 647 08 18</a> &nbsp; <a href="tel:+74956470818">Позвонить</a></p>
        <p>E-mail: <a href="mailto:office@healthvector.ru">office@healthvector.ru</p><?php */ ?>
      </div>
      <div class="block-footer block-footer--n3">
        <a class="link-print" href="?print=1">Версия для печати</a>
        <a class="link-print link-print-home" href="/">Главная страница</a>
        <a class="link-print link-print-map" href="/sitemap/">Карта сайта</a>
        <a class="link-print link-print-visitors " href="/forvisitors/">Посетителям сайта</a>
        <a class="link-print link-print-app " href="/mobile_app/">Мобильное приложение</a>
      </div>
    </div>
    <?/*$APPLICATION->IncludeComponent(
      "bitrix:menu",
      "bottom",
      Array(
        "ROOT_MENU_TYPE" => "top",
        "MAX_LEVEL" => "2",
        "CHILD_MENU_TYPE" => "top.submenu",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array()
      ),
      false
    );*/?>
    <div class="copyright-social">
      <div class="social-icon-block">
        <a href="" class="social-icon social-icon--num1"></a>
        <a href="" class="social-icon social-icon--num2"></a>
        <a href="" class="social-icon social-icon--num3"></a>
        <a href="" class="social-icon social-icon--num4"></a>
        <a href="" class="social-icon social-icon--num5"></a>
      </div>
      <div class="copyright-dev">&copy; <?=date('Y');?> Дизайн, разработка сайта - <a target="_blank" rel="nofollow" href="http://www.interlabs.ru/">Interlabs</a></div>
    </div>
  </div>
</footer>
<div id="top-button">Наверх ↑</div>
<?php //$jso->dump(); ?>
<?php if (!$isPrint) : ?>
  <div class="hide"><?Tools::IncludeTemplate('forms/feedback.php');?></div>
  <div class="hide"><?Tools::IncludeTemplate('forms/callback.php');?></div>
  <div class="hide"><?Tools::IncludeTemplate('forms/request.php');?></div>
<?else:?>
  <script >
    $(document).ready(function (){
      window.print();
    });
  </script>
<?endif;?>


<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
	(function (d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter46840626 = new Ya.Metrika({
					id:46840626,
					clickmap:true,
					trackLinks:true,
					accurateTrackBounce:true,
					webvisor:true
				});
			} catch(e) { }
		});

		var n = d.getElementsByTagName("script")[0],
			s = d.createElement("script"),
			f = function () { n.parentNode.insertBefore(s, n); };
		s.type = "text/javascript";
		s.async = true;
		s.src = "https://mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/46840626" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110461550-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-110461550-1');
</script>

</body>
</html>