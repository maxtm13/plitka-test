<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arThemes = array();
if (IsModuleInstalled('bitrix.eshop'))
{
	$arThemes['site'] = GetMessage('CP_BCT_TPL_THEME_SITE');
}

$arThemesMessages = array(
	"blue" => GetMessage("CP_BCT_TPL_THEME_BLUE"),
	"wood" => GetMessage("CP_BCT_TPL_THEME_WOOD"),
	"yellow" => GetMessage("CP_BCT_TPL_THEME_YELLOW"),
	"green" => GetMessage("CP_BCT_TPL_THEME_GREEN"),
	"red" => GetMessage("CP_BCT_TPL_THEME_RED"),
	"black" => GetMessage("CP_BCT_TPL_THEME_BLACK")
);
$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
if (is_dir($dir) && $directory = opendir($dir))
{
	while (($file = readdir($directory)) !== false)
	{
		if ($file != "." && $file != ".." && is_dir($dir.$file))
			$arThemes[$file] = (!empty($arThemesMessages[$file]) ? $arThemesMessages[$file] : strtoupper(substr($file, 0, 1)).strtolower(substr($file, 1)));
	}
	closedir($directory);
}

$arTemplateParameters['TEMPLATE_THEME'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage("CP_BCT_TPL_TEMPLATE_THEME"),
	'TYPE' => 'LIST',
	'VALUES' => $arThemes,
	'DEFAULT' => 'blue',
	'ADDITIONAL_VALUES' => 'Y'
);

$arTemplateParameters['FORM_ACTION'] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("FORM_ACTION_NAME"),
	"TYPE" => "STRING",
	"DEFAULT" => "/",
); 

$arTemplateParameters['SEARCH_EVERYWHERE'] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SERACH_EVERYWHERE_NAME"),
	"TYPE" => "STRING",
	"DEFAULT" => "",
); 

?>