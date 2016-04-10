<section class="gray-bg cta">
		
	<div class="container">
			
		<div class="row">
					
			<div class="col-md-8 cta-message">
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
			<div class="col-md-4 cta-button">
				<p class="text-center"><a class="btn btn-qubico scrollto" href="#portfolio_s1"><i class="fa fa-arrow-down"></i>Узнать подробнее</a></p>
			</div>
		</div><!--End row-->
		
	</div><!--End container -->
			
</section><!--End Call to Action -->