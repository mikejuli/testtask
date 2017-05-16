<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//echo $arParams['NEWS_COUNT'];?>
<?$GLOBALS['NAV_RESULT'] = $arResult['NAV_RESULT'];?> 
<?var_dump($arParams);?>
<div class="news-list">

<?var_dump($arResult);?>
<?
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "CODE","PROPERTY_FIRST_NAME","PROPERTY_LAST_NAME","PROPERTY_FATHER_NAME");
$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement())
{

 $arFields = $ob->GetFields();
 echo $arFields['PROPERTY_FIRST_NAME_VALUE']."    ".$arFields['PROPERTY_LAST_NAME_VALUE']."   ".$arFields['PROPERTY_FATHER_NAME_VALUE'];
 echo "<br>";
}
$fullAr = $res->arResult;
?>
	<?//var_dump($fullAr);?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br>
<?endif;?>



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>


  <script>



function newElement(NavRecordCount,NavPageCount,NavPageNomer,NavPageSize,bShowAll,NavShowAll,NavNum,bDescPageNumbering,add_anchor,nPageWindow){
document.getElementById('new_user').innerHTML= "<input type = 'text' id = 'first_name' value = 'firstss_name'></input><input type = 'text' id = 'last_name' value = 'last_name'></input><input type = 'text' id = 'father_name' value = 'father_name'></input><button id = 'getFromInput'>Сохранить</button>";

	//inputs 
      var first = document.getElementById("first_name");
      var last = document.getElementById("last_name");
      var father = document.getElementById("father_name");
      //button
      getFromInput.onclick = function() {   
      	
      	document.getElementById('new_user').innerHTML= '<INPUT TYPE="button" VALUE="Новый элемент" onClick="newElement();">';

var BaseConfig = $.ajax({
                       async:true,
                       url:"bitrix/templates/.default/components/bitrix/news/ListComponents/bitrix/news.list/.default/compa1.php",
                       type:'post',
                       data:{'FIRST_NAME': first.value,
                       		'LAST_NAME': last.value,
                       		'FATHER_NAME': father.value,
                       		
                   },
                       dataType:"TEXT",
					   success: function (data)   {		
					   BaseConfig = data.responseText;				
                       $('#temp').html(data);
					   
                    }
                       })
          //проверяем какой номер у елемента и ставим его в конец списка  ..... ??????

    alert("Новый элемент:    "+ first.value  +"   "+  last.value+"   "+father.value +"   добавлен");   

var BaseConfig5 = $.ajax({
                       async:true,
                       url:"bitrix/templates/.default/components/bitrix/news/ListComponents/bitrix/news.list/.default/compa2.php",
                       type:'post',
    data:{'NavRecordCount':NavRecordCount,
'NavPageCount':NavPageCount,
'NavPageNomer':NavPageNomer,
'NavPageSize':NavPageSize,
'bShowAll':bShowAll,
'NavShowAll':NavShowAll,
'NavNum':NavNum,
'bDescPageNumbering':bDescPageNumbering,
'add_anchor':add_anchor,
'nPageWindow':nPageWindow
                   },
                       dataType:"TEXT",
             success: function (data)   {   
             BaseConfig5 = data.responseText;        
                       $('#new').html(data);
             
                    }
                       })
      }


}











 function secondChange(ItemID, countDiv, countButton, first_name, last_name, father_name )
{


document.getElementById(countButton).innerHTML= "<button id = 'getFromInput'>Сохранить</button>";

document.getElementById(countDiv).innerHTML="<input type = 'text' id = 'first_name' value = "+first_name+"></input><input type = 'text' id = 'last_name' value = "+last_name+"></input><input type = 'text' id = 'father_name' value = "+father_name+"></input>";

      //inputs 
      var first = document.getElementById("first_name");
      var last = document.getElementById("last_name");
      var father = document.getElementById("father_name");
      //button
      getFromInput.onclick = function() { 

           document.getElementById(countDiv).innerHTML= first.value +" "+ last.value +" "+ father.value;
          document.getElementById(countButton).innerHTML= '<INPUT TYPE="button" VALUE="Изменить" onClick="secondChange();">';
		  


		var BaseConfig = $.ajax({
                       async:true,
                       url:"bitrix/templates/.default/components/bitrix/news/ListComponents/bitrix/news.list/.default/compa.php",
                       type:'post',
                       data:{'FIRST_NAME': first.value,
                       		'LAST_NAME': last.value,
                       		'FATHER_NAME': father.value,
                       		'ItemID': ItemID
                   },
                       dataType:"TEXT",
					   success: function (data)   {		
					   BaseConfig = data.responseText;				
                       $('#temp').html(data);
					   
                    }
                       })



/*
$APPLICATION->IncludeComponent(
'dv:date.current',
'.default',
Array(
'NAME' => '0000000',
),
false
);*/

			
          
      }
  }


 </script>




<?//var_dump($arResult);?>
<div id = 'temp'>
</div>

<?$countDiv = 0;?>

<?foreach($fullAr as $arItem):?>
	<?$countDiv++; 
	$DivNameCount = "nameDiv".$countDiv;
	$DivNameButton = "buttonDiv".$countDiv;?>
	
<?$ItemId = $arItem['ID'];?>
	<?$first_name = $arItem["PROPERTY_FIRST_NAME_VALUE"];?>
	<?$last_name = $arItem["PROPERTY_LAST_NAME_VALUE"];?>
	<?$father_name = $arItem["PROPERTY_FATHER_NAME_VALUE"];?>
	<?   //две строчки ниже изменение удаление компонента
	//$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	//$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	?>
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		

		<div id="<?=$DivNameCount;?>">
			<?echo $first_name?>
			<?echo $last_name?>
			<?echo $father_name?>
		
		</div>

		<div id="<?=$DivNameButton;?>">
    		<INPUT TYPE="button" VALUE="Изменить"
        onClick="secondChange(<?=$ItemId;?>,<?echo "'".$DivNameCount."'"?>,<?echo "'".$DivNameButton."'"?>,<?echo "'".$first_name."'"?>, <?echo "'".$last_name."'"?> ,<?echo "'".$father_name."'"?>    );">
		</div>

		

		<?if($arParams["USE_RATING"]=="Y"):
			$parent = $component->GetParent();
		?>		
		<?endif?>


	</p>
<?endforeach;?>


<?$NavRecordCount = $arResult['NAV_RESULT']->NavRecordCount;?>
<?$NavPageCount = $arResult['NAV_RESULT']->NavPageCount;?>
<?$NavPageNomer = $arResult['NAV_RESULT']->NavPageNomer;?>
<?$NavPageSize = $arResult['NAV_RESULT']->NavPageSize;?>
<?$bShowAll = $arResult['NAV_RESULT']->bShowAll;?>
<?$NavShowAll  = $arResult['NAV_RESULT']->NavShowAll;?>
<?$NavNum = $arResult['NAV_RESULT']->NavNum;?>
<?$bDescPageNumbering = $arResult['NAV_RESULT']->bDescPageNumbering;?>
<?$add_anchor = $arResult['NAV_RESULT']->add_anchor;?>
<?$nPageWindow = $arResult['NAV_RESULT']->nPageWindow;?>

<?
if(!$NavRecordCount){$NavRecordCount = 999; }
if(!$NavPageCount){$NavPageCount = 999; }
if(!$NavPageNomer){$NavPageNomer = 999; }
if(!$NavPageSize){$NavPageSize = 999; }
if(!$bShowAll){$bShowAll = 999; }
if(!$NavShowAll){$NavShowAll = 999; }
if(!$NavNum){$NavNum = 999; }
if(!$bDescPageNumbering){$bDescPageNumbering = 999; }
if(!$add_anchor){$add_anchor = 999; }
if(!$nPageWindow){$nPageWindow = 999; }


?>



<div id = "new_user">
<INPUT TYPE="button" VALUE="Новый элемент"
        onClick="newElement(<?=$NavRecordCount;?>,<?=$NavPageCount;?>,<?=$NavPageNomer;?>,<?=$NavPageSize;?>,<?=$bShowAll;?>,<?=$NavShowAll;?>,<?=$NavNum;?>,<?=$bDescPageNumbering;?>,<?=$add_anchor;?>,<?=$nPageWindow;?>); "></div>


<div id = "new">
<?$APPLICATION->IncludeComponent(
  "dv:system.pagenavigation",
  "orange",
  Array(  
  ),
  $component
)
?>
<br>

</div>



<?//echo $arResult["NAV_STRING"]?>
<?//if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?//=$arResult["NAV_STRING"]?>
<?//endif;?>


</div>
</div>
