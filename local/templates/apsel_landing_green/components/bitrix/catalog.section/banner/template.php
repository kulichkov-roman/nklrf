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

	$codeBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "CODE");
	
	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
	
?>

<!-- ==============================================
HEADER
=============================================== -->


<header id="home" class="jumbotron">

	<div id="sequence-theme">
	
		<div id="sequence">
		
			<ul class="controls">
				<li class="sequence-prev"><i class="fa fa-angle-left fa-fw"></i></li>
				<li class="sequence-next"><i class="fa fa-angle-right fa-fw"></i></li>
			</ul>
			
			<ul class="sequence-canvas container">
            <?
            
            foreach ($arResult['ITEMS'] as $key => $arItem)
            {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
                $strMainID = $this->GetEditAreaId($arItem['ID']);
    
                $arItemIDs = array(
                    'ID' => $strMainID,
                );
                
                $strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
                
                if ('TYPE_1' == $arItem['DISPLAY_PROPERTIES']['TYPE']['VALUE_XML_ID'])
                {
                    ?><li class="animate-in">
                        <div class="message-slide1">
                            <h2 class="title in-from-left fast"><? echo $arItem['NAME']; ?></h2>
                            <p class="in-from-bottom fast delay2"><?echo $arItem['PREVIEW_TEXT']?></p>
                        </div>
                        <div class="slide1-img in-from-right slow delay1">
                            <img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/assets/slider/imac.png" alt="<? echo $arItem['NAME']; ?>" />
                            <div class="imac-screen">
                                <img class="img-responsive" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<? echo $arItem['NAME']; ?>" />
                            </div>
                        </div>
                    </li><?
                }
                elseif ('TYPE_2' == $arItem['DISPLAY_PROPERTIES']['TYPE']['VALUE_XML_ID'])
                {
                    ?><li>
                        <div class="message-slide2">
                            <h2 class="title in-from-right fast delay1"><? echo $arItem['NAME']; ?></h2>
                            <p class="in-from-bottom fast delay2"><?echo $arItem['PREVIEW_TEXT']?></p>
                        </div>
                        <div class="slide2-img in-from-top fast">
                            <img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/assets/slider/ipad-flat.png" alt="<? echo $arItem['NAME']; ?>" />
                            <div class="ipad-screen">
                                <img class="img-responsive" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<? echo $arItem['NAME']; ?>" />
                            </div>
                        </div>
                    </li><?
                }
            }
		?></div>
		
	</div>
    
</header>
    <?
}
?>