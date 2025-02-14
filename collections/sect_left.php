<?
$sid = 23115;//Временное решение привязка к одной категории
if ($_REQUEST['sec_id'] > 0) {
    $sid = $_REQUEST['sec_id'];
} else {
   $getSection = checkSectionIsActiveByUrl($_SERVER["REQUEST_URI"], 4);
	if($getSection["ID"]){
		$sid = $getSection["ID"];
	}else{
		$sid = omniGetSIDFromPageUrl(4, '/collections/');
	}
}
if ($sid > 0) {
    CModule::IncludeModule('iblock');
    $rSec = CIBlockSection::GetByID($sid);
    $arSec = $rSec->GetNext();
    $form_action = $arSec['SECTION_PAGE_URL'];
} else {
    $form_action = '/collections/';
}
$arNazn = [
    '/collections/aglomeratnaya-plitka',
    '/collections/dekorativnaya-plitka',
    '/collections/keramogranit',
    '/collections/klinker',
    '/collections/mozaika',
    '/collections/napolnaya-plitka',
    '/collections/nastennaya-plitka',
    '/collections/plitka-dlya-basseina',
    '/collections/plitka-dlya-vannoi',
    '/collections/plitka-dlya-kukhni'
];
if (in_array($APPLICATION->GetCurPage(), $arNazn)) {
    $sid = 0;
    /*if ($APPLICATION->GetCurPage() == '/collections/nastennaya-plitka') {
        $form_action = '/collections/';
    } else {*/
    $form_action = $APPLICATION->GetCurPage();
    //}
}
//проверим, находимся ли мы на странице элемента плитки
$isPlitkaElPage = false;
$curPagePath = $APPLICATION->GetCurPage(); //получаем адрес тек. страницы
$filterCatalogPath = $curPagePath;
if ($curPagePath[0] == '/') {
    //если адрес нач. со слэша, удаляем его
    $curPagePath = substr($curPagePath, 1);
}
if ($curPagePath[strlen($curPagePath) - 1] == '/') {
    //если адрес оканч. слэшом, удаляем его
    $curPagePath = substr($curPagePath, 0, -1);
    $filterCatalogPath = $curPagePath;

}
if (!empty($curPagePath) && empty($getSection) ) {
    $curPagePath = explode('/', $curPagePath); //разбиваем адрес
    $codeID = $curPagePath[count($curPagePath) - 1]; //берём последнее значение
    if (!empty($codeID)) {
        if (omniIsIBlockElement($codeID) !== false) { //элемент
            $isPlitkaElPage = true;
        }
    }
}

if (strpos($form_action, '/collections/') === false) {
    $skipDateAndPermissionsCheck = 'N';
} else {
    $skipDateAndPermissionsCheck = 'Y';
}

global $arrFilter;
$arrFilter['ACTIVE'] = "Y";


if ($_SERVER["SCRIPT_URL"]){
    /**
     * Пробрасываем значения для свойства в фильтр
     */
    switch ($_SERVER["SCRIPT_URL"]){
        case '/collections/keramogranit':{
            $arrFilter['DEPTH_LEVEL'] = 3;
            $arrFilter['PROPERTY_45'] = 28;
            break;
        }
        case '/collections/nastennaya-plitka':{
            $arrFilter['DEPTH_LEVEL'] = 3;
            $arrFilter['PROPERTY_45'] = 23;
            break;
        }
        case '/collections/napolnaya-plitka':{
            $arrFilter['DEPTH_LEVEL'] = 3;
            $arrFilter['PROPERTY_45'] = 26;
            break;
        }
        case '/collections/plitka-dlya-vannoi':{
            $arrFilter['DEPTH_LEVEL'] = 3;
            $arrFilter['PROPERTY_45'] = 24;
            break;
        }
        case '/collections/aglomeratnaya-plitka':{
            $arrFilter['DEPTH_LEVEL'] = 3;
            $arrFilter['PROPERTY_45'] = 5083;
            break;
        }
        case '/collections/dekorativnaya-plitka':{
            $arrFilter['DEPTH_LEVEL'] = 3;
            $arrFilter['PROPERTY_45'] = 5231;
            break;
        }
        case '/collections/plitka-dlya-basseina':{
            $arrFilter['DEPTH_LEVEL'] = 3;
            $arrFilter['PROPERTY_45'] = 1767;
            break;
        }
        case '/collections/plitka-dlya-kukhni':{
            $arrFilter['DEPTH_LEVEL'] = 3;
            $arrFilter['PROPERTY_45'] = 25;
            break;
        }
        case '/collections/klinker':{
            $arrFilter['DEPTH_LEVEL'] = 3;
            $arrFilter['PROPERTY_45'] = 29;
            break;
        }
        case '/collections/mozaika':{
            $arrFilter['DEPTH_LEVEL'] = 3;
            $arrFilter['PROPERTY_45'] = 27;
            break;
        }
    }
}

if (!$isPlitkaElPage) { ?>
    <? /* Если мы находимся на главной то скрываем фильтр */ ?>
    <? if ($APPLICATION->GetCurPage(false) !== '/'): ?>
        <? $APPLICATION->IncludeComponent(
	"custom:catalog.smart.filter", 
	"filter_vertical", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"SECTION_ID" => $sid,
		"FILTER_NAME" => "arrFilter",
		"PREFILTER_NAME" => "arrFilter",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"SHOW_BORDER" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "N",
		"SAVE_IN_SESSION" => "N",
		"XML_EXPORT" => "N",
		"SECTION_TITLE" => "NAME",
		"SECTION_DESCRIPTION" => "DESCRIPTION",
		"BACK_URL" => $APPLICATION->GetCurDir(),
		"FORM_ACTION" => $form_action,
		"SEARCH_EVERYWHERE" => "/collections/",
		"SKIP_DATE_AND_PERMISSIONS_CHECK" => $skipDateAndPermissionsCheck,
		"COMPONENT_TEMPLATE" => "filter_vertical",
		"SECTION_CODE" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"TEMPLATE_THEME" => "blue",
		"SEF_MODE" => "N",
		"PAGER_PARAMS_NAME" => "arrPager",
		"CONVERT_CURRENCY" => "N"
	),
	false,
	array(
		"HIDE_ICONS" => "N"
	)
);
							  
?>
    <? endif; ?>
    <? /* $APPLICATION->IncludeComponent(
        "sotbit:seo.meta",
        ".default",
        [
            "FILTER_NAME" => 'arrFilter',
            "SECTION_ID" => $sid,
            "CACHE_TYPE" => 'A',
            "CACHE_TIME" => '36000000',
        ]
    ); */ ?>
<?php } ?>
