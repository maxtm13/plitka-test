<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
global $arrFilter;
$arrFilter["!PROPERTY_AVAILABILITY"] = [5044, 5649, 4914];
$arrFilter[] = 
["LOGIC"=> "OR",
	"!PROPERTY_DISCOUNT_PERCENT" => false,
	"!PROPERTY_OLD_PRICE" => false,
];
		if (!empty($arResult["IS_LINCED_EMPTY_COL1"])) {
			$subSections = [];
			$GLOBALS['arrFilterCol'] = array("IBLOCK_SECTION_ID" => $arResult["AR_LINKS_COL"]);
			
			$res = CIBlockSection::GetList([], ["ID"=>$arResult["AR_LINKS_COL"]["I1"], "ACTIVE"=>"N"], false, ["ID", "ACTIVE"]);
			while($ob = $res->GetNext()){
				$subSections[] = $ob["ID"];
			}
			unset($res, $ob);
			
			foreach ($arResult["AR_LINKS_COL"]["I1"] as $val){
				if(!in_array($val, $subSections)){
					$SECNAMES = CIBlockSection::GetByID($val);
					if($SECNAME_res = $SECNAMES->GetNext()){
						$SECNAME_ANS = $SECNAME_res['NAME'];
						$SEC_SECTION = $SECNAME_res['IBLOCK_SECTION_ID'];
						$SEC_COL_URL = $SECNAME_res['SECTION_PAGE_URL'];
					}
					$SECNAMES = CIBlockSection::GetByID($SEC_SECTION);
					if($SECNAME_res = $SECNAMES->GetNext()){
						$SEC_SECTION_NAME = $SECNAME_res['NAME'];
						$SEC_URL = $SECNAME_res['SECTION_PAGE_URL'];
					}
				
					?><H3><a href = "<? echo $SEC_URL; ?>"> <? echo $SEC_SECTION_NAME; ?></a> / <a class="Col_url" href="<? echo $SEC_COL_URL ?>"><? echo $SECNAME_ANS; ?></a></H3><?
					$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						"rbs-promotions",
						[
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "4",
						"SECTION_ID" => $val,
						"SECTION_CODE" => "",
						"SECTION_USER_FIELDS" => [
							 0 => "UF_MORO_PHOTO",
							 1 => "",
						],
						"ELEMENT_SORT_FIELD" => $sort_by,
						"ELEMENT_SORT_ORDER" => $sort_order,
						"ELEMENT_SORT_FIELD2" => "name",
						"ELEMENT_SORT_ORDER2" => "asc",
						"FILTER_NAME" => "arrFilter",
						"INCLUDE_SUBSECTIONS" => "Y",
						"SHOW_ALL_WO_SECTION" => "Y",
						"HIDE_NOT_AVAILABLE" => "Y",
						"PAGE_ELEMENT_COUNT" => (!empty($_REQUEST['el_c'])) ? intval($_REQUEST['el_c']) : 40,
						"LINE_ELEMENT_COUNT" => "4",
						"PROPERTY_CODE" => [
							 0 => "NIGHT_PRICE",
							 1 => "",
						],
						"OFFERS_LIMIT" => "1",
						"TEMPLATE_THEME" => "",
						"PRODUCT_SUBSCRIPTION" => "N",
						"SHOW_DISCOUNT_PERCENT" => "Y",
						"SHOW_OLD_PRICE" => "Y",
						"SHOW_CLOSE_POPUP" => "N",
						"MESS_BTN_BUY" => "Купить",
						"MESS_BTN_ADD_TO_BASKET" => "В корзину",
						"MESS_BTN_SUBSCRIBE" => "Подписаться",
						"MESS_BTN_DETAIL" => "Подробнее",
						"MESS_NOT_AVAILABLE" => "Нет в наличии",
						"SECTION_URL" => "",
						"DETAIL_URL" => "",
						"SECTION_ID_VARIABLE" => "SECTION_ID",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_GROUPS" => "N",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"BROWSER_TITLE" => "-",
						"SET_META_KEYWORDS" => "N",
						"META_KEYWORDS" => "-",
						"SET_META_DESCRIPTION" => "N",
						"META_DESCRIPTION" => "-",
						"ADD_SECTIONS_CHAIN" => "N",
						"CACHE_FILTER" => "Y",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRICE_CODE" => [
							 0 => "BASE",
						],
						"USE_PRICE_COUNT" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"CONVERT_CURRENCY" => "N",
						"BASKET_URL" => "/personal/cart/",
						"USE_PRODUCT_QUANTITY" => "Y",
						"ADD_PROPERTIES_TO_BASKET" => "N",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"PRODUCT_PROPERTIES" => [
						],
						"ADD_TO_BASKET_ACTION" => "ADD",
						"DISPLAY_COMPARE" => "N",
						"PAGER_TEMPLATE" => "arrows",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"PAGER_TITLE" => "Товары",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"ADD_PICT_PROP" => "-",
						"LABEL_PROP" => "-",
						"MESS_BTN_COMPARE" => "Сравнить",
						"PRODUCT_QUANTITY_VARIABLE" => "quantity",
						"COMPONENT_TEMPLATE" => "product-list",
						"SEF_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"SET_LAST_MODIFIED" => "N",
						"USE_MAIN_ELEMENT_SECTION" => "N",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"SHOW_404" => "N",
						"SET_STATUS_404" => "N",
						"CUSTOM_FILTER" => "",
						"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
						"BACKGROUND_IMAGE" => "-",
						"COMPATIBLE_MODE" => "Y",
						"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				  ],
				  false
					);
				}
			}
		}
		if (!empty($arResult["IS_LINCED_EMPTY_COL2"])) {
			$GLOBALS['arrFilterCol1'] = array("IBLOCK_SECTION_ID" => $arResult["AR_LINKS_COL"]);
			$subSections = [];
			
			$res = CIBlockSection::GetList([], ["ID"=>$arResult["AR_LINKS_COL"]["I2"], "ACTIVE"=>"N"], false, ["ID", "ACTIVE"]);
			while($ob = $res->GetNext()){
				$subSections[] = $ob["ID"];
			}
			unset($res, $ob);
			
			foreach ($arResult["AR_LINKS_COL"]["I2"] as $val){
				$SECNAMES = CIBlockSection::GetByID($val);
				if(!in_array($val, $subSections)){
						if($SECNAME_res = $SECNAMES->GetNext()){
							$SECNAME_ANS = $SECNAME_res['NAME'];
							$SEC_SECTION = $SECNAME_res['IBLOCK_SECTION_ID'];
							$SEC_COL_URL = $SECNAME_res['SECTION_PAGE_URL'];
						}
						$SECNAMES = CIBlockSection::GetByID($SEC_SECTION);
						if($SECNAME_res = $SECNAMES->GetNext()){
							$SEC_SECTION_NAME = $SECNAME_res['NAME'];
							$SEC_URL = $SECNAME_res['SECTION_PAGE_URL'];
						}
					?><H3><a href = "<? echo $SEC_URL; ?>"> <? echo $SEC_SECTION_NAME; ?></a> / <a class="Col_url" href="<? echo $SEC_COL_URL ?>"><? echo $SECNAME_ANS; ?></a></H3><?
					$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						"rbs-promotions",
						[
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "9",
						"SECTION_ID" => $val,
						"SECTION_CODE" => "",
						"SECTION_USER_FIELDS" => [
							 0 => "UF_MORO_PHOTO",
							 1 => "",
						],
						"ELEMENT_SORT_FIELD" => $sort_by,
						"ELEMENT_SORT_ORDER" => $sort_order,
						"ELEMENT_SORT_FIELD2" => "name",
						"ELEMENT_SORT_ORDER2" => "asc",
						"FILTER_NAME" => "arrFilter",
						"INCLUDE_SUBSECTIONS" => "Y",
						"SHOW_ALL_WO_SECTION" => "Y",
						"HIDE_NOT_AVAILABLE" => "Y",
						"PAGE_ELEMENT_COUNT" => (!empty($_REQUEST['el_c'])) ? intval($_REQUEST['el_c']) : 40,
						"LINE_ELEMENT_COUNT" => "4",
						"PROPERTY_CODE" => [
							 0 => "NIGHT_PRICE",
							 1 => "",
						],
						"OFFERS_LIMIT" => "1",
						"TEMPLATE_THEME" => "",
						"PRODUCT_SUBSCRIPTION" => "N",
						"SHOW_DISCOUNT_PERCENT" => "Y",
						"SHOW_OLD_PRICE" => "Y",
						"SHOW_CLOSE_POPUP" => "N",
						"MESS_BTN_BUY" => "Купить",
						"MESS_BTN_ADD_TO_BASKET" => "В корзину",
						"MESS_BTN_SUBSCRIBE" => "Подписаться",
						"MESS_BTN_DETAIL" => "Подробнее",
						"MESS_NOT_AVAILABLE" => "Нет в наличии",
						"SECTION_URL" => "",
						"DETAIL_URL" => "",
						"SECTION_ID_VARIABLE" => "SECTION_ID",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_GROUPS" => "N",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"BROWSER_TITLE" => "-",
						"SET_META_KEYWORDS" => "N",
						"META_KEYWORDS" => "-",
						"SET_META_DESCRIPTION" => "N",
						"META_DESCRIPTION" => "-",
						"ADD_SECTIONS_CHAIN" => "N",
						"CACHE_FILTER" => "Y",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRICE_CODE" => [
							 0 => "BASE",
						],
						"USE_PRICE_COUNT" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"CONVERT_CURRENCY" => "N",
						"BASKET_URL" => "/personal/cart/",
						"USE_PRODUCT_QUANTITY" => "Y",
						"ADD_PROPERTIES_TO_BASKET" => "N",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"PRODUCT_PROPERTIES" => [
						],
						"ADD_TO_BASKET_ACTION" => "ADD",
						"DISPLAY_COMPARE" => "N",
						"PAGER_TEMPLATE" => "arrows",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"PAGER_TITLE" => "Товары",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"ADD_PICT_PROP" => "-",
						"LABEL_PROP" => "-",
						"MESS_BTN_COMPARE" => "Сравнить",
						"PRODUCT_QUANTITY_VARIABLE" => "quantity",
						"COMPONENT_TEMPLATE" => "product-list",
						"SEF_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"SET_LAST_MODIFIED" => "N",
						"USE_MAIN_ELEMENT_SECTION" => "N",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"SHOW_404" => "N",
						"SET_STATUS_404" => "N",
						"CUSTOM_FILTER" => "",
						"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
						"BACKGROUND_IMAGE" => "-",
						"COMPATIBLE_MODE" => "Y",
						"DISABLE_INIT_JS_IN_COMPONENT" => "N"
				  ],
				  false
					);
				}
			}
		}
		if (!empty($arResult["IS_LINCED_EMPTY_COL3"])) {
			$PROP_COL = array("LOGIC" => "OR");
			$PROP_PRO = array("LOGIC" => "OR");
			foreach ($arResult["PROP_S_COL"] as $rtr){
				$PROP_COL[] = array(
					"IBLOCK_SECTION_ID"	=> $arResult["AR_LINKS_COL"], 
					"PROPERTY_COLLECTION" => $rtr
				);
			}
			foreach ($arResult["PROP_S_PRO"] as $rtr){
				$PROP_PRO[] = array(
					"IBLOCK_SECTION_ID"	=> $arResult["AR_LINKS_COL"], 
					"PROPERTY_PROVIDER" => $rtr
				);
			}
			$GLOBALS['arrFilterCol3'] = array(
				$PROP_COL, $PROP_PRO
			);
			
			$res = CIBlockSection::GetList([], ["ID"=>$arResult["AR_LINKS_COL"]["I3"], "ACTIVE"=>"N"], false, ["ID", "ACTIVE"]);
			while($ob = $res->GetNext()){
				$subSections[] = $ob["ID"];
			}
			unset($res, $ob);
			
			foreach ($arResult["AR_LINKS_COL"]["I3"] as $ind => $val){
				if(!in_array($val, $subSections)){
					?><div id="VLAD" style="display: none;"><? print_r($arResult["PROP_S_COL"]); ?><? print_r($GLOBALS['arrFilterCol3']); ?></div><?
					$SECNAMES = CIBlockSection::GetByID($val);
					if($SECNAME_res = $SECNAMES->GetNext()){
						$SECNAME_ANS = $SECNAME_res['NAME'];
						$SEC_SECTION = $SECNAME_res['IBLOCK_SECTION_ID'];
						$SEC_COL_URL = $SECNAME_res['SECTION_PAGE_URL'];
					}
					$SECNAMES = CIBlockSection::GetByID($SEC_SECTION);
					if($SECNAME_res = $SECNAMES->GetNext()){
						$SEC_SECTION_NAME = $SECNAME_res['NAME'];
						$SEC_URL = $SECNAME_res['SECTION_PAGE_URL'];
					}
					?><H3><a class="Col_url" href="<? echo $SEC_COL_URL ?>"><? echo $SECNAME_ANS; ?></a></H3><?
					$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						"rbs-promotions",
						[
							"IBLOCK_TYPE" => "catalog",
							"IBLOCK_ID" => "11",
							"SECTION_ID" => $val,
							"SECTION_CODE" => "",
							"SECTION_USER_FIELDS" => [
								 0 => "UF_MORO_PHOTO",
								 1 => "",
							],
							"ELEMENT_SORT_FIELD" => $sort_by,
							"ELEMENT_SORT_ORDER" => $sort_order,
							"ELEMENT_SORT_FIELD2" => "name",
							"ELEMENT_SORT_ORDER2" => "asc",
							"FILTER_NAME" => "arrFilter",
							"INCLUDE_SUBSECTIONS" => "Y",
							"SHOW_ALL_WO_SECTION" => "Y",
							"HIDE_NOT_AVAILABLE" => "Y",
							"PAGE_ELEMENT_COUNT" => (!empty($_REQUEST['el_c'])) ? intval($_REQUEST['el_c']) : 40,
							"LINE_ELEMENT_COUNT" => "4",
							"PROPERTY_CODE" => [
								 0 => "NIGHT_PRICE",
								 1 => "",
							],
							"OFFERS_LIMIT" => "1",
							"TEMPLATE_THEME" => "",
							"PRODUCT_SUBSCRIPTION" => "N",
							"SHOW_DISCOUNT_PERCENT" => "Y",
							"SHOW_OLD_PRICE" => "Y",
							"SHOW_CLOSE_POPUP" => "N",
							"MESS_BTN_BUY" => "Купить",
							"MESS_BTN_ADD_TO_BASKET" => "В корзину",
							"MESS_BTN_SUBSCRIBE" => "Подписаться",
							"MESS_BTN_DETAIL" => "Подробнее",
							"MESS_NOT_AVAILABLE" => "Нет в наличии",
							"SECTION_URL" => "",
							"DETAIL_URL" => "",
							"SECTION_ID_VARIABLE" => "SECTION_ID",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
							"CACHE_GROUPS" => "N",
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"BROWSER_TITLE" => "-",
							"SET_META_KEYWORDS" => "N",
							"META_KEYWORDS" => "-",
							"SET_META_DESCRIPTION" => "N",
							"META_DESCRIPTION" => "-",
							"ADD_SECTIONS_CHAIN" => "N",
							"CACHE_FILTER" => "Y",
							"ACTION_VARIABLE" => "action",
							"PRODUCT_ID_VARIABLE" => "id",
							"PRICE_CODE" => [
								 0 => "BASE",
							],
							"USE_PRICE_COUNT" => "N",
							"SHOW_PRICE_COUNT" => "1",
							"PRICE_VAT_INCLUDE" => "Y",
							"CONVERT_CURRENCY" => "N",
							"BASKET_URL" => "/personal/cart/",
							"USE_PRODUCT_QUANTITY" => "Y",
							"ADD_PROPERTIES_TO_BASKET" => "N",
							"PRODUCT_PROPS_VARIABLE" => "prop",
							"PARTIAL_PRODUCT_PROPERTIES" => "N",
							"PRODUCT_PROPERTIES" => [
							],
							"ADD_TO_BASKET_ACTION" => "ADD",
							"DISPLAY_COMPARE" => "N",
							"PAGER_TEMPLATE" => "arrows",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "Товары",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"ADD_PICT_PROP" => "-",
							"LABEL_PROP" => "-",
							"MESS_BTN_COMPARE" => "Сравнить",
							"PRODUCT_QUANTITY_VARIABLE" => "quantity",
							"COMPONENT_TEMPLATE" => "product-list",
							"SEF_MODE" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",
							"SET_LAST_MODIFIED" => "N",
							"USE_MAIN_ELEMENT_SECTION" => "N",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"SHOW_404" => "N",
							"SET_STATUS_404" => "N",
							"CUSTOM_FILTER" => "",
							"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
							"BACKGROUND_IMAGE" => "-",
							"COMPATIBLE_MODE" => "Y",
							"DISABLE_INIT_JS_IN_COMPONENT" => "N"
					  ],false
					);
				}
			}
		}
	?>
		
	<H3>Отдельные товары</H3>
	<?
$arResult["AR_IBLOCK_ID_EL"] = array_unique($arResult["AR_IBLOCK_ID_EL"]);

		if (!empty($arResult["IS_LINCED_EMPTY_EL"])) {
			$GLOBALS['arrFilterLinked'] = array('ID' => $arResult["AR_LINKS_EL"]);
			foreach ($arResult["AR_IBLOCK_ID_EL"] as $val){
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"rbs-promotions",
					Array(
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => $val,
						"SECTION_ID" => "",
						"SECTION_CODE" => "",
						"SECTION_USER_FIELDS" => array("UF_MORO_PHOTO",""),
						"ELEMENT_SORT_FIELD" => $sort_by,
						"ELEMENT_SORT_ORDER" => $sort_order,
						"ELEMENT_SORT_FIELD2" => "name",
						"ELEMENT_SORT_ORDER2" => "asc",
						"FILTER_NAME" => "arrFilterLinked",
						"INCLUDE_SUBSECTIONS" => "Y",
						"SHOW_ALL_WO_SECTION" => "Y",
						"HIDE_NOT_AVAILABLE" => "N",
						"PAGE_ELEMENT_COUNT" => "10",
						"LINE_ELEMENT_COUNT" => "5",
						"PROPERTY_CODE" => array("",""),
						"OFFERS_LIMIT" => "1",
						"TEMPLATE_THEME" => "",
						"PRODUCT_SUBSCRIPTION" => "N",
						"SHOW_DISCOUNT_PERCENT" => "Y",
						"SHOW_OLD_PRICE" => "Y",
						"SHOW_CLOSE_POPUP" => "N",
						"MESS_BTN_BUY" => "Купить",
						"MESS_BTN_ADD_TO_BASKET" => "В корзину",
						"MESS_BTN_SUBSCRIBE" => "Подписаться",
						"MESS_BTN_DETAIL" => "Подробнее",
						"MESS_NOT_AVAILABLE" => "Нет в наличии",
						"SECTION_URL" => "",
						"DETAIL_URL" => "",
						"SECTION_ID_VARIABLE" => "SECTION_ID",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_GROUPS" => "Y",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"BROWSER_TITLE" => "-",
						"SET_META_KEYWORDS" => "N",
						"META_KEYWORDS" => "-",
						"SET_META_DESCRIPTION" => "N",
						"META_DESCRIPTION" => "-",
						"ADD_SECTIONS_CHAIN" => "N",
						"CACHE_FILTER" => "Y",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRICE_CODE" => array("BASE"),
						"USE_PRICE_COUNT" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"CONVERT_CURRENCY" => "N",
						"BASKET_URL" => "/personal/cart/",
						"USE_PRODUCT_QUANTITY" => "Y",
						"ADD_PROPERTIES_TO_BASKET" => "N",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"PRODUCT_PROPERTIES" => array(""),
						"ADD_TO_BASKET_ACTION" => "ADD",
						"DISPLAY_COMPARE" => "N",
						"PAGER_TEMPLATE" => "arrows",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"PAGER_TITLE" => "Товары",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"ADD_PICT_PROP" => "-",
						"LABEL_PROP" => "-",
						"MESS_BTN_COMPARE" => "Сравнить",
						"PRODUCT_QUANTITY_VARIABLE" => "quantity",
						"COMPONENT_TEMPLATE" => "product-list",
						"SEF_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"SET_LAST_MODIFIED" => "N",
						"USE_MAIN_ELEMENT_SECTION" => "N",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"SHOW_404" => "N",
						"SET_STATUS_404" => "N",
					)
				);
			}
		}
	?>
<?
//global $USER; if($USER->IsAdmin()){echo '<pre>'; print_r($arResult['PROPERTIES']); echo '</pre>';};
?>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>