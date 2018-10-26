<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Универсальный",
	"DESCRIPTION" => "Универсальный",
	"ICON" => "/images/news_list.gif",
	"SORT" => 20,
//	"SCREENSHOT" => array(
//		"/images/post-77-1108567822.jpg",
//		"/images/post-1169930140.jpg",
//	),
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "conent",
		"CHILD" => array(
			"ID" => "unics",
			"NAME" => "Универсальные",
			"SORT" => 10,
		),
	),
);

?>