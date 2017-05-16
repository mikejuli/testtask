<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult['FIO'] = CIBlockElement::SetPropertyValueCode($arParams['ItemID'], "FIRST_NAME", $arParams["FIRST_NAME"]);
$arResult['FIO'] = CIBlockElement::SetPropertyValueCode($arParams['ItemID'], "LAST_NAME", $arParams["LAST_NAME"]);
$arResult['FIO'] = CIBlockElement::SetPropertyValueCode($arParams['ItemID'], "FATHER_NAME", $arParams["FATHER_NAME"]);

$this->IncludeComponentTemplate();
?>

