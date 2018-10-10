<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="menu">
<?$previousLevel = 0;
if(empty($arResult))
	print "Меню не заполнено или выбран неверный тип меню";
foreach($arResult as $arItem)
{
	if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel)
	{
		echo ("
			</div>
		</li>
		");
	}
	if ($arItem["IS_PARENT"])
	{?>
		<li class="menu__item menu__item_dropdown">
			<a href="javascript.void(0);" class="menu__link menu__link_dropdown"><?=$arItem["TEXT"]?>
				<svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_arrowDown"></use></svg>
			</a>
			<div class="menuDropdown"><?
	}
	else
	{
		if ($arItem["DEPTH_LEVEL"] == 1)
		{?>
			<li class="menu__item">
				<a href="<?=$arItem["LINK"]?>" class="menu__link"><?=$arItem["TEXT"]?></a>
			</li><?
		}
		else
		{?>
			<a href="<?=$arItem["LINK"]?>" class="menuDropdown__link"><?=$arItem["TEXT"]?></a><?
		}
	}
	$previousLevel = $arItem["DEPTH_LEVEL"];
}
if ($previousLevel > 1)
{
	echo ("
		</div>
	</li>
	");
}?>
</ul>