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
PRICES
=============================================== -->

<section id="<? echo $codeBlock;?>" class="gray-bg padding-top-bottom">
		
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
			$i++;
			$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
			
			$res = CIBlockElement::GetByID($arItem['PROPERTIES']['ICON']['VALUE']);
			if($ar_res = $res->GetNext()){};
			
			if ('Y' == $arItem['PROPERTIES']['BIG_COLUM']['VALUE_XML_ID'])
			{
				$selectColum = 'featured';
			}
			else
			{
				$selectColum = '';
			}
		
			if($key%$arParams["LINE_ELEMENT_COUNT"] == 0)
			{
				?><div class="row pricing"><div class="col-lg-10 col-lg-offset-1"><?
			}
			?><div class="col-sm-4 text-center">

				<div class="item <? echo $selectColum?> scrollimation <? echo $arItem['PROPERTIES']['ANIMATIONS']['VALUE']; ?>" id="<? echo $strMainID; ?>">

					<p class="icon"><i class="<? echo $ar_res['NAME']; ?> fa-fw"></i></p>
					<h2><? echo $arItem['NAME']; ?></h2>
					
					<p class="price"><? echo $arItem['PROPERTIES']['PRICE']['VALUE']; ?></p>
					<?
					foreach ($arItem['DISPLAY_PROPERTIES'] as $k=>$arOneProp)
					{
						if (strstr($k,'PROP')){
						?><p><?
							echo (
								is_array($arOneProp['DISPLAY_VALUE'])
								? implode('  ', $arOneProp['DISPLAY_VALUE'])
								: $arOneProp['DISPLAY_VALUE']
							);
						?></p><?
						}
					}					
	
					if (!empty($arItem['PROPERTIES']['LINK_ORDER']['VALUE']))
					{
						?><a onClick="javascript:MF.MESSAGE.value='<? echo GetMessage('ORDER').' '.$arItem['NAME'].' '.GetMessage('ORDER_ZA').' '.$arItem['PROPERTIES']['PRICE']['VALUE']; ?> \n<? echo GetMessage('ORDER_OTHER')?>\n'" class="btn btn-qubico scrollto" href="<? echo $arItem['PROPERTIES']['LINK_ORDER']['VALUE']; ?>"><i class="fa fa-shopping-cart"></i> <? echo $arItem['PROPERTIES']['LINK_ORDER']['NAME']; ?></a><?
					}
					?>
					
			
				</div><!-- End Pricing Item -->
							
			</div><?
			$key++;
			if($key%$arParams["LINE_ELEMENT_COUNT"] == 0)
			{
				?></div></div><?
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