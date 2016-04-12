<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<!-- ==============================================
CONTACT
=============================================== -->
<?$frame = $this->createFrame()->begin();?>
<section id="contact" class="gray-bg padding-top-bottom">
			
	<div class="container">
			
		<h1 class="section-title"><? echo GetMessage('FORM_HEADER')?></h1>
		<p class="section-description"><? echo GetMessage('FORM_SLOGAN')?></p>
				
		<div class="row">
				
			<div class="col-sm-4 text-center contact-item scrollimation fade-right in">
					
				<a class="icon" href="#link"><i class="fa fa-map-marker fa-fw"></i></a>
				<h2><? echo GetMessage('FORM_LOCATION')?></h2>
				
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."include/address.php",
						"EDIT_TEMPLATE" => ""
					),
					false,
					array('HIDE_ICONS' => 'Y')
				);?>
				
			</div>
		
			<div class="col-sm-4 text-center contact-item scrollimation fade-up in">
			
				<a class="icon" href="#link"><i class="fa fa-envelope fa-fw"></i></a>
				<h2><? echo GetMessage('FORM_EMAIL')?></h2>
				
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."include/email.php",
						"EDIT_TEMPLATE" => ""
					),
					false,
					array('HIDE_ICONS' => 'Y')
				);?>
				
			</div>
					
			<div class="col-sm-4 text-center contact-item scrollimation fade-left in">
			
				<a class="icon" href="#link"><i class="fa fa-phone fa-fw"></i></a>
				<h2><? echo GetMessage('FORM_CALL')?></h2>

				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."include/phone.php",
						"EDIT_TEMPLATE" => ""
					),
					false,
					array('HIDE_ICONS' => 'Y')
				);?>
			
			</div>
			
		</div>
				
		<h1 id="order" class="subsection-title"><? echo GetMessage('FORM_SLOGAN_TEXT')?></h1>
		<p class="subsection-description"><? echo GetMessage('FORM_TEXT')?></p>

	
		<div class="row">
		
		<!--=== Contact Form ===-->

			<form name="MF" action="<?=POST_FORM_ACTION_URI?>" class="col-sm-6 col-sm-offset-3" method="POST" novalidate>
			<?=bitrix_sessid_post()?>
			
				<div id="contact-form"><?
				if(!empty($arResult["ERROR_MESSAGE"]))
				{
				?><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button><?
					foreach($arResult["ERROR_MESSAGE"] as $key=>$v)
					{
						?><? 
							echo $v.'<br>';
						?><?
					}
				?></div><?
				}
				
				if(strlen($arResult["OK_MESSAGE"]) > 0)
				{
					?><div class="success alert-success alert"><?=$arResult["OK_MESSAGE"]?><button type="button" class="close" data-dismiss="alert">&times;</button></div><?
				}
				?><div class="form-group">
						<label class="control-label" for="contact-name"><?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
						<div class="controls">
							<input id="contact-name" name="user_name" value="<?//=$arResult["AUTHOR_NAME"]?>" placeholder="<?=GetMessage("MFT_NAME")?>" class="form-control requiredField label_better" type="text" data-error-empty="Please enter your name">
							<i class="fa fa-user"></i>
						</div>
					</div><!-- End name input -->
							
					<div class="form-group">
						<label class="control-label" for="contact-mail"><?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
						<div class="controls">
							<input id="contact-mail" name="user_email" value="<?//=$arResult["AUTHOR_EMAIL"]?>" placeholder="<?=GetMessage("MFT_EMAIL")?>" class="form-control requiredField label_better" type="email" data-error-empty="Please enter your email" data-error-invalid="Invalid email address">
							<i class="fa fa-envelope"></i>
						</div>
					</div><!-- End email input -->
						
					<div class="form-group">
						<label class="control-label" for="contact-message"><?=GetMessage("MFT_MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
						<div class="controls">
							<textarea id="contact-message" name="MESSAGE"  placeholder="<?=GetMessage("MFT_MESSAGE")?>" class="form-control requiredField label_better" rows="6" data-error-empty="Please enter your message"><?=$arResult["MESSAGE"]?></textarea>
							<i class="fa fa-comment"></i>
						</div>
					</div><!-- End textarea -->
					<?if($arParams["USE_CAPTCHA"] == "Y"):?>
					<div class="form-group">
						<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
						<div class="controls">
							<div class="row">
								<div class="col-sm-7 col-md-7">
									<input class="form-control requiredField label_better" type="text" name="captcha_word" size="30" maxlength="50" placeholder="<?=GetMessage("MFT_CAPTCHA_CODE")?>" value="">
									<i class="fa fa-ticket"></i>
								</div>
								<div class="col-sm-5 col-md-5">
									<img class="pull-right" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
								</div>
							</div>
						</div>
					</div>
					<?endif;?>
				
					<p><button value="<?=$arResult["PARAMS_HASH"]?>" name="submit" type="submit" class="btn btn-qubico btn-block" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent"><i class="fa fa-location-arrow"></i><?=GetMessage("MFT_SUBMIT")?></button></p>
					<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
				
				</div>
			
			</form><!-- End contact-form -->

		</div>

	</div>
	
</section>
<?$frame->end();?>