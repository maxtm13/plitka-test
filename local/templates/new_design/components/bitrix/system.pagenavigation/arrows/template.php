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

$ClientID = 'navigation_'.$arResult['NavNum'];

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

if($arResult["sUrlPath"] != $_SERVER["REDIRECT_URL"] && !empty($_SERVER["REDIRECT_URL"])){
	$arResult["sUrlPath"] = $_SERVER["REDIRECT_URL"];
	$strNavQueryStringEdt = $strNavQueryString = $strNavQueryStringFull = '';
	$clear - true;
}
if(empty($_SERVER["REDIRECT_URL"]) && $arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $_SERVER["SCRIPT_URL"] == $_SERVER["REDIRECT_URL"] && $arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"]){
	$arResult["sUrlPath"] = $_SERVER["SCRIPT_URL"];
	$strNavQueryStringEdt = $strNavQueryString = $strNavQueryStringFull = '';
	$clear - true;
}

?>
<div class="bx_pagination_bottom">
	<div class="bx_pagination_section_two">
		<div class="bx_pg_section bx_pg_show_col">
			<span class="bx_wsnw">
				<?=$arResult["NavFirstRecordShow"]?> - <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_from")?> <?=$arResult["NavRecordCount"]?>
			</span>
		</div>
	</div>

	<div class="bx_pagination_section_one">
		<div class="bx_pg_section pg_pagination_num">
			<div class="bx_pagination_page">
				<span class="bx_pg_text"><?=GetMessage("pages")?></span>
				<ul>
<?
if($arResult["bDescPageNumbering"] === true)
{
	// to show always first and last pages
//	$arResult["nStartPage"] = $arResult["NavPageCount"];
//	$arResult["nEndPage"] = 1;
	$sPrevHref = '';
	if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
	{
		$bPrevDisabled = false;
		if ($arResult["bSavePage"])
		{
			if (($arResult["NavPageNomer"]+1) == 1) {
				if (empty($strNavQueryString)) {
					$sPrevHref = $arResult["sUrlPath"];
				} else {
					if (substr($strNavQueryString, -5) == '&amp;') {
						$strNavQueryStringEdt = substr($strNavQueryString, 0, -5);
					} else {
						$strNavQueryStringEdt = $strNavQueryString;
					}
					/*
					if($arResult["sUrlPath"] != $_SERVER["REDIRECT_URL"] && !empty($_SERVER["REDIRECT_URL"])){
						$strNavQueryStringEdt = '?';
					}else{
						$strNavQueryStringEdt = '?'.$strNavQueryStringEdt;
					}
					$sPrevHref = $arResult["sUrlPath"].$strNavQueryStringEdt;
					*/
				}
			} else {
				$sPrevHref = $arResult["sUrlPath"].'?'.($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString).'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
			}
		}
		else
		{
			if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1))
			{
				$sPrevHref = $arResult["sUrlPath"].($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString);
			}
			else
			{
				if (($arResult["NavPageNomer"]+1) == 1) {
					if (empty($strNavQueryString)) {
						$sPrevHref = $arResult["sUrlPath"];
					} else {
						if (substr($strNavQueryString, -5) == '&amp;') {
							$strNavQueryStringEdt = substr($strNavQueryString, 0, -5);
						} else {
							$strNavQueryStringEdt = $strNavQueryString;
						}
						$sPrevHref = $arResult["sUrlPath"].'?'.($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString);
					}
				} else {
					$sPrevHref = $arResult["sUrlPath"].'?'.($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString).'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
				}
			}
		}
	}
	else
	{
		$bPrevDisabled = true;
	}
	
	$sNextHref = '';
	if ($arResult["NavPageNomer"] > 1)
	{
		$bNextDisabled = false;
		$sNextHref = $arResult["sUrlPath"].'?'.($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString).'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1);
	}
	else
	{
		$bNextDisabled = true;
	}
	?>
	<?if (!$bPrevDisabled):?>
					<? echo $sPrevHref; ?>
				<li><a href="<?=$sPrevHref;?>" id="<?=$ClientID?>_previous_page">&larr;</a></li>
	<?endif?>

	<?
	$bFirst = true;
	$bPoints = false;
	do
	{
		$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
		
		if(empty($_SERVER["REDIRECT_URL"]) && $arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $_SERVER["SCRIPT_URL"] == $_SERVER["REDIRECT_URL"] && $arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"]){
			$arResult["sUrlPath"] = $_SERVER["SCRIPT_URL"];
			$strNavQueryStringEdt = $strNavQueryString = $strNavQueryStringFull = '';
			$clear - true;
		}
		if ($arResult["nStartPage"] <= 2 || $arResult["NavPageCount"]-$arResult["nStartPage"] <= 1 || abs($arResult['nStartPage']-$arResult["NavPageNomer"])<=2)
		{
			if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
<? echo "<!--<pre>";
print_r("1");
echo "</pre>-->";
?>
				<li class="bx_active"><span class="nav-current-page"><?=$NavRecordGroupPrint?></span></li>
			<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false): ?>
<? echo "<!--<pre>";
print_r("2");
echo "</pre>-->";
?>
					<li><a href="<?=$arResult["sUrlPath"]?>"><?=$NavRecordGroupPrint?></a></li>
			<?else: ?>
<? echo "<!--<pre>";
print_r("3");
echo "</pre>-->";
?>
				<li>
					<?php if ($NavRecordGroupPrint == 1) {
						if (empty($strNavQueryString)) { ?>
							<a href="<?=$arResult["sUrlPath"]?>"><?=$NavRecordGroupPrint?></a>
						<?php } else {
							if (substr($strNavQueryString, -5) == '&amp;') {
								$strNavQueryStringEdt = substr($strNavQueryString, 0, -5);
							} else {
								$strNavQueryStringEdt = $strNavQueryString;
							} ?>
							<a href="<?=$arResult["sUrlPath"]?>?<?=($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString)?>"><?=$NavRecordGroupPrint?></a>
						<?php }
					} else { ?>
						<a href="<?=$arResult["sUrlPath"]?>?<?=($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString)?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
					<?php } ?>
				</li>
			<?endif;
			$bFirst = false;
			$bPoints = true;
		}
		else
		{
			if ($bPoints)
			{
		?><li>...</li><?
				$bPoints = false;
			}
		}
		$arResult["nStartPage"]--;
	} while($arResult["nStartPage"] >= $arResult["nEndPage"]);?>
	<?if (!$bNextDisabled):?>
				<li><a href="<?=$sNextHref;?>" id="<?=$ClientID?>_next_page">&rarr;</a></li>
	<?endif;
}
else
{
	// to show always first and last pages
	$arResult["nStartPage"] = 1;
	$arResult["nEndPage"] = $arResult["NavPageCount"];

	$sPrevHref = '';
	if ($arResult["NavPageNomer"] > 1)
	{
		$bPrevDisabled = false;
		if ($arResult["bSavePage"] || $arResult["NavPageNomer"] > 2)
		{
			if (($arResult["NavPageNomer"]-1) == 1) {
				if (empty($strNavQueryString)) {
					$sPrevHref = $arResult["sUrlPath"];
				} else {
					if (substr($strNavQueryString, -5) == '&amp;') {
						$strNavQueryStringEdt = substr($strNavQueryString, 0, -5);
					} else {
						$strNavQueryStringEdt = $strNavQueryString;
					}
					$sPrevHref = $arResult["sUrlPath"].'?'.($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString);
				}
			} else {
				$sPrevHref = $arResult["sUrlPath"].'?'.($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString).'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1);
			}
		}
		else
		{
			$sPrevHref = $arResult["sUrlPath"].($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString);
		}
	}
	else
	{
		$bPrevDisabled = true;
	}

	$sNextHref = '';
	if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
	{
		$bNextDisabled = false;
		$sNextHref = $arResult["sUrlPath"].'?'.($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"]) ?  "" : $strNavQueryString).'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
	}
	else
	{
		$bNextDisabled = true;
	}
	if(empty($_SERVER["REDIRECT_URL"]) && $arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $_SERVER["SCRIPT_URL"] == $_SERVER["REDIRECT_URL"] && $arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"]){
		$arResult["sUrlPath"] = $_SERVER["SCRIPT_URL"];
		$strNavQueryStringEdt = $strNavQueryString = $strNavQueryStringFull = '';
		$clear - true;
	}
	?>
	<?if (!$bPrevDisabled):			
	?>
<? echo "<!--<pre>";
print_r("5");
echo "</pre>-->";
?>
				<li><a href="<?=$sPrevHref;?>" id="<?=$ClientID?>_previous_page">&larr;</a></li>
	<?endif?>
	<?
	$bFirst = true;
	$bPoints = false;
	do
	{
		if ($arResult["nStartPage"] <= 2 || $arResult["nEndPage"]-$arResult["nStartPage"] <= 1 || abs($arResult['nStartPage']-$arResult["NavPageNomer"])<=2)
		{
			if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
					<? echo "<!--<pre>";
print_r("6");
echo "</pre>-->";
?>
				<li class="bx_active"><span class="nav-current-page"><?=$arResult["nStartPage"]?></span></li>
			<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
				<li><a href="<?=($arResult["nStartPage"] == 1 && empty($_SERVER['REDIRECT_URL']) && $_SERVER['SCRIPT_URL'] != $arResult["sUrlPathParams"] ? substr($arResult["sUrlPathParams"],0,-1) : (substr($arResult["sUrlPath"], -1) == "&" || substr($arResult["sUrlPath"], -1) == "?" ? substr($arResult["sUrlPath"],0,-1) : $arResult["sUrlPath"]));?>"><?=$arResult["nStartPage"]?></a></li>
			<?else:?>
					<? echo "<!--<pre>";
print_r("8");
echo "</pre>-->";
?>
				<li>
					<?php if ($arResult["nStartPage"] == 1) {
						if (empty($strNavQueryString)) { ?>
							<a href="<?=$arResult["sUrlPathParams"]?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
						<?php } else {
							if (substr($strNavQueryString, -5) == '&amp;') {
								$strNavQueryStringEdt = substr($strNavQueryString, 0, -5);
							} else {
								$strNavQueryStringEdt = $strNavQueryString;
							} ?>
							<a href="<?=$arResult["sUrlPath"]?>?<?=($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"])) ?  "" : $strNavQueryString;?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
						<?php }
					} else {
					?>
						<a href="<?=$arResult["sUrlPath"]?>?<?=($arResult["sUrlPath"] != $_SERVER["SCRIPT_URL"] || $arResult["sUrlPath"] == $_SERVER["SCRIPT_URL"] && $arResult["sUrlPath"] == $_SERVER["REQUEST_URI"] && empty($_SERVER["REDIRECT_URL"])) ?  "" : $strNavQueryString;?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
					<?php } ?>
				</li>
			<?endif;
			$bFirst = false;
			$bPoints = true;
		}
		else
		{
			if ($bPoints)
			{
		?><li>...</li><?
				$bPoints = false;
			}
		}
		$arResult["nStartPage"]++;
	} while($arResult["nStartPage"] <= $arResult["nEndPage"]);
	?>
	<?if (!$bNextDisabled):?>
				<li><a href="<?=$sNextHref;?>" id="<?=$ClientID?>_next_page">&rarr;</a></li>
	<?endif;
}
?>
				<?if ($arResult["bShowAll"]):
					if ($arResult["NavShowAll"]):?>
						<li><a class="nav-page-pagen" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0"><?=GetMessage("nav_paged")?></a></li>
					<?else:?>
						<li><a class="nav-page-all" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_all")?></a></li>
					<?endif;
				endif;?>
				</ul>
			</div>
		</div>
	</div>
</div>  <!--//bx_pagination_bottom-->

<?CJSCore::Init();?>
<script type="text/javascript">
	BX.bind(document, "keydown", function (event) {

		event = event || window.event;
		if (!event.ctrlKey)
			return;

		var target = event.target || event.srcElement;
		if (target && target.nodeName && (target.nodeName.toUpperCase() == "INPUT" || target.nodeName.toUpperCase() == "TEXTAREA"))
			return;

		var key = (event.keyCode ? event.keyCode : (event.which ? event.which : null));
		if (!key)
			return;

		var link = null;
		if (key == 39)
			link = BX('<?=$ClientID?>_next_page');
		else if (key == 37)
			link = BX('<?=$ClientID?>_previous_page');

		if (link && link.href)
			document.location = link.href;
	});
</script>