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
FEATURED PROJECTS
=============================================== -->
		
<section class="gray-bg padding-top">
		
	<div class="container">
				
		<h1 class="section-title"><? echo GetMessage('LAST_PROJECT')?></h1>
		<p class="section-description"><? echo GetMessage('LAST_PROJECT_DESC')?></p>
		
		<p class="text-center"><a class="btn btn-qubico scrollto" href="#portfolio_<? echo SITE_ID; ?>"><?echo GetMessage('ALL_PROJECT')?></a></p>
		
		<div class="ipad-frame scrollimation fade-up">
					
			<img class="img-responsive img-center" src="<?=SITE_TEMPLATE_PATH?>/assets/ipad-landscape.png" alt=""/>
			
			<div class="ipad-screen ipad-slider flexslider">
						
			<ul class="slides"><?
			foreach ($arResult['ITEMS'] as $key => $arItem)
			{
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
				$strMainID = $this->GetEditAreaId($arItem['ID']);

				$arItemIDs = array(
					'ID' => $strMainID,
				);
				
				$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
			
				if (!empty($arItem['DETAIL_PICTURE']))
				{
					?><li id="<? echo $strMainID; ?>">
					
						<img class="img-responsive" src="<?=CTPic::resizeImage($arItem['DETAIL_PICTURE']['ID'], 'cropml', 650, 480)?>" alt="<? echo $arItem['NAME']; ?>"/>
						
					</li><?
				}
			}
			?></ul>
			
			</div>
			
		</div>
		
	</div>
	
</section><?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
}
?>