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
	$_pages = $cnt / 3;
	$_pages=(round($_pages)==$_pages)?$_pages:round($_pages)+1;
?>

<!-- ==============================================
PORTFOLIO
=============================================== -->
<script>
	var portfolio_count_page = <?=$_pages?>;
</script>
<section id="<? echo $codeBlock;?>" class="gray-bg padding-top-bottom">

	<div class="container">

		<h1 class="section-title"><? echo $nameBlock?></h1>
		<p class="section-description"><? echo $descriptionBlock ?></p>

		<?
		$res = CIBlockSection::GetList(
			Array("LEFT_MARGIN"=>"ASC"),
			Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y"),
			true,
			Array("ID", "NAME", "DESCRIPTION", "CODE")
		);
		?>


		<!--==== Portfolio Filters ====-->

		<div id="filter-works">

			<ul>
				<li class="active">
					<a href="#" data-filter="*"><?echo GetMessage('ALL_CATEGORIES')?></a>
				</li><?
				while($arSection = $res->GetNext())
				{
					?><li>
						<a href="#" data-filter=".<? echo $arSection['CODE']?>"><? echo $arSection['NAME']?></a>
					</li><?
				}
				?>
			</ul>

		</div><!--End portfolio filters -->

		<div class="projects-container scrollimation">

			<div class="row"><?
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


				?><article class="col-md-4 col-sm-6 project-item
					<?$res = CIBlockElement::GetElementGroups($arItem['ID']);
					while($ob = $res->Fetch())
					{
						echo $ob["CODE"].' ';
					}
					?>">
				<?
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
				}else{
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
							<?/*<img class="img-responsive img-center" src="<? echo $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<? echo $arItem['NAME']; ?>"/>*/?>
							<h2 class="project-title"><? echo $arItem['NAME']; ?></h2>
							<span class="overlay-mask"></span>
						</a>
						<?
						if (!empty($arItem["DETAIL_PICTURE"]) && !empty($arItem["MORE_PHOTO"]))
						{
							?><a class="enlarge" href="<?=CTPic::resizeImage($arItem['DETAIL_PICTURE']['ID'], 'landscape', 1024)?>" title="<? echo $arItem['NAME']; ?>"><i class="fa fa-expand fa-fw"></i></a>
							<a class="link" href="#"><i class="fa fa-eye fa-fw"></i></a><?
						}
						else
						{
						?><a class="link centered" href=""><i class="fa fa-eye fa-fw"></i></a><?
						}
						?>
					</div><!-- End Thumbnail -->

					<!--==== Project Preview Content ====-->

					<div class="preview-content" data-images="
					<?
					if (!empty($arItem['DETAIL_PICTURE']))
					{
						echo $arItem['DETAIL_PICTURE']['SRC'];
					}
					else
					{
						echo $arItem['PREVIEW_PICTURE']['SRC'];
					}

					if (!empty($arItem["MORE_PHOTO"]))
					{
						foreach ($arItem["MORE_PHOTO"] as $photo)
						{
							echo ','.CTPic::resizeImage($photo['ID'], 'landscape', 1024);
						}
					}
					?>
					">
						<? if (!empty($arItem['PREVIEW_TEXT'])){?>
						<p class="preview-subtitle"><? echo $arItem['PREVIEW_TEXT']?></p>
						<?}?>

						<? echo $arItem['DETAIL_TEXT']; ?>

						<? if (!empty($arItem['DISPLAY_PROPERTIES']['LINK_WEBSITE']['VALUE'])){?>
						<p class="text-center"><a class="btn btn-qubico" href="<? echo $arItem['DISPLAY_PROPERTIES']['LINK_WEBSITE']['VALUE']?>" target="_blank"><? echo $arItem['DISPLAY_PROPERTIES']['LINK_WEBSITE']['NAME']?></a></p>
						<?}?>
					</div><!-- End Project Preview -->

				</article><?
			}
			?></div><!-- End Row -->

		</div><!-- End Projects Container -->
		<?
		if ($cnt > $arParams['PAGE_ELEMENT_COUNT'])
		{
			?><p class="text-center"><a id="ajax-load" class="btn btn-qubico" href="#"><i class="fa fa-plus-circle"></i><?echo GetMessage('LOAD_MORE')?></a></p><?
		}
		?>

	</div><!-- End container -->

	<!--==== Project Preview Panel (DO NOT REMOVE)====-->

	<div id="preview-scroll"></div>

	<div id="project-preview">

		<div class="container">

			<div class="preview-header text-center">
				<a class="close-preview" href="#">&times;</a>
				<h1 class="preview-title"></h1>
				<p class="preview-subtitle"></p>
			</div>

			<div class="imac-frame">

				<img class="img-responsive img-center" src="<?=SITE_TEMPLATE_PATH?>/assets/imac.png" alt="sss"/>
				<span class="loader"></span>
				<div class="imac-screen imac-slider flexslider"></div>

			</div>

			<div class="row">
				<div id="preview-content" class="col-sm-10 col-sm-offset-1"></div>
			</div>

			<div class="preview-footer text-center">
				<a class="close-preview" href="#">&times;</a>
			</div>


		</div><!--End container -->

	</div><!--End #project-preview panel-->

</section><?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
}
?>