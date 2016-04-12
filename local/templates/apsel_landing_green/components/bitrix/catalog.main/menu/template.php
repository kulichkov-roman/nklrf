<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if (!empty($arResult['ITEMS']))
{
?><div id="site-nav" class="navbar-collapse collapse">

	<ul class="nav navbar-nav navbar-right"><?
		foreach($arResult["ITEMS"] as $arItem)
		{
			if($arItem["SORT"] > "2000")
			{
				?><?
			}
			else
			{
				?><li><a class="scrollto" href="#<?=$arItem["CODE"]?>"><?=$arItem["NAME"]?></a></li><?
			}
		}
		?><li><a class="scrollto" href="#contact"><? echo GetMessage('CONTACT')?></a></li>
	</ul>
</div><?
}
?>