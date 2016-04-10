<section class="color-bg light-typo padding-top-bottom">
		
	<div class="container">
		
		<h1 class="section-title">Видео презентация</h1>
		<p class="section-description">Видео о нас и наших услугах</p>
				
		<div class="row">
		
			<div class="col-sm-10 col-sm-offset-1">
			
				<div class="macbook-frame">
				
					<img class="img-responsive img-center" src="<?=SITE_TEMPLATE_PATH?>/assets/macbook.png" alt=""/>
					<div class="macbook-screen">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => SITE_DIR."include/cta-video.php"
						)
					);?>
					</div>
					
				</div>
				
			</div>
			
		</div><!-- End row -->
	
	</div><!-- End container -->
			
</section>