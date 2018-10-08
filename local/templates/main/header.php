<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
$dir = $APPLICATION->GetCurDir();
$page = $APPLICATION->GetCurPage();
$assets = \Bitrix\Main\Page\Asset::getInstance();

?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
	<head>
        <?
        $APPLICATION->ShowHead();
        //strings
        $assets->addString('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">');
        $assets->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
        //CSS
        $assets->addCss('https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;amp;subset=cyrillic');
        $assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/css/swiper.min.css');
        $assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css');
        $assets->addCss('/local/assets/styles/fonts.css');
		$assets->addCss('/local/assets/styles/app.min.css');
		//SCRIPTS
		$assets->addJS('https://api-maps.yandex.ru/2.1/?lang=ru_RU');
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js');
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js');
		$assets->addJS('/local/assets/scripts/jquery.counterup.js');
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.min.js');
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js');
		$assets->addJS('/local/assets/scripts/main.js');
        ?>
        <link href="/local/assets/images/favicon.ico" rel="icon" type="image/ico">
		<script src='https://www.google.com/recaptcha/api.js' async></script>
		<title><?=$APPLICATION->ShowTitle();?></title>
	</head>

	<body>
    <?$APPLICATION->showPanel();?>
		<header class="header">
			<div class="container">
				<div class="header__top">
					<button class="header__button_menu">Меню</button>
					<a href="<?=SITE_DIR?>" class="logo">
					<?$APPLICATION->IncludeFile("/local/inc_files/logo.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"логотип"));?>
					</a>
					<strong class="header__slogan"><?$APPLICATION->IncludeFile("/local/inc_files/header_slogan.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"слоган"));?></strong>
					<div class="header__write">
						<p>Пишите</p>
						<div class="social">
							<div class="social__icons">
								<?$APPLICATION->IncludeFile("/local/inc_files/vk_link.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"ссылку на группу в ВК"));?>
								<?$APPLICATION->IncludeFile("/local/inc_files/viber_number.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"номер в вайбере"));?>
							</div>
						</div>
					</div>
					<div class="header__call">
						<p>Звоните</p>
						<div class="phone header__phone">
							<span class="phone__icon">
								<svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_phone"></use></svg>
							</span>
							<?$APPLICATION->IncludeFile("/local/inc_files/header_phone.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"Телефон"));?>
						</div>
					</div>
					<a href="#modal_callback" class="button header__button_callback modal_callback-link">Заказать звонок</a>
					<a href="tel:<?$APPLICATION->ShowProperty("mobileNumber")?>" class="header__button_phone">
						<svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_phone-mobile"></use></svg>
					</a>
				</div>
			</div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"top",
				Array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "left",
					"DELAY" => "N",
					"MAX_LEVEL" => "2",
					"MENU_CACHE_GET_VARS" => array(""),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "top",
					"USE_EXT" => "Y"
				)
			);?>
		</header>
		<main class="<?=($page == '/') ? 'main' : 'main_inner';?>">
		<?if ($page != '/')
		{?>
			<div class="container">
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "chococrumb", Array("PATH" => "", "SITE_ID" => "s1", "START_FROM" => "0"));
			if (preg_match('/catalog/', $dir))
			{?>
				<h1 class="page-heading"><?$APPLICATION->ShowViewContent('catalogHeader').'</h1>';			
			}
			else
			{?>
				<h1 class="page-heading"><?$APPLICATION->ShowTitle(false);?></h1><?
			}?>
			</div><?
		}?>