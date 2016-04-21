<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/*
 * уменьшить изображения
 */
$arIds = array();
foreach($arResult["ITEMS"] as &$arItem)
{
	if(is_array($arItem["PREVIEW_PICTURE"]))
	{
		$arIds[] = $arItem["PREVIEW_PICTURE"]["ID"];
	}
}
unset($arItem);
if(sizeof($arIds) > 0)
{
	$strIds = implode(",", $arIds);
	$fl = new CFile;
	$arOrder = array();
	$arFilter = array(
		"MODULE_ID" => "iblock",
		"@ID" => $strIds
	);
	$arPreviewPicture = array();
	$rsFile = $fl->GetList($arOrder, $arFilter);
	while($arItem = $rsFile->GetNext())
	{
		$arPreviewPicture[$arItem["ID"]] = $arItem;

		$arParamsResize = array(
			'ID' => $arItem["ID"],
			'MODE' => 'landscape',
			'WIDTH' => 470
		);

		$urlPreviewPicture = \KLRF\Helper\ImageHelper::getResizeImages('tpic',$arParamsResize);

		$arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
	}
	foreach($arResult["ITEMS"] as &$arItem)
	{
		$arItem["PREVIEW_PICTURE"]["SRC"] =  $arPreviewPicture[$arItem["PREVIEW_PICTURE"]["ID"]]["SRC"];
	}
	unset($arItem);
}
?>