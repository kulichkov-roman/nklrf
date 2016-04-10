<section class="color-bg light-typo cta">
		
	<div class="container">
			
		<div class="row">
			<div class="col-md-9 cta-message">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => SITE_DIR."include/cta-text.php"
				)
			);?>	
			</div>
			<div class="col-md-3 cta-button">
				<p class="text-center"><a class="btn btn-qubico white scrollto" href="#order"><i class="fa fa-shopping-cart"></i>Получить сейчас</a></p>
			</div>
		</div><!--End row-->
				
	</div><!--End container -->
			
</section><!--End Call to Action -->