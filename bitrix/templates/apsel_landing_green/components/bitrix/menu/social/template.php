<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<?$frame = $this->createFrame()->begin();?>

<?if (!empty($arResult)):?>
<ul class="social-links">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li><a href="<?=$arItem["LINK"]?>" class="selected" target="_blank"><i class="fa fa-<?=$arItem["TEXT"]?> fa-fw"></i></a></li>
	
<?endforeach?>

</ul>
<?endif?>

<?$frame->end();?>