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

//if($USER->isAdmin())
//{
//	//echo "<pre>"; var_dump($arResult['ITEMS']); echo "</pre>";
//}

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
	
	$cnt = CIBlock::GetElementCount($arParams["IBLOCK_ID"]);
	
	$res = CIBlockSection::GetList(
		Array("LEFT_MARGIN"=>"ASC"), 
		Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y"), 
		true,
		Array("ID", "NAME", "DESCRIPTION", "CODE")
	);
		
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

			?><article class="col-md-4 col-sm-6 project-item  loaded-item <?
			
			$res = CIBlockElement::GetElementGroups($arItem['ID']);  
			while($ob = $res->Fetch())
			{
				echo $ob["CODE"].' ';
			}
			?>"><?

			$arItem["MORE_PHOTO"] = array();
			if(isset($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && is_array($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"]))
			{
				foreach($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $FILE)
				{
					$FILE = CFile::GetFileArray($FILE);
					if(is_array($FILE))
					{
						$arItem["MORE_PHOTO"][]=$FILE;
					}
				}
			}
			else
			{
				$FILE = CFile::GetFileArray($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"]);
				if(is_array($FILE))
				{
					$arItem["MORE_PHOTO"]=$FILE;
				}
			}
			?>

			<!--==== Project Thumbnail & Title ====-->

			<div class="project-thumb" id="<? echo $strMainID; ?>">
				<a href="#" class="main-link">
					<img class="img-responsive img-center" src="<?=CTPic::resizeImage($arItem['PREVIEW_PICTURE']['ID'], 'cropml', 360, 270)?>" alt="<? echo $arItem['NAME'];?>"/>
					<h2 class="project-title"><? echo $arItem['NAME']; ?></h2>
					<span class="overlay-mask"></span>
				</a>
				<?
				if (!empty($arItem["DETAIL_PICTURE"]) && !empty($arItem["MORE_PHOTO"]))
				{
					?><a class="enlarge" href="<?=CTPic::resizeImage($arItem['DETAIL_PICTURE']['ID'], 'landscape', 1024)?>" title="Title"><i class="fa fa-expand fa-fw"></i></a>
					<a class="link" href="#"><i class="fa fa-eye fa-fw"></i></a><?
				}
				else
				{
					?><a class="link centered" href=""><i class="fa fa-eye fa-fw"></i></a><?
				}
				?>
			</div><!-- End Thumbnail -->

			<!--==== Project Preview Content ====-->

			<div class="preview-content" data-images="<?
			if (!empty($arItem['DETAIL_PICTURE']))
			{
				echo CTPic::resizeImage($arItem['DETAIL_PICTURE']['ID'], 'landscape', 1024);
			}
			else
			{
				echo CTPic::resizeImage($arItem['PREVIEW_PICTURE']['ID'], 'landscape', 1024);
			}

			if (!empty($arItem["MORE_PHOTO"]))
			{
				foreach ($arItem["MORE_PHOTO"] as $photo)
				{
					echo ','.CTPic::resizeImage($photo['ID'], 'landscape', 1024);
				}
			}
			?>">
			
			<? 
			if (!empty($arItem['PREVIEW_TEXT']))
			{
				?><p class="preview-subtitle"><? echo $arItem['PREVIEW_TEXT']?></p><?
			}
			
			echo $arItem['DETAIL_TEXT']; 
			
			if (!empty($arItem['DISPLAY_PROPERTIES']['LINK_WEBSITE']['VALUE']))
			{
				?><p class="text-center"><a class="btn btn-qubico" href="<? echo $arItem['DISPLAY_PROPERTIES']['LINK_WEBSITE']['VALUE']?>" target="_blank"><? echo $arItem['DISPLAY_PROPERTIES']['LINK_WEBSITE']['NAME']?></a></p><?
			}
			
		?></div>

	</article><?
		}
}
?>