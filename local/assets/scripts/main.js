$(document).ready(function () {

	const $carouselContainer = $('.carousel');
	const orderSteps = $carouselContainer.find('.orderSteps__carousel');
	const orderStepsNav = $carouselContainer.find('.carouselNav_orderStep');
	const serviceAdvantages = $carouselContainer.find('.serviceAdvantages__carousel');
	const serviceAdvantagesNav = $carouselContainer.find('.carouselNav_serviceAdvantages');
	const pricesCarousel = $carouselContainer.find('.prices__carousel');
	const progressCarousel = $('.progress__inner');
	const ourGroupsCarousel = $('.ourGroups .row');
	const carouselPrev = '<svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_arrowLeft"></use></svg>';
	const carouselNext = '<svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_arrowRight"></use></svg>';
	//	табы
	const slideUpAnimatedBlocks = $('.jsSlideUp');
	const tabContent = $('.tabs__content');
	const tabButton = $('.tabs__button');
	const tlTabs = new TimelineMax({delay: -0.5});

	function initOwl(carouselContainer, navContainer, dots, loop, responsive) {
		carouselContainer.owlCarousel({
			items: 1,
			margin: 10,
			loop: loop,
			nav: true,
			dots: dots,
			navText: [carouselPrev, carouselNext],
			responsive: responsive
		});
	}

	//	инициализация каруселей
	//	<--начало-->
	function initSmallCarousels() {
		initOwl(orderSteps, orderStepsNav, false, true, '');
		initOwl(serviceAdvantages, serviceAdvantagesNav, false, true, '');
		initOwl(progressCarousel, '', false, true, '');
		initOwl(ourGroupsCarousel, '', false, true, '');
	}

	function initPricesCarouselsInTabs(container) {
		container.owlCarousel({
			items: 1,
			margin: 10,
			loop: true,
			nav: true,
			dots: false,
			navText: [carouselPrev, carouselNext],
			responsive: {
				768:
					{
						items: 3,
						center: true
					}
			}
		});
	}

	//	<--конец-->

	//  инициализируем карусели при загрузке страницы
	//	<--начало-->
	if (window.matchMedia("(max-width: 767px)").matches) {
		initSmallCarousels();
	}
	if (window.matchMedia("(max-width: 1023px)").matches) {
		pricesCarousel.each(function () {
			const id = $(this).attr('id');
			initPricesCarouselsInTabs($('#' + id));
		});
	}
	//	<--конец-->


	//	уничтожение каруселей
	//	<--начало-->
	function destroySmallCarousels() {
		orderSteps.trigger('destroy.owl.carousel');
		serviceAdvantages.trigger('destroy.owl.carousel');
		progressCarousel.trigger('destroy.owl.carousel');
		ourGroupsCarousel.trigger('destroy.owl.carousel');
	}

	function destroyMediumCarousels() {
		pricesCarousel.trigger('destroy.owl.carousel');
	}

	//	<--конец-->

	//  при ресайзе окна проверяем размер окна и
	//	или разрушаем карусели или инициализируем их
	//	<--начало-->
	$(window).on('resize', function () {
		if (window.matchMedia("(max-width: 767px)").matches) {
			initSmallCarousels();
		}
		if (window.matchMedia("(max-width: 1023px)").matches) {
			pricesCarousel.each(function () {
				const id = $(this).attr('id');
				initPricesCarouselsInTabs($('#' + id));
			});
		}
		if (window.matchMedia("(min-width: 768px)").matches) {
			destroySmallCarousels();
		}
		if (window.matchMedia("(min-width: 1024px)").matches) {
			destroyMediumCarousels();
		}
	});
	//	<--конец-->


	// меню
	const menuButton = $('.header__button');
	const menu = $('.menu');
	const menuDesktopWrapper = $('.js_desktopMenu');
	const menuMobileWrapper = $('.js_mobileMenu');
	const dropDownMenu = $('.menuDropdown');
	const menuBtnTl = new TimelineMax({paused: true});

	menuBtnTl
		.to(menuButton.find('span:first-child'), .3, {y: 10, width: 48})
		.to(menuButton.find('span:nth-child(2)'), .3, {opacity: 0}, '-=.3')
		.to(menuButton.find('span:last-child'), .3, {y: -10, width: 48}, '-=.3')
		.to(menuButton.find('span:first-child'), .3, {rotation: 45})
		.to(menuButton.find('span:last-child'), .3, {rotation: -45}, '-=.3');


	menuButton.on('click', showMenu);

	const swapMenuToDesktop = function () {
		if (menuDesktopWrapper.children().length===0) {
			menuDesktopWrapper.append(menu);
			menu.removeAttr('style');
			return false
		}
		return false
	};

	const swapMenuToMobile = function () {
		if (menuMobileWrapper.children().length===0) {
			menuMobileWrapper.append(menu);
			return false
		}
		return false
	};

	$(window).on('resize', function () {
		if (window.matchMedia("(min-width: 1200px)").matches) {
			swapMenuToDesktop();
			dropDownMenu.removeAttr('style');
		} else {
			swapMenuToMobile();
		}

	});

	if (window.matchMedia("(min-width: 1200px)").matches) {
		swapMenuToDesktop();
		dropDownMenu.removeAttr('style');
	}

	function showMenu() {
		if (!$(this).hasClass('header__button_active')) {
			menu.addClass('menu_shown');
			menuMobileWrapper.addClass('open');
			$(this).addClass('header__button_active');
			menuBtnTl.play();
		} else {
			$(this).removeClass('header__button_active');
			menu.removeClass('menu_shown');
			menuMobileWrapper.removeClass('open');
			menuBtnTl.reverse();
		}
	}

	const openDropdownMenu = function () {
		if (window.matchMedia("(min-width: 1200px)").matches) {
			return false
		} else {
			$(this).next('.menuDropdown').slideToggle(400);
		}

	};

	$('.menu__link_dropdown').on('click', openDropdownMenu);


	const header = $('.header');
	const logo = $('.logo__image');
	const headerButton = $('.header__callback');

	let checkHeaderFlag = true;// флаг для хедера, есть или нет inverse
	// функция которая проверяет и перезаписывает флаг в том случае если inverse header'a нет
	const checkHeader = function () {
		if (!$('.header').hasClass('header_inverse')) {
			return checkHeaderFlag = false;
		}
	};

	checkHeader();

	function stickHeader(header, logo) {
		header.addClass('header_sticky');
		if (checkHeaderFlag) {
			header.removeClass('header_inverse');
		}
		logo.addClass('logo__image_sticky');
	}

	function unstickHeader(header, logo) {
		header.removeClass('header_sticky');
		if (checkHeaderFlag) {
			header.addClass('header_inverse');
		}
		logo.removeClass('logo__image_sticky');
	}

	if ($(window).scrollTop() > 1) {
		stickHeader(header, logo)
	}
	if ($(window).scrollTop() > 825) {
		headerButton.addClass('header__callback_sticky');
	}
	if ($(window).scrollTop() < 825) {
		headerButton.removeClass('header__callback_sticky');
	}
	if ($(window).scrollTop() < 1) {
		unstickHeader(header, logo)
	}

	$(window).on('scroll', function () {
		if ($(window).scrollTop() > 1) {
			stickHeader(header, logo)
		}
		if ($(window).scrollTop() > 825) {
			headerButton.addClass('header__callback_sticky');
		}
		if ($(window).scrollTop() < 825) {
			headerButton.removeClass('header__callback_sticky');
		}
		if ($(window).scrollTop() < 1) {
			unstickHeader(header, logo)
		}
	});

	// карусель на главной
	const mainCarousel = $('.mainCarousel');
	const mainCarouselDots = $('.mainCarousel__dot');

	const animateTExtOnLoad = function (e) {
		const currentIndex = e.item.index;
		const currentSlide = $(e.target).find(".owl-item").eq(currentIndex);
		const slideItems = currentSlide.find('h2, p, a');
		const tlHeroLoading = new TimelineMax();
		tlHeroLoading
			.staggerFromTo(slideItems, 1.2, {left:80, opacity:0}, {left: 0, opacity: 1}, 0.4);
	};

	mainCarousel.on('initialized.owl.carousel', function(e){
		animateTExtOnLoad(e);
	});

	mainCarousel.owlCarousel({
		items: 1,
		loop: true,
		dots: true,
		dotsContainer: '.mainCarousel__dots',
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		mouseDrag: false,
		autoplay: true,
		autoplayTimeout: 10000,
		callbacks: true
	});

	mainCarouselDots.on('click', function () {
		$('.hero__carousel').trigger('to.owl.carousel', [$(this).index(), 300]);
	});

	mainCarousel.on('changed.owl.carousel', function (e) {
		mainCarousel.trigger('stop.owl.autoplay');
		mainCarousel.trigger('play.owl.autoplay');
		const currentIndex = e.item.index;
		const currentSlide = $(e.target).find(".owl-item").eq(currentIndex);
		const slideItems = currentSlide.find('h2, p, a');
		const tlHero = new TimelineMax();
		tlHero.staggerFromTo(slideItems, 1.2, {left:80, opacity:0}, {left: 0, opacity: 1}, 0.4);
	});

	const reviewsCarousel = $('.reviews__carousel');

	reviewsCarousel.owlCarousel({
		items: 1,
		margin: 30,
		loop: true,
		nav: true,
		navContainer: '.reviews__nav',
		navText: [carouselPrev, carouselNext],
		responsive: {
			600: {
				items: 3
			},
			1200: {
				items: 6
			}
		}
	});


	$('.reviews__link').on('click', function () {
		const parent = $(this).parents('.owl-item');
		if (!(parent.hasClass('active') && !parent.prev().hasClass('active'))) {
			reviewsCarousel.trigger('next.owl.carousel');
		}
	});


	//	показ формы в блоке "Начнем работу"
	//	<--начало-->
	const $getStartedShowFormBtn = $('.getStarted__showForm'); //	ищем кнопку показывающую форму
		$getStartedShowFormBtn.on('click', getStartedShowForm); //	запускаем событие по нажатию на нее

	function getStartedShowForm () {
		const getStartedContainer = $(this).parents('.getStarted'); // ищем родителя нажатой кнопки
		const getStartedFirst =  getStartedContainer.find('.getStarted__first'); // ищем скрываемвй блок
		const getStartedSecond =  getStartedContainer.find('.getStarted__second'); //	ищем показываемый блок
		getStartedFirst.slideUp(450);
		getStartedSecond.slideDown(450);
	}
	//	<--конец-->


	// "Плавающие" метки на инпутах
	//	<--начало-->
	// Проверяем каждый инпут после каждого изменения на наличие в нем какого-то value и
	// если оно не пустое, то даем меткам соответствующий класс
	$('.jsFloating').on('change', function () {
		const val = this.value;
		if (val) {
			$(this).next().addClass('floatPlaceholder_up');
		} else {
			$(this).next().removeClass('floatPlaceholder_up');
		}
	});
	//	<--конец-->

	const input = $('.jsValidate');
	input.on('blur', validate);

	function validate () {
		const error = ('<span class="error"></span>');
		const value = $(this).val().length;
		if (value < 2 || value === 0) {
			console.log($(this).parent());
			$(this).addClass('input_error');
			$(this).parent().append(error)
		}
	}

	//  карусель с ценами


	// попапы в блоке "Принципы разработки сайта"
	//	<--начало-->
	const serviceInfoListContainer = $('.serviceInfoList');
	const serviceInfoListItem = serviceInfoListContainer.find('.serviceInfoList__item');
	const serviceInfoListButtonOpen = serviceInfoListContainer.find('.serviceInfoList__more');
	const serviceInfoListPopup = serviceInfoListContainer.find('.serviceInfoList__popup');
	const serviceInfoListButtonClose = serviceInfoListPopup.find('.serviceInfoList__close');

	//	открываем попап по клике на кнопку
	function showServiceInfoListPopup () {
		serviceInfoListItem.removeClass('serviceInfoList__popup_shown');
		serviceInfoListPopup.removeClass('serviceInfoList__popup_shown');
		$(this).next(serviceInfoListPopup).addClass('serviceInfoList__popup_shown');
	}

	//	закрываем попап по клику на крестик в нем
	function closeServiceInfoListPopup () {
		serviceInfoListPopup.removeClass('serviceInfoList__popup_shown');
	}

	serviceInfoListButtonOpen.on('mouseenter', showServiceInfoListPopup);
	serviceInfoListPopup.on('mouseleave', closeServiceInfoListPopup);
	serviceInfoListButtonOpen.on('click', showServiceInfoListPopup);
	serviceInfoListButtonClose.on('click', closeServiceInfoListPopup);
	//	<--конец-->

	//	развертывание блока с текстом в мобильной версии на странице цен (пока что...)
	//	<--начало-->
	const showTextBtn = $('.serviceDescription__showAll');
	function showText () {
		const textContainer = $(this).parent('.serviceDescription');
		textContainer.addClass('serviceDescription_open');
		$(this).fadeOut(100);
	}

	showTextBtn.on('click', showText);
	//	<--конец-->

	//	анимация частей svg иконок в блоках с услугами
	// объявление таймлайнов gsap
	const tlDevPolygon = new TimelineMax({paused: true, repeat: -1, yoyo: true});
	const tlSeoPolygon = new TimelineMax({paused: true, repeat: -1, yoyo: true});
	const tlContextFlame = new TimelineMax({paused: true, repeat: -1, yoyo: true});
	const tlSocialLines = new TimelineMax({paused: true, repeat: -1, yoyo: true});

	// объявление элементов и их id для работы с ними
	const serviceBlockLink = $('.serviceBlock__link');// ссылка при наведении на которую запускается анимация
	const serviceBlockDevId ='serviceBlock_dev'; //	блок с услугой разработки
	const serviceBlockSeoId = 'serviceBlock_seo';//	блок с услугой SEO
	const serviceBlockContextId = 'serviceBlock_context';// блок с услугой контекстной рекламы
	const serviceBlockSocialId = 'serviceBlock_social';// блок с услугой продвижения в соц. сетях

	//	объявление частей svg которые будем анимировать
	//	полигоны в блоке с услугой разработки
	const devPolygonLeft = $('#icon_coding').find('#codingLeft');
	const devPolygonRight = $('#icon_coding').find('#codingRight');

	//	полигон в блоке с услугой
	const seoPolygon = $('#icon_analytics').find('polygon');

	// группа элементов в иконке с ракетой (какое-то там продвижеие какой-то хуеты)
	const contextFlame = $('#icon_rocket').find('.rocketFlame');

	// массив линий в ебучем бумажном самолетике
	const lines = $('#icon_paperPlane').find('.planeLines');

	//	описание анимаций всех таймлайнов gsap
	tlDevPolygon
		.to(devPolygonLeft, 0.3, {y: -30})
		.to(devPolygonRight, 0.45, {y: -20}, '-=0.45');

	tlSeoPolygon
		.to(seoPolygon, 1.45, {'fill-opacity': 0});

	tlContextFlame
		.to(contextFlame, .4, {x: 10, y: -10});

	tlSocialLines
		.staggerTo(lines, 0.55, {'fill-opacity': 0}, 0.15);

	//	собственно само действо
	//	определение функций с анимациями
	const playServiceBlockAnimation = function (animationType) {
		animationType.play();
	};

	const pauseServiceBlockAnimation = function (animationType) {
		animationType.pause(0);
	};

	// вызов соответствующей функции при наведении курсора на блок
	serviceBlockLink.on('mouseenter', function () {
		const id = $(this).attr('id');
		console.log(' id' + id);
		if (id === serviceBlockDevId) {
			playServiceBlockAnimation(tlDevPolygon);
		}
		if (id === serviceBlockSeoId) {
			playServiceBlockAnimation(tlSeoPolygon);
		}
		if (id === serviceBlockContextId) {
			playServiceBlockAnimation(tlContextFlame);
		}
		if (id === serviceBlockSocialId) {
			playServiceBlockAnimation(tlSocialLines);
		}
	});

	// остановка соответствующей анимации при отмене наведения курсора

	serviceBlockLink.on('mouseleave', function () {
		const id = $(this).attr('id');
		if (id === serviceBlockDevId) {
			pauseServiceBlockAnimation(tlDevPolygon);
		}
		if (id === serviceBlockSeoId) {
			pauseServiceBlockAnimation(tlSeoPolygon);
		}
		if (id === serviceBlockContextId) {
			pauseServiceBlockAnimation(tlContextFlame);
		}
		if (id === serviceBlockSocialId) {
			pauseServiceBlockAnimation(tlSocialLines);
		}

	});

	function showTab(tab){
		tabContent.hide();
		const thisTab = $(tab.data('target'));
		thisTab.fadeIn(500);
		const items = thisTab.find(slideUpAnimatedBlocks);
		if (window.matchMedia("(min-width: 1024px)").matches) {
			tlTabs
				.staggerFrom(items, 0.65, {ease: Power2.easeOut, top:75}, 0.15);
		}

	}

	showTab($('#tab1'));

	tabButton.on('click', function () {
		if ($(this).hasClass('tabs__button_active')) {
			return false;
		}else {
			tabButton.removeClass('tabs__button_active');
			$(this).addClass('tabs__button_active');
			showTab($(this));
		}
	});

	const heroCarousel = $('.hero__carousel');
	heroCarousel.owlCarousel({
		items: 1,
		loop: true,
		nav: true,
		mouseDrag: false,
		navContainer: '.carouselNav_hero',
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		navText: [carouselPrev, carouselNext]
	});

	heroCarousel.on('changed.owl.carousel', function (e) {
		const currentIndex = e.item.index;
		const currentSlide = $(e.target).find(".owl-item").eq(currentIndex);
		const slideItems = currentSlide.find('.hero__heading, .hero__subtitle, .hero__text');
		const tlHero = new TimelineMax();
		tlHero.staggerFrom(slideItems, 0.5, {top: 40, opacity: 0}, 0.1);
	});

	const caseDevCarousel = $('.caseDevCarousel');
	caseDevCarousel.owlCarousel({
		items: 1,
		loop: true,
		nav: true,
		mouseDrag: true,
		navContainer: '.caseDev__nav',
		margin: 100,
		navText: [carouselPrev, carouselNext]
	});

	// график, да-да, один только лишь и еще и не универсальный (сам в шоке)
	const graph = $('#graph');
	let coords = [];
	let breakPoint = '';
	let breakPointLeft = '';
	const pathBeforeEl = graph.find('#before');
	const pathAfterEl = graph.find('#after');
	let pathBeforeCoords = [];
	let breakPointCoords = [];
	let pathAfterCoords = [];
	let pathBefore = '';
	let pathAfter = '';
	const graphLogo = ('<div class="graph__logo"></div>');

	const drawCells = function () {
		for(let i = 0; i < 40; i++) {
			graph.append('<div class="graph__cell"></div>');
		}
	};

	const drawCircles = function () {
		const circle = '<span class="circle"></span>';
		for (let i = 0; i < 7; i++) {
			graph.append(circle);
		}

	};

	const placeCircles = function () {
		const drawedCircles = $('.circle');
		const cellWidth = $('.graph__cell').outerWidth();
		let coords = cellWidth;
		drawedCircles.each(function() {
			$(this).css('left', +coords+'px');
			coords +=cellWidth
		})
	};

	const calcCoords = function () {
		$('.circle').each(function () {
			const left =  $(this).position().left;
			const top = $(this).position().top;
			coords.push(Math.floor(left + 10));
			coords.push(Math.floor(top + 10));
		})
	};

	const splitCoords = function (coords) {
		pathBeforeCoords.push(coords.slice(0, 6));
		pathAfterCoords.push(coords.slice(6));
		breakPointCoords.push(coords[4], coords[5]);
		breakPointLeft = '' + coords[4];
	};

	const createBreakPoint = function (array) {
		for (let i = 0; i < array.length; i++) {
			breakPoint += '' + array[i] + ' ';
		}
	};

	const createPathBefore = function (array) {
		for (let i = 0; i < array.length; i++) {
			if (i % 2 === 0) {
				pathBefore += 'L ' + array[i] + ' ';
			} else {
				pathBefore += array[i] + ' ';
			}
		}
	};

	const createPathAfter = function (array) {
		for (let i = 0; i < array.length; i++) {
			if (i % 2 === 0) {
				pathAfter += 'L ' + array[i] + ' ';
			} else {
				pathAfter += array[i] + ' ';
			}
		}
	};

	const drawLines = function (pathBefore, pathAfter) {
		pathBeforeEl.attr('d', `m 0 340 ${pathBefore} L ${breakPointLeft} 350 z`);
		pathAfterEl.attr('d', `m ${breakPoint} ${pathAfter} L 1200 10 L 1200 350 L ${breakPointLeft} 350 z`);
	};


	const clearGraph = function () {
		coords = [];
		breakPoint = '';
		breakPointLeft = '';
		pathBeforeCoords = [];
		breakPointCoords = [];
		pathAfterCoords = [];
		pathBefore = '';
		pathAfter = '';
		pathBeforeEl.attr('d', '');
		pathAfterEl.attr('d', '');
	};

	const placeLogo = function () {
		graph.append(graphLogo);
	};

	const calcLogoCoords = function () {
		const graphLogoCoords = ($('.graph__cell').outerWidth() * 3);
		$('.graph__logo').css('left', graphLogoCoords);
	};

	const placeLabels = function () {
		const labelMessages = ['50','75','125','175','225'];
		const label = '<div class="graph__label"></div>';
		let labelTopOffset = 0;
		for (let i = 0; i < 5; i++) {
			graph.append(label);
		}
		$('.graph__label').each(function (index) {
			$(this).css('top', labelTopOffset);
			$(this).text(labelMessages.reverse()[index]);
			labelTopOffset += 68;
		});

	};

	$(window).on('resize', function () {
		clearGraph();
		placeCircles();
		calcCoords();
		splitCoords(coords);
		createBreakPoint(breakPointCoords);
		createPathBefore(pathBeforeCoords);
		createPathAfter(pathAfterCoords);
		drawLines(pathBefore, pathAfter);
		calcLogoCoords();
	});

	const init = function () {
		drawCells();
		drawCircles();
		placeCircles();
		calcCoords();
		splitCoords(coords);
		createBreakPoint(breakPointCoords);
		createPathBefore(pathBeforeCoords);
		createPathAfter(pathAfterCoords);
		drawLines(pathBefore, pathAfter);
		placeLogo();
		calcLogoCoords();
		placeLabels();
	};

	init();


	$('.jsPopupLink').magnificPopup ({
		type: 'inline'
	});

	$('.reviews').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
		}
	});

	if($('#graph').length) {
		const tlGraph = new TimelineMax();
		$(window).on('scroll', function () {
			const i = graph.offset().top;
			const j = ($(window).scrollTop());
			if ((i - j) < 500) {
				tlGraph
					.to(pathBeforeEl, 2, {strokeDashoffset:0})
					.to(pathBeforeEl, 0.05, { fill: "url(#beforeFill)" }, '-=1.35')
					.to($('.graph__logo'), 0.5, {alpha:1, top: '60'}, '-=0.75')
					.to(pathAfterEl, 2, {strokeDashoffset:0}, '-=0.15')
					.to(pathAfterEl, 0.05, { fill: "url(#afterFill)" }, '-=1.15');

			}
		});
	}

	// MagicScroll

	const controller = new ScrollMagic.Controller();
	const progressBlocks = $('.progress__tile');
	const partnersBlocks = $('.partners__item');
	const fadeInTilesOnMainPageTl = new TimelineMax();
	const fadeInTilesTl = TweenMax.staggerFromTo(progressBlocks, 1,{opacity: 0, y: 30}, {opacity: 1, y: 0, ease: Back.easeOut.config(1.7)}, 0.25);
	const fadeInPartnersTl = TweenMax.staggerFromTo(partnersBlocks, 0.9,{opacity: 0, y: 30}, {opacity: 1, y: 0, ease: Back.easeOut.config(1.7)}, 0.3);
	fadeInTilesOnMainPageTl
		.add(fadeInTilesTl)
		.add(fadeInPartnersTl, "-=1");
	const fadeInTiles = new ScrollMagic.Scene({triggerElement: ".progress", reverse: false});
	fadeInTiles.offset(-250);
	fadeInTiles.setTween(fadeInTilesOnMainPageTl);
	fadeInTiles.addTo(controller);

	if (hero) {
		setup();

		// шары на главной карусели
		const colors = ["#ffb900"];

		const numBalls = 50;
		const balls = [];

		for (let i = 0; i < numBalls; i++) {
			let ball = document.createElement("div");
			ball.classList.add("ball");
			ball.style.position = 'absolute';
			ball.style.background = colors[Math.floor(Math.random() * colors.length)];
			ball.style.left = `${Math.floor(Math.random() * 100)}vw`;
			ball.style.top = `${Math.floor(Math.random() * 100)}vh`;
			ball.style.transform = `scale(${Math.random()})`;
			ball.style.width = `${Math.random()}em`;
			ball.style.height = ball.style.width;

			balls.push(ball);
			hero.append(ball);
		}

		// Keyframes
		balls.forEach((el, i, ra) => {
			let to = {
				x: Math.random() * (i % 2 === 0 ? -11 : 11),
				y: Math.random() * 12
			};

			let anim = el.animate(
				[
					{ transform: "translate(0, 0)" },
					{ transform: `translate(${to.x}rem, ${to.y}rem)` }
				],
				{
					duration: (Math.random() + 1) * 2000, // random duration
					direction: "alternate",
					fill: "both",
					iterations: Infinity,
					easing: "ease-in-out"
				}
			);
		});


	}



	// после тестов удалить
	const main2 = $('.main_main2');
	main2.find('canvas').remove();
	const main3 = $('.main_main3');
	main3.find('.ball').remove();


	// кнопки листающие табы

	const prevTabBtn = $('.tabs__buttonMobile_prev');
	const nextTabBtn = $('.tabs__buttonMobile_next');
	prevTabBtn.html('<svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_arrowLeft"></use></svg>');
	nextTabBtn.html('<svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_arrowRight"></use></svg>');

	nextTabBtn.on('click', function () {
		const activeTabBtn = $('.tabs__button_active');
		const triggeredTabBtn = activeTabBtn.next();
		if(!triggeredTabBtn.length === false ) {
			triggeredTabBtn.trigger('click');
		} else {
			return false
		}
	});

	prevTabBtn.on('click', function () {
		const activeTabBtn = $('.tabs__button_active');
		const triggeredTabBtn = activeTabBtn.prev();
		if(!triggeredTabBtn.length === false ) {
			triggeredTabBtn.trigger('click');
		} else {
			return false
		}
	});


	// создаем сетку статей
	if (window.matchMedia("(min-width: 400px)").matches) {

	}
	$('.blogGrid').isotope({
		itemSelector: '.blogGrid__item',
		percentPosition: true,
		masonry: {
			// use outer width of grid-sizer for columnWidth
			columnWidth: '.blogGrid__item'
		}
	});

	// в кнопки сортировки пишем нужные дата атрибуты
	// и даем соответствующие классы элементам сетки

	const articleFilterBtn = $('.articlePreview__label');
	const placeDataAttributesToFilterBtns = function () {
		articleFilterBtn.each(function () {
			const self = $(this);
			const selfParent = $(this).parents('.blogGrid__item');
			const selfParentData = selfParent.data('filter');
			selfParent.addClass(selfParentData);
			self.attr('data-filter', selfParentData);
		});
	};

	placeDataAttributesToFilterBtns();

	//фильтрация блоков со статьями

	let filters = {};

	articleFilterBtn.on( 'click', function () {
		const self = $(this);
		const filterValue = self.data('filter');
		$('.blogGrid').isotope({ filter: '.' + filterValue });
	});

});
	// рисование на главном слайдере
	const hero = document.querySelector('.hero_main');
	if (hero) {
		var width, height;
		var step = 0;

		var canvas = document.createElement('canvas');
		hero.appendChild(canvas);
		var ctx = canvas.getContext('2d');
		var bg = [248, 248, 248];

		function Mouse () {
			this.x = window.innerWidth / 2;
			this.y = window.innerHeight / 2;
		}
		var mouse = new Mouse();
		document.onmousemove = function(e){
			mouse.x = e.pageX;
			mouse.y = e.pageY;

		};


		window.addEventListener('resize', setup);

		function setup() {
			canvas.width = width = hero.offsetWidth;
			canvas.height = height = hero.offsetHeight;
			fillCanvas(ctx, bg, 1)
		}

		window.requestAnimationFrame(animate);

		function animate() {
			fillCanvas(ctx, bg, 1);
			draw();
			step++;
			window.requestAnimationFrame(function(){animate()});
		}

		function Flwr () {
			this.follow = null;
			this.child = null;
			this.x = mouse.x;
			this.y = mouse.y;
			this.dx = 0;
			this.dy = 0;
			this.a = 0.35;
			this.b = 0.54;
			this.n = 0
		}


		var flwr, flwrPrev, train = [], i, n = 50;
		for (i = 0; i < n; i++) {
			flwr = new Flwr();
			flwr.n = i;
			if (flwrPrev) {
				flwr.b = flwrPrev.b + (0.1/n);
				flwr.follow = flwrPrev;
				flwrPrev.child = flwr
			} else {
				flwr.follow = mouse
			}
			flwrPrev = flwr;
			train.push(flwr)
		}

		function draw () {
			// update flwrs
			// console.log(train)

			for (i in train){
				// update position
				flwr = train[i];
				var dx = flwr.follow.x - flwr.x;
				var dy = flwr.follow.y - flwr.y;

				flwr.dx = flwr.dx * flwr.a + dx * (1 - flwr.a);
				flwr.dy = flwr.dy * flwr.a + dy * (1 - flwr.a);

				flwr.x = flwr.dx * flwr.b + flwr.x;
				flwr.y = flwr.dy * flwr.b + flwr.y;



				if (flwr.follow !== mouse) {
					ctx.beginPath();
					ctx.strokeStyle = '#ffb900';
					ctx.lineCap = 'round';
					ctx.lineWidth = (n-flwr.n)/n * 8 + 2;
					ctx.moveTo(flwr.x,flwr.y);
					ctx.lineTo(flwr.follow.x,flwr.follow.y);
					ctx.stroke();
				}
			}

		}

		function drawCircle (context, x, y, r) {
			context.arc(x ,y , r, 0, 2*Math.PI);
		}

		function fillCanvas (context, color, alpha) {
			context.rect(0, 0, this.width, this.height);
			context.fillStyle = `rgba(${color[0]}, ${color[1]}, ${color[2]}, 1)`;
			context.fill();
		};

	}


