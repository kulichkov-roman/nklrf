<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("title", "Kulichkov.PRO — разработка сайтов на 1С-Битрикс");
$APPLICATION->SetTitle("Kulichkov.PRO — разработка сайтов на 1С-Битрикс");
?><?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form", 
	".default", 
	array(
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
		),
		"IBLOCK_ID" => "53",
		"IBLOCK_TYPE" => "developers",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "169",
			1 => "NAME",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "NAME",
		),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br><?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>