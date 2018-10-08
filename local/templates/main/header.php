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

	<body class="page">
    <?$APPLICATION->showPanel();?>
		<div class="svg">
			<svg xmlns="http://www.w3.org/2000/svg" style="width:0; height:0; visibility:hidden;">
				<symbol id="icon_2arrow" viewBox="0 0 14.96 17">
					<path id="_2arrow" data-name="2arrow" class="cls-1" d="M1295.79,3348.56l-1.43-1.43,7.07-7.06-7.07-7.07,1.43-1.42,8.5,8.49Zm5.05,0-1.43-1.43,7.07-7.06-7.07-7.07,1.43-1.42,8.5,8.49Z"
					 transform="translate(-1294.38 -3331.56)" />
				</symbol>
				<symbol id="icon_arrow" viewBox="0 0 9 5">
					<path id="arrow" class="cls-1" d="M687.5,157l-4.5-4.282,0.756-.719,3.74,3.562L691.234,152l0.756,0.719Z" transform="translate(-683 -152)"
					/>
				</symbol>
				<symbol id="icon_left_arr" viewBox="0 0 20 15">
					<path class="cls-1" d="M970,4282.5h4l7,7.5h-4Zm7-7.5h4l-7,7.5h-4Zm-3,6h16v3H974v-3Z" transform="translate(-970 -4275)" />
				</symbol>
				<symbol id="icon_map" viewBox="0 0 20 20">
					<path id="map" class="cls-1" d="M386.865,5799.21a0.908,0.908,0,0,0,.406-0.76v-2.72h-1.818v2.24l-3.637,2.42v-11.03a0.929,0.929,0,0,0-.341-0.71l-4.546-3.63a0.946,0.946,0,0,0-.535-0.2,1.045,1.045,0,0,0-.538.15l-5.453,3.64a0.889,0.889,0,0,0-.405.75v12.73a0.9,0.9,0,0,0,.48.8,0.91,0.91,0,0,0,.934-0.04l4.9-3.27,4.028,3.22a0.905,0.905,0,0,0,.961.11Zm-11.413-1.24-3.636,2.42v-10.54l3.636-2.43v10.55ZM390,5786.63a3.637,3.637,0,0,0-7.274,0c0,2.73,3.637,7.28,3.637,7.28S390,5789.36,390,5786.63Zm-5.455,0a1.818,1.818,0,1,1,1.818,1.82A1.814,1.814,0,0,1,384.543,5786.63Z"
					 transform="translate(-370 -5783)" />
				</symbol>
				<symbol id="icon_phone-mobile" viewBox="0 0 18 18">
					<path class="cls-1" d="M1903,37h-4l-2.56,2.561a19.326,19.326,0,0,1-7.03-6.9c0-.02-0.01-0.046-0.01-0.064L1892,30V26a0.945,0.945,0,0,0-1-1h-4a0.945,0.945,0,0,0-1,1v2c0,7.1,8.94,15,15,15h2a0.945,0.945,0,0,0,1-1V38A0.945,0.945,0,0,0,1903,37Z"
					 transform="translate(-1886 -25)" />
				</symbol>
				<symbol id="icon_phone" viewBox="0 0 19 19">
					<path id="phone" class="cls-1" d="M1033,77h2a6.006,6.006,0,0,0-6-6v2A4.008,4.008,0,0,1,1033,77Zm-4-10v2a8.01,8.01,0,0,1,8,8h2A10.014,10.014,0,0,0,1029,67Zm0,8v2h2A2,2,0,0,0,1029,75Zm7,5h-4a1,1,0,0,0-1,1v1a6.909,6.909,0,0,1-7-7h1a1,1,0,0,0,1-1V70a1,1,0,0,0-1-1h-4a1,1,0,0,0-1,1v5a11,11,0,0,0,11,11h5a1,1,0,0,0,1-1V81A1,1,0,0,0,1036,80Z"
					 transform="translate(-1020 -67)" />
				</symbol>
				<symbol id="icon_right_arr" viewBox="0 0 20 15">
					<path id="Shape_2_copy" data-name="Shape 2 copy" class="cls-1" d="M1030,4282.5h-4l-7,7.5h4Zm-7-7.5h-4l7,7.5h4Zm3,6h-16v3h16v-3Z"
					 transform="translate(-1010 -4275)" />
				</symbol>
				<symbol id="icon_sign" viewBox="0 0 24 23.75">
					<path id="sign" class="cls-1" d="M1012,1705a11.871,11.871,0,1,0,12,11.87A11.934,11.934,0,0,0,1012,1705Zm-0.9,18.69-6-4.45,1.8-2.37,3.6,2.67,6.3-8.31,2.4,1.78Z"
					 transform="translate(-1000 -1705)" />
				</symbol>
				<symbol id="icon_star" viewBox="0 0 30.562 29">
					<path id="Shape_21_copy_8" data-name="Shape 21 copy 8" class="cls-1" d="M504.091,460.015a1.229,1.229,0,0,0-1.185.9L499.9,470.1h-9.873a1.254,1.254,0,0,0-1.223,1.267,1.23,1.23,0,0,0,.529,1.008c0.2,0.132,7.974,5.755,7.974,5.755s-2.986,9.077-3.044,9.222a1.331,1.331,0,0,0-.076.428,1.231,1.231,0,0,0,1.235,1.229,1.257,1.257,0,0,0,.707-0.22l7.962-5.737s7.783,5.611,7.961,5.737a1.257,1.257,0,0,0,.707.22A1.236,1.236,0,0,0,514,487.78a1.331,1.331,0,0,0-.077-0.428c-0.057-.145-3.044-9.222-3.044-9.222s7.776-5.623,7.974-5.755a1.253,1.253,0,0,0-.682-2.275h-9.872l-3.019-9.19A1.228,1.228,0,0,0,504.091,460.015Z"
					 transform="translate(-488.813 -460)" />
				</symbol>
				<symbol id="icon_viber" viewBox="0 0 32 32">
					<path id="ico1" class="cls-1" d="M933,59.991a16,16,0,1,0,16.012,16A16,16,0,0,0,933,59.991Zm0.214,8.509a7.126,7.126,0,0,1,6.757,6.891c-0.006.346,0.121,0.857-.406,0.846-0.5-.008-0.372-0.527-0.418-0.872-0.483-3.732-2.237-5.493-6.044-6.063-0.314-.047-0.8.02-0.772-0.386C932.367,68.315,932.939,68.538,933.215,68.5Zm4.57,7.024c-0.574.085-.463-0.43-0.523-0.761-0.385-2.269-1.2-3.1-3.553-3.614-0.346-.074-0.886-0.022-0.795-0.541,0.086-.495.568-0.327,0.934-0.284a4.718,4.718,0,0,1,4.247,4.437C938.06,75.02,938.214,75.461,937.785,75.524Zm-1.845-.546a0.418,0.418,0,0,1-.444-0.431,1.687,1.687,0,0,0-1.567-1.64c-0.289-.045-0.573-0.136-0.439-0.515a0.525,0.525,0,0,1,.575-0.285,2.5,2.5,0,0,1,2.244,2.24A0.491,0.491,0,0,1,935.94,74.979Zm4.075,6.675a3.6,3.6,0,0,1-2.974,2.2,5.457,5.457,0,0,1-.8-0.218,19.837,19.837,0,0,1-11.132-10.892,2.639,2.639,0,0,1,1.846-3.769,1.452,1.452,0,0,1,.967,0,8.156,8.156,0,0,1,2.778,3.69,1.358,1.358,0,0,1-.805,1.205,1.35,1.35,0,0,0-.455,1.922,7.057,7.057,0,0,0,3.748,3.557,1.178,1.178,0,0,0,1.613-.372c0.745-1.1,1.656-1.043,2.652-.361,0.5,0.341,1.008.674,1.482,1.047C939.586,80.171,940.4,80.591,940.015,81.653Z"
					 transform="translate(-917 -60)" />
				</symbol>
				<symbol id="icon_vk" viewBox="0 0 32 32.063">
					<path id="ico" class="cls-1" d="M886,59.942a16.023,16.023,0,1,0,16.01,16.023A16.017,16.017,0,0,0,886,59.942Zm9.478,21.269c-0.113.676-1.278,0.555-2.311,0.588a7.354,7.354,0,0,1-2.31-.2c-0.7-.272-2.532-2.639-3.014-2.549-1.074.2-.685,2.4-1,2.549a7.6,7.6,0,0,1-2.511.1c-3.023-.495-4.775-2.469-6.429-5-2.024-3.09-3.222-5.406-2.714-5.682a11.168,11.168,0,0,1,3.717-.2c0.475,0.013,1.855,3.364,2.211,3.921,1.437,2.245,1.889.585,1.908,0.39,0.391-4.027-.621-3.845-1.205-3.92,0.441-1.306,3.516-1.078,3.516-1.078a6.361,6.361,0,0,1,1.406.491c0.156,0.1.331,0.427,0.3,1.469-0.042,1.57-.205,3.712.5,3.723,0.547,0.009,1.412-1.244,2.11-2.547a13.407,13.407,0,0,1,1.3-2.352,13.241,13.241,0,0,1,2.211-.1,5.646,5.646,0,0,1,2.21.2c0.514,0.424-.379,1.8-1.205,2.939-0.677.938-1.982,2.171-1.909,2.841C892.366,77.736,895.732,79.7,895.48,81.212Z"
					 transform="translate(-870 -59.938)" />
				</symbol>
				<symbol id="icon_write" viewBox="0 0 19 19">
					<path class="cls-1" d="M388.914,6037.63a0.248,0.248,0,0,0,0-.36l-2.182-2.18a0.238,0.238,0,0,0-.36,0l-2.542,2.54,2.542,2.55Zm-12.889,10.04a0.269,0.269,0,0,0,.334.34l3.337-1.14,5.931-5.94-2.541-2.55-5.932,5.95Zm12.718-2.7h-2.487a0.242,0.242,0,0,0-.257.26v5.74H373v-13h5.742a0.242,0.242,0,0,0,.257-0.26v-2.45a0.242,0.242,0,0,0-.257-0.26h-8.486a0.242,0.242,0,0,0-.257.26v18.48a0.242,0.242,0,0,0,.257.26h18.486a0.242,0.242,0,0,0,.257-0.26v-8.51A0.242,0.242,0,0,0,388.743,6044.97Z"
					 transform="translate(-370 -6035)" />
				</symbol>
			</svg>
		</div>
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