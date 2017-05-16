<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$el = new CIBlockElement;

$PROP = array();
$PROP["LAST_NAME"] = $arParams["LAST_NAME"];  
$PROP['FIRST_NAME'] = $arParams["FIRST_NAME"];        
$PROP['FATHER_NAME'] = $arParams["FATHER_NAME"];

$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
  "IBLOCK_ID"      => 5,
  "PROPERTY_VALUES"=> $PROP,
  "NAME"           => $PROP["LAST_NAME"].$PROP['FIRST_NAME'].$PROP['FATHER_NAME'],
  "ACTIVE"         => "Y",            // активен
  "PREVIEW_TEXT"   => "текст для списка элементов",
  "DETAIL_TEXT"    => "текст для детального просмотра",
  "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
  );

/* if($PRODUCT_ID = $el->Add($arLoadProductArray))
  echo "New ID: ".$PRODUCT_ID;
else
  echo "Error: ".$el->LAST_ERROR;
 */


$this->IncludeComponentTemplate();
?>

