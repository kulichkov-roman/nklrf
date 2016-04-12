<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (!empty($arResult['ITEMS']))
{
	$templateData = array(
		'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
		'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
	);

	if ($arParams["DISPLAY_TOP_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}

	$codeBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "CODE");
	$nameBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "NAME");
	$descriptionBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "DESCRIPTION");
	
	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
	
?>

<!-- ==============================================
SERVICES
=============================================== -->

<section id="<? echo $codeBlock;?>" class="white-bg padding-top-bottom">
		
	<div class="container">
				
		<h1 class="section-title"><? echo $nameBlock?></h1>
		<p class="section-description"><? echo $descriptionBlock ?></p>
		<?
		$i=1;
		foreach ($arResult['ITEMS'] as $key => $arItem)
		{
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
			$strMainID = $this->GetEditAreaId($arItem['ID']);

			$arItemIDs = array(
				'ID' => $strMainID,
			);
			
			$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
			
			$res = CIBlockElement::GetByID($arItem['PROPERTIES']['ICON']['VALUE']);
			if($ar_res = $res->GetNext()){}
		
			if($key%$arParams["LINE_ELEMENT_COUNT"] == 0)
			{
				?><div class="row services"><?
			}
			?><div class="col-sm-3 item text-center scrollimation fade-<?=$i<3?'right':'left'?> <?=(($i==1)||($i==count($arResult['ITEMS'])))?'d2':'';?>" id="<? echo $strMainID; ?>">
				
				<div class="icon"><i class="<? echo $ar_res['NAME']; ?>"></i></div>
				<h3><? echo $arItem['NAME']; ?></h3>
				<p><? echo $arItem['PREVIEW_TEXT']; ?></p>
						
			</div><?
			$key++;
			if($key%$arParams["LINE_ELEMENT_COUNT"] == 0)
			{
				?></div><?
			}
			$i++;
		}
	?></div>
	
</section><?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
}
?>