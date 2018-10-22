<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
if(empty($arResult))
	return "";
$strReturn = '';
$strReturn .= '<ul class="breadcrumbs" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';
$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="'.$arResult[$index]["LINK"].'" class="breadcrumbs__link" title="'.$title.'" itemprop="url"><span itemprop="name">'.$title.'</span></a>
				<meta itemprop="position" content="'.($index + 1).'" />
			</li>';			
	}
	else
	{
		$strReturn .= '
			<li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<span itemprop="name">'.$title.'</span>
				<meta itemprop="position" content="'.($index + 1).'" />
			</li>';
	}
}
$strReturn .= '</ul>';
return $strReturn;