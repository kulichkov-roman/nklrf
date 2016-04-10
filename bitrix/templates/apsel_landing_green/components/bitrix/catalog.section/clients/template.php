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
CLIENTS
=============================================== -->

<section id="<? echo $codeBlock;?>" class="white-bg padding-top-bottom">
		
	<div class="container">
				
		<h1 class="section-title"><? echo $nameBlock?></h1>
		<p class="section-description"><? echo $descriptionBlock ?></p>
		<?
		$i=0;
		foreach ($arResult['ITEMS'] as $key => $arItem)
		{
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
			$strMainID = $this->GetEditAreaId($arItem['ID']);

			$arItemIDs = array(
				'ID' => $strMainID,
			);
			
			$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
			
		
			if($key%$arParams["LINE_ELEMENT_COUNT"] == 0)
			{
			$i++;
				?><div class="row clients"><?
			}
			?><div class="col-sm-6 col-md-3">
					
				<div class="client scrollimation fade-up d<? echo $i?>">
					<a href="<? echo $arItem['DISPLAY_PROPERTIES']['LINK_WEBSITE']['VALUE']; ?>" target="_blank"><img class="img-responsive img-center" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']?>" alt="<? echo $arItem['NAME']; ?>"/></a>
				</div>
				
			</div><?
			$key++;
			if($key%$arParams["LINE_ELEMENT_COUNT"] == 0)
			{
				?></div><?
			}
		}
	?></div>
	
</section><?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
}
?>