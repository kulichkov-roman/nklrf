<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
	IncludeTemplateLangFile(__FILE__);
?>

		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/main.php",
				"EDIT_TEMPLATE" => ""
			),
			false
		);
		?>
		
		<!-- ==============================================
		FOOTER
		=============================================== -->	
		<footer id="main-footer" class="color-bg light-typo">
		
			<div class="container text-center">
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"social",
					Array(
						"ROOT_MENU_TYPE" => "social",
						"MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => "",
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
					)
				);?>
				<div class="col-sm-4">
					<img src="/bitrix/templates/apsel_landing_green/img/qc_down_200_59.png">
				</div>
				<div class="col-sm-4">
					<p>&copy; Copyright <? echo date('Y') ?>
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/copyright.php",
							Array(),
							Array("MODE"=>"text")
						);?>
					</p>
				</div>
				<div class="col-sm-4">
					<img src="http://opt-560835.ssl.1c-bitrix-cdn.ru/images/partners/business_sm.png">
				</div>
			</div>
			
		</footer>
		
		
		<!-- ==============================================
		SCRIPTS
		=============================================== -->	
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/libs/jquery-1.8.2.min.js">\x3C/script>')</script>
		
		<script src="<?=SITE_TEMPLATE_PATH?>/js/libs/bootstrap.min.js"></script>
		<script src='<?=SITE_TEMPLATE_PATH?>/js/jquery.easing.1.3.min.js'></script>
		<script src='<?=SITE_TEMPLATE_PATH?>/js/jquery.scrollto.js'></script>
		<script src='<?=SITE_TEMPLATE_PATH?>/js/jquery.flexslider.min.js'></script>
		<script src='<?=SITE_TEMPLATE_PATH?>/js/jquery.fitvids.js'></script>
		<script src='<?=SITE_TEMPLATE_PATH?>/js/jquery.fittext.js'></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/waypoints.min.js"></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.countTo.js"></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.easypiechart.js"></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.sequence-min.js"></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.colorbox-min.js"></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/contact.js"></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/qubico.js"></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/style-switcher.js"></script>
		<?/*
		<div id="style-switcher">
			<div id="toggle-switcher"><i class="fa fa-cogs"></i></div>
			<h1><? echo GetMessage('CHANGE_COLOR'); ?></h1>
			<ul>
				<li id="red"></li>
				<li id="orange"></li>
				<li id="yellow-orange"></li>
				<li id="yellow"></li>
				<li id="grass"></li>
				<li id="green"></li>
				<li id="light-green"></li>
				<li id="cyan"></li>
				<li id="blue"></li>
				<li id="light-purple"></li>
				<li id="purple"></li>
				<li id="pink"></li>
			</ul>
		</div>
		*/?>
        <?$APPLICATION->IncludeFile(
			SITE_DIR."include/yandex_metrika.php",
			Array(),
			Array("MODE"=>"text")
		);?>
		<?/*$APPLICATION->IncludeFile(
			SITE_DIR."include/ya_widgets_share.php",
			Array(),
			Array("MODE"=>"text")
		);*/?>
		<?$APPLICATION->IncludeFile(
			SITE_DIR."include/jivosite.php",
			Array(),
			Array("MODE"=>"text")
		);?>
	</body>
</html>

