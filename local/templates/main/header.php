<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
use Bitrix\Main\Application;
$application = Application::getInstance();
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
		$assets->addString('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
		<meta name="imagetoolbar" content="no">
		<meta name="msthemecompatible" content="no">
		<meta name="cleartype" content="on">
		<meta name="HandheldFriendly" content="True">');
        $assets->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
        //CSS
        $assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css');
		$assets->addCss('/local/assets/styles/app.min.css');
		//SCRIPTS
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenMax.min.js');
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js');
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.min.js');
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js');
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
		$assets->addJS('https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js');
		$assets->addJS('/local/assets/scripts/main.js');
        ?>
        <link href="/local/assets/images/favicon.ico" rel="icon" type="image/ico">
		<script src='https://www.google.com/recaptcha/api.js' async></script>
		<title><?=$APPLICATION->ShowTitle();?></title>
	</head>
	<body class="page">
	<?$APPLICATION->showPanel();?>
		<div class="svg"><?include_once($application->getDocumentRoot() . "/local/assets/inc_files/svgHeader.html")?></div>
		<div id="callbackPopup" class="popup mfp-hide white-popup">
			<form class="popup__form">
				<div class="popup__block popup__block_textCenter">
					<h3 class="heading heading_thirdLevel heading_uppercase">Закажите звонок</h3>
				</div>
				<div class="popup__block">
					<input type="text" class="input jsFloating jsValidate" />
					<label class="floatPlaceholder">Как вас зовут?</label>
				</div>
				<div class="popup__block popup__block_strongPull">
					<input type="tel" class="input jsFloating jsValidate" />
					<label class="floatPlaceholder">Номер телефона</label>
				</div>
				<div class="popup__block popup__block_strongPull popup__block_textCenter">
					<button class="button button_fill button_wide popup__submit">Отправить</button>
				</div>
				<div class="popup__block popup__block_textCenter">
					<div class="notice discussForm__privacy popup__notice">Заполняя настоящую форму вы даете свое согласие на обработку своих
						<A href="#">персональных данных</A>
					</div>
				</div>
			</form>
		</div>
		<header class="header">
			<div class="header__wrapper">
				<div class="js_mobileMenu">
					<ul class="menu">
						<li class="menu__item menu__item_dropdown">
							<a href="#1" class="menu__link menu__link_dropdown">О компании
								<svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_arrowDown"></use></svg>
							</a>
							<div class="menuDropdown">
								<a href="about.html" class="menuDropdown__link">Подробно о нас</a>
								<a href="team.html" class="menuDropdown__link">Наша команда</a>
								<a href="clients.html" class="menuDropdown__link">Клиенты и благодарности</a>
								<a href="vacancies.html" class="menuDropdown__link">Вакансии</a>
							</div>
						</li>
						<li class="menu__item menu__item_dropdown">
							<a href="#" class="menu__link menu__link_dropdown">Услуги
								<svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_arrowDown"></use></svg>
							</a>
							<div class="menuDropdown">
								<a href="service-dev.html" class="menuDropdown__link">Услуги Разработки</a>
								<a href="service-seo.html" class="menuDropdown__link">Услуги SEO</a>
								<a href="service-context.html" class="menuDropdown__link">Услуги Контекстной рекламы</a>
								<a href="service-social.html" class="menuDropdown__link">Услуги Соцсети</a>
							</div>
						</li>
						<li class="menu__item">
							<a href="portfolio.html" class="menu__link">Портфолио</a>
						</li>
						<li class="menu__item">
							<a href="blog.html" class="menu__link">Блог</a>
						</li>
						<li class="menu__item">
							<a href="contacts.html" class="menu__link">Контакты</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="container">
				<div class="row middle-xs">
					<div class="col-xs-4 col-sm-2 col-lg-1 first-lg header__moveLeft">
						<a href="./" class="logo">
							<img src="assets/images/logo.png" alt="Логотип A1" width="50" height="70" class="logo__image" title="" />
						</a>
					</div>
					<div class="col-xs-8 col-sm-10 col-lg-5 third-lg header__moveRight">
						<div class="header__inner">
							<p class="header__phone">+7 (3462) 269-57-58</p>
							<a href="#callbackPopup" class="header__callback jsPopupLink">Заказать звонок</a>
							<button type="button" aria-label="Меню" class="header__button">
								<span aria-hidden="true"></span>
								<span aria-hidden="true"></span>
								<span aria-hidden="true"></span>
							</button>
						</div>
					</div>
					<div class="col-xs-12 col-lg-6 second-lg header__moveLeft js_desktopMenu"></div>
				</div>
			</div>
		</header>
		<main class="main">
		<?if($page !== "/index.php")
		{?>
			<div class="container">
				<ul class="breadcrumbs">
					<li class="breadcrumbs__item">
						<a href="/" class="breadcrumbs__link">Главная страница</a>
					</li>
					<li class="breadcrumbs__item">Портфолио</li>
				</ul>
				<h1 class="heading heading_firstLevel heading_uppercase"><?$APPLICATION->ShowTitle(false);?></h1>
			</div><?
		}?>
