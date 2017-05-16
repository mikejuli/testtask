<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @var array $arParams
 */

 global  $NAV_RESULT;

  if(!$NAV_RESULT){ 
 if($arParams['NavRecordCount'] == 999){$arParams['NavRecordCount'] = NULL; }
 if($arParams['NavPageCount'] == 999){$arParams['NavPageCount'] = NULL; }
 if($arParams['NavPageNomer'] == 999){$arParams['NavPageNomer'] = NULL; }
 if($arParams['NavPageSize'] == 999){$arParams['NavPageSize'] = NULL; }
 if($arParams['bShowAll'] == 999){$arParams['bShowAll'] = NULL; }
if($arParams['NavShowAll'] == 999){$arParams['NavShowAll'] = NULL; }
if($arParams['NavNum'] == 999){$arParams['NavNum'] = NULL; }
if($arParams['bDescPageNumbering'] == 999){$arParams['bDescPageNumbering'] = NULL; }
if($arParams['add_anchor'] == 999){$arParams['add_anchor'] = NULL; }
if($arParams['nPageWindow'] == 999){$arParams['nPageWindow'] = NULL; }
		 
 
 
 $NAV_RESULT->NavRecordCount = $arParams['NavRecordCount'];
$NAV_RESULT->NavPageCount = $arParams['NavPageCount'];
$NAV_RESULT->NavPageNomer = $arParams['NavPageNomer'];
$NAV_RESULT->NavPageSize = $arParams['NavPageSize'];
$NAV_RESULT->bShowAll = $arParams['bShowAll'];
$NAV_RESULT->NavShowAll = $arParams['NavShowAll'];
$NAV_RESULT->NavNum = $arParams['NavNum'];
$NAV_RESULT->bDescPageNumbering = $arParams['bDescPageNumbering'];
$NAV_RESULT->add_anchor = $arParams['add_anchor'];
$NAV_RESULT->nPageWindow = $arParams['nPageWindow'];
  
 } 

//echo $NAV_RESULT->NavRecordCount;
 
	$dbresult =& $NAV_RESULT;

	//var_dump($NAV_RESULT);
	
	if(intval($dbresult->NavPageSize) <= 0)
		$dbresult->NavPageSize = 10;

	$arResult = Array();
	$arResult["NavShowAlways"] = $arParams["SHOW_ALWAYS"];
	$arResult["NavTitle"] = "ФИО";
	$arResult["NavRecordCount"] = $dbresult->NavRecordCount;
	$arResult["NavPageCount"] = $dbresult->NavPageCount;
	$arResult["NavPageNomer"] = $dbresult->NavPageNomer;
	$arResult["NavPageSize"] = $dbresult->NavPageSize;
	$arResult["bShowAll"] = $dbresult->bShowAll;
	$arResult["NavShowAll"] = $dbresult->NavShowAll;
	$arResult["NavNum"] = $dbresult->NavNum;
	$arResult["bDescPageNumbering"] = $dbresult->bDescPageNumbering;
	$arResult["add_anchor"] = $dbresult->add_anchor;
	$arResult["nPageWindow"] = $nPageWindow = $dbresult->nPageWindow;
	$arResult["bSavePage"] = (CPageOption::GetOptionString("main", "nav_page_in_session", "Y")=="Y");
	if($arParams["BASE_LINK"] <> '')
	{
		if(($pos = strpos($arParams["BASE_LINK"], "?")) !== false)
		{
			$arResult["sUrlPath"] = substr($arParams["BASE_LINK"], 0, $pos);
			$arResult["NavQueryString"] = substr($arParams["BASE_LINK"], $pos+1);
		}
		else
		{
			$arResult["sUrlPath"] = $arParams["BASE_LINK"];
			$arResult["NavQueryString"] = "";
		}
	}
	else
	{
		$arResult["sUrlPath"] = GetPagePath(false, false);
		$arResult["NavQueryString"] = htmlspecialcharsbx(DeleteParam(array(
			"PAGEN_".$dbresult->NavNum,
			"SIZEN_".$dbresult->NavNum,
			"SHOWALL_".$dbresult->NavNum,
			"PHPSESSID",
			"clear_cache",
			"bitrix_include_areas"
		)));
	}
	$arResult['sUrlPathParams'] = $arResult['sUrlPath'].'?'.($arResult['NavQueryString'] <> ''? $arResult['NavQueryString'].'&' : '');

	if ($dbresult->bDescPageNumbering === true)
	{
		if ($dbresult->NavPageNomer + floor($nPageWindow/2) >= $dbresult->NavPageCount)
			$nStartPage = $dbresult->NavPageCount;
		else
		{
			if ($dbresult->NavPageNomer + floor($nPageWindow/2) >= $nPageWindow)
				$nStartPage = $dbresult->NavPageNomer + floor($nPageWindow/2);
			else
			{
				if($dbresult->NavPageCount >= $nPageWindow)
					$nStartPage = $nPageWindow;
				else
					$nStartPage = $dbresult->NavPageCount;
			}
		}

		if ($nStartPage - $nPageWindow >= 0)
			$nEndPage = $nStartPage - $nPageWindow + 1;
		else
			$nEndPage = 1;
	}
	else
	{
		if ($dbresult->NavPageNomer > floor($nPageWindow/2) + 1 && $dbresult->NavPageCount > $nPageWindow)
			$nStartPage = $dbresult->NavPageNomer - floor($nPageWindow/2);
		else
			$nStartPage = 1;

		if ($dbresult->NavPageNomer <= $dbresult->NavPageCount - floor($nPageWindow/2) && $nStartPage + $nPageWindow-1 <= $dbresult->NavPageCount)
			$nEndPage = $nStartPage + $nPageWindow - 1;
		else
		{
			$nEndPage = $dbresult->NavPageCount;
			if($nEndPage - $nPageWindow + 1 >= 1)
				$nStartPage = $nEndPage - $nPageWindow + 1;
		}
	}

	$arResult["nStartPage"] = $dbresult->nStartPage = $nStartPage;
	$arResult["nEndPage"] = $dbresult->nEndPage = $nEndPage;

	if ($dbresult->bDescPageNumbering === true)
	{
		$makeweight = ($dbresult->NavRecordCount % $dbresult->NavPageSize);
		$NavFirstRecordShow = 0;
		if($dbresult->NavPageNomer != $dbresult->NavPageCount)
			$NavFirstRecordShow += $makeweight;

		$NavFirstRecordShow += ($dbresult->NavPageCount - $dbresult->NavPageNomer) * $dbresult->NavPageSize + 1;

		if ($dbresult->NavPageCount == 1)
			$NavLastRecordShow = $dbresult->NavRecordCount;
		else
			$NavLastRecordShow = $makeweight + ($dbresult->NavPageCount - $dbresult->NavPageNomer + 1) * $dbresult->NavPageSize;

	}
	else
	{
		$NavFirstRecordShow = ($dbresult->NavPageNomer-1)*$dbresult->NavPageSize+1;

		if ($dbresult->NavPageNomer != $dbresult->NavPageCount)
			$NavLastRecordShow = $dbresult->NavPageNomer * $dbresult->NavPageSize;
		else
			$NavLastRecordShow = $dbresult->NavRecordCount;
	}

	$arResult["NavFirstRecordShow"] = $NavFirstRecordShow;
	$arResult["NavLastRecordShow"] = $NavLastRecordShow;

	$this->IncludeComponentTemplate();

	return $this;

