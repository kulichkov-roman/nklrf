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
	
?><section id="<? echo $codeBlock;?>" class="white-bg padding-top-bottom">
		
	<div class="container">
				
		<h1 class="section-title"><? echo $nameBlock?></h1>
		<p class="section-description"><? echo $descriptionBlock ?></p><?
		
		$arExpirience = array();
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
			if($ar_res = $res->GetNext()){}
			
			if ($key%2 == 0) $align ='';
			if ($key%2 != 0) $align ='right';
			
			if ($key%2 == 0) $position ='col-sm-offset-1';
			if ($key%2 != 0) $position ='col-sm-push-8';			
			
			if ($key%2 == 0) $positionBlock ='';
			if ($key%2 != 0) $positionBlock ='col-sm-pull-2';			
			
			if ($key%2 == 0) $animatedLeftBlock ='right';
			if ($key%2 == 0) $animatedRightBlock ='left';
			
			if ($key%2 != 0) $animatedLeftBlock ='left';
			if ($key%2 != 0) $animatedRightBlock ='right';
		
		?><div class="row team-member <? echo $align?>" id="<? echo $strMainID; ?>">
				
			<div class="col-sm-3 <? echo $position;?> member-thumb scrollimation fade-<? echo $animatedLeftBlock?>">
			
				<img class="img-responsive img-center" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" title="<? echo $arItem['NAME'].', '.$arItem['PROPERTIES']['post']['VALUE']; ?>" alt="<? echo $arItem['NAME'].', '.$arItem['PROPERTIES']['post']['VALUE']; ?>" />
				<h4><? echo $arItem['NAME']; ?></h4>
				<p class="title"><? echo $arItem['PROPERTIES']['post']['VALUE']; ?></p>
				
			</div>
					
			<div class="col-sm-7 scrollimation <? echo $positionBlock;?> fade-<? echo $animatedRightBlock?>">
			
				<div class="member-details">
				
					<p><? echo $arItem['PREVIEW_TEXT']; ?></p>
					
					<ul class="member-socials"><?
					foreach ($arItem['DISPLAY_PROPERTIES'] as $prop)
					{
						if ($prop['CODE'] != 'post')
						{
							?><li><a href="<? echo $prop['DISPLAY_VALUE'];?>"><i class="fa fa-<? echo $prop['CODE'];?> fa-fw"></i></a></li><?
						}
					}	
					?></ul>
					
				</div>
				
			</div>
			
		</div><?
			foreach ($arItem['DISPLAY_PROPERTIES'] as $k=>$prop)
			{
				if (strstr($k,'SKILLS'))
				{
					$arExpirience[$prop["ID"]]['NAME'] = $prop["NAME"];
					$arExpirience[$prop["ID"]]['CODE'] = $prop["CODE"];
					$arExpirience[$prop["ID"]]['VALUE_XML_ID']+= $prop["VALUE_XML_ID"];
					$arExpirience[$prop["ID"]]['VALUE_XML_TEXT'].='_'.$prop["VALUE_XML_ID"];
					$arExpirience[$prop["ID"]]['COUNT']+= 1;
				}
			}	
		}
	
	if (!empty($arExpirience))
	{
		?><h1 class="subsection-title"><? echo GetMessage('SKILLS_HEADER')?></h1>
		<p class="subsection-description"><? echo GetMessage('SKILLS_TEXT')?></p>
		
		<div class="row skills"><?
		foreach ($arExpirience as $k=>$exsp)
		{
			?><div class="col-sm-6 col-md-3 text-center">
				<div class="chart-wrapper">
					<span class="chart" data-percent="<?=round($exsp['VALUE_XML_ID']/$exsp['COUNT']);?>"><span class="percent countTo" data-to="<?=round($exsp['VALUE_XML_ID']/$exsp['COUNT']);?>" data-speed="2000"></span></span>
				</div>
				<h2 class="text-center"><?=$exsp['NAME'];?></h2>
			</div><?
		}
		?></div><?
	}
	?></div>
	
</section><?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
}
?>