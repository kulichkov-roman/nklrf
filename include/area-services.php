<section class="color-bg light-typo padding-top-bottom cta-iphones">
		
	<div class="container">
		
		<div class="row">
		
			<div class="col-sm-6">
			
				<div class="iphones-wrapper scrollimation">
				
					<div class="iphone-portrait-frame">
						<img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/assets/iphone-portrait.png" alt=""/>
						<div class="iphone-portrait-screen">
							<img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/assets/iphone-portrait-screen-2.jpg" alt=""/>
						</div>
					</div>
							
					<div class="iphone-landscape-frame">
						<img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/assets/iphone-landscape.png" alt=""/>
						<div class="iphone-landscape-screen">
							<img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/assets/iphone-landscape-screen-2.jpg" alt=""/>
						</div>
					</div>
				</div>
						
			</div>
					
			<div class="col-sm-5 col-sm-offset-1">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR."include/cta-servises-text.php"
					)
				);?>
						
				<a class="btn btn-qubico white scrollto" href="#services_s1"><i class="fa fa-arrow-down"></i>Чем наполнить?</a>
						
			</div>
				
		</div>
			
	</div>
			
</section>