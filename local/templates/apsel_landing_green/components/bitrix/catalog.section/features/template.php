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
$this->createFrame()->begin('Загрузка');

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
FEATURES
=============================================== -->

<section id="<? echo $codeBlock;?>" class="white-bg padding-top-bottom">
	<div class="container features">
				
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
			$i++;
			$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
			
			$res_ico_1 = CIBlockElement::GetByID($arItem['PROPERTIES']['ICON_1']['VALUE']);
			if($ar_res_ico_1 = $res_ico_1->GetNext()){}

			$res_ico_2 = CIBlockElement::GetByID($arItem['PROPERTIES']['ICON_2']['VALUE']);
			if($ar_res_ico_2 = $res_ico_2->GetNext()){}
		

			if($key%$arParams["LINE_ELEMENT_COUNT"] == 0)
			{
				?><div class="row"><?
			}
			
			?><div class="col-sm-4 scrollimation fade-up d<? echo $i?>">
			
				<div class="media" id="<? echo $strMainID; ?>">
					<div class="icon pull-left">
						<i class="media-object icon-1 <? echo $ar_res_ico_1['NAME']; ?>"></i>
						<i class="media-object icon-2 <? echo $ar_res_ico_2['NAME']; ?>"></i>
					</div>
							
					<div class="media-body">
						<h4><? echo $arItem['NAME']; ?></h4>
						<p><? echo $arItem['PREVIEW_TEXT']; ?></p>
					</div>
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