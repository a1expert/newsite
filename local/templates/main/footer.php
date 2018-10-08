<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($APPLICATION->GetProperty("showBottomForm") == "Y")
{
    include_once($_SERVER["DOCUMENT_ROOT"] . "/local/inc_files/bottom_form.php");
}
if ($page == "/")
{?>
    <section class="contacts contacts_main">
        <div class="container contacts__container">
            <div class="contacts__info">
                <h2 class="contacts__heading">Контакты</h2>
                <ul class="contacts__list">
                    <li class="contacts__item">
                        <span class="contacts__icon">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_map"></use></svg>
                        </span>
                        <small class="contacts__note">Автосервис</small>
                        <strong class="contacts__data"><?$APPLICATION->IncludeFile("/local/inc_files/footer_adres1.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"адрес"));?></strong>
                    </li>
                    <li class="contacts__item">
                        <span class="contacts__icon">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_map"></use></svg>
                        </span>
                        <small class="contacts__note">Магазин</small>
                        <strong class="contacts__data"><?$APPLICATION->IncludeFile("/local/inc_files/footer_adres2.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"адрес"));?></strong>
                    </li>
                    <li class="contacts__item contacts__item_button">
                        <span class="contacts__icon">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_phone"></use></svg>
                        </span>
                        <div class="contacts__text-wrapper">
                            <small class="contacts__note">Звоните</small>
                            <strong class="contacts__data"><?$APPLICATION->IncludeFile("/local/inc_files/footer_phone.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"телефон"));?></strong>
                        </div>
                        <a href="#modal_callback" class="button contacts__button contacts__button_desktop modal_callback-link">Заказать звонок</a>
                    </li>
                    <li class="contacts__item">
                        <span class="contacts__icon">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="#icon_write"></use></svg>
                        </span>
                        <small class="contacts__note">Пишите</small>
                        <div class="contacts__data">
                            <div class="social">
                                <div class="social__icons">
                                    <?$APPLICATION->IncludeFile("/local/inc_files/vk_link.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"ссылку на группу в ВК"));?>
                                    <?$APPLICATION->IncludeFile("/local/inc_files/viber_number.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"номер в вайбере"));?>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <a href="#modal_callback" class="button contacts__button contacts__button_mobile modal_callback-link">Заказать звонок</a>
            </div>
            <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	"mainYmap", 
	array(
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "MINIMAP",
			2 => "TYPECONTROL",
			3 => "SCALELINE",
		),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:61.26666393456498;s:10:\"yandex_lon\";d:73.42045501503263;s:12:\"yandex_scale\";i:17;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:73.42142061027799;s:3:\"LAT\";d:61.266728506336015;s:4:\"TEXT\";s:37:\"А1 - Интернет эксперт\";}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "600",
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"COMPONENT_TEMPLATE" => "mainYmap"
	),
	false
);?>
        </div>
    </section><?
}?>
</main>
<footer class="footer">
    <div class="container footer__container">
        <div class="row">
            <div class="col-xs-12 col-md-2">
                <p class="footer__owner"><?$APPLICATION->IncludeFile("/local/inc_files/footer_owner.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"это"));?></p>
            </div>
            <div class="col-xs-12 col-md-3">
                <p class="footer__data"><?$APPLICATION->IncludeFile("/local/inc_files/footer_data.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"это"));?></p>
            </div>
            <div class="col-xs-12 col-md-7">
                <?$APPLICATION->IncludeFile("/local/inc_files/footer_policy_link.php", Array(), Array("SHOW_BORDER"=>"true", "MODE"=>"html", "NAME"=>"ссылку"));?>
            </div>
        </div>
    </div>
</footer>
<div class="modal">
    <div id="modal_callback" class="modal__wrapper zoom-anim-dialog mfp-hide">
        <div id="modal_callback_inner"></div>
        <?/*include_once($_SERVER["DOCUMENT_ROOT"] . "/local/inc_files/modal_form.php");*/?>
    </div>
</div>
</body>
</html>