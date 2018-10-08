<?
require_once("include/constants.php");
include_once("include/functions.php");
/*\Bitrix\Main\Loader::registerAutoLoadClasses(
    null,
    array(
        'PHPMailer\PHPMailer\PHPMailer' => '/local/php_interface/include/PHPMailer/src/PHPMailer.php',
        'PHPMailer\PHPMailer\Exception' => '/local/php_interface/include/PHPMailer/src/Exception.php',
        'PHPMailer\PHPMailer\SMTP' => '/local/php_interface/include/PHPMailer/src/SMTP.php',
    )
);
function custom_mail($to, $subject, $message, $additional_headers, $additional_parameters)
{
    //парсим дополнительные заголовки в массив
    $arHeaders = [];
    if (!empty($additional_headers)) {
        $explode = explode("\n", $additional_headers);
        foreach ($explode as $strHeader) {
            if (preg_match('/^([^\:]+)\:(.*)$/', $strHeader, $matches)) {
                $key = trim($matches[1]);
                $value = trim($matches[2]);
                $arHeaders[$key] = $value;
            }
        }
    }
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    try {
        //Server settings
        // $mail->SMTPDebug = 2; 
        $mail->isSMTP();                                  // Set mailer to use SMTP
        $mail->Host = 'smtp.mail.ru';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                           // Enable SMTP authentication
        $mail->Username = 'manager@koreamarket.su';        // SMTP username
        $mail->Password = 'T@Q0QNx9gzrb';                  // SMTP password
        $mail->Port = 465;                                // SSL port to connect to
        $mail->SMTPSecure = 'ssl';
        $mail->CharSet = 'UTF-8';

        //Recipients
        $mail->setFrom('manager@koreamarket.su');
        $mail->addReplyTo('manager@koreamarket.su');
        foreach (explode(',', $to) as $email) {
            $email = trim($email);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress($email);
            }
        }


        //Content
        $mail->isHTML(strpos($arHeaders['Content-Type'], 'text/plain') === false);
        $mail->Subject = $subject;
        $mail->Body    = $message; 

        $mail->send();
    } catch (Exception $e) {
        // если все пошло по п..., то отправяем обычным способом 
        if($additional_parameters!="")
            return @mail($to, $subject, $message, $additional_headers, $additional_parameters);

        return @mail($to, $subject, $message, $additional_headers);
    }
}

AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "OnBeforeIBlockElementAddHandler");

// создаем обработчик события "OnBeforeIBlockElementAdd"
function OnBeforeIBlockElementAddHandler(&$arFields)
{
    global $APPLICATION;
    if(in_array($arFields["IBLOCK_ID"], array(FEEDBACK_FORM_ID))) {
        if (!GoogleReCaptcha::checkClientResponse()) {
            $APPLICATION->throwException("Подтвертите, что вы не робот!");
            return false;
        }
    }
}

AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnAfterIBlockElementAddHandler");
function OnAfterIBlockElementAddHandler(&$arFields)
{
    // Формы
    if(in_array($arFields["IBLOCK_ID"], array(FEEDBACK_FORM_ID, 14)) && !empty($arFields["ID"]))
    {
        $arSelect = Array("ID", "NAME", "PROPERTY_PHONE", "PROPERTY_PHONE_MAIL", "PREVIEW_TEXT", "PROPERTY_FORM_NAME");
        $arFilter = Array("IBLOCK_ID"=>$arFields["IBLOCK_ID"], "ID"=>$arFields["ID"]);

        $res = CIBlockElement::GetList(Array("ID" => "DESC"), $arFilter, false, false, $arSelect);

        $arMail = array("ID"=>"", "IBLOCK_ID" => "", "AUTHOR" => "", "PHONE" => "", "TEXT" => "");
        while($ob = $res->GetNextElement())
        {
            $arItem = $ob->GetFields();
            $arMail = array(
                "ID"=>$arFields["ID"],
                "IBLOCK_ID" => $arFields["IBLOCK_ID"],
                "AUTHOR" => $arItem["NAME"],
                "PHONE" => $arItem["PROPERTY_PHONE_VALUE"],
                "TEXT" => $arItem["PROPERTY_MSG_TEXT_VALUE"],
            );
        }
        if(!empty($arMail)){
            switch ($arFields["IBLOCK_ID"]) {
                case FEEDBACK_FORM_ID:
                case CALLBACK_FORM_ID:
                    $event = "FEEDBACK_FORM";
                    break;
                case 14:
                    $event = "TEST";
                    break;
                default:
                    break;
            }
            CEvent::Send($event, SITE_ID, $arMail);
        }
    }

}

AddEventHandler("main", "OnBeforeEventAdd", "OnBeforeEventAddHandler");
function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
{
    $arFields["CURRENT_URL"] = $_POST["CURRENT_URL"];
}


class GoogleReCaptcha
{

    public static function getPublicKey() {return "6Lc4nWYUAAAAAFIBrt2jHiMuytX0eZDfgyUr1gEs";}
    public static function getSecretKey() {return "6Lc4nWYUAAAAAKXh3uJ8w5oI3eYO1FJmi5vzIqxz";}
/**

   * @return array - if validation is failed, returns an array with errors, otherwise - empty array. This format is expected by component.

   *//*
    public static function checkClientResponse()
    {

        $context = \Bitrix\Main\Application::getInstance()->getContext();

        $request = $context->getRequest();

        $captchaResponse = $request->getPost("recaptcha");

        if($captchaResponse)
        {
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = array('secret' => static::getSecretKey(), 'response' => $captchaResponse);
            $httpClient = new Bitrix\Main\Web\HttpClient();
            $response = $httpClient->post($url, $data);
            if($response)
                $response = \Bitrix\Main\Web\Json::decode($response, true);
            if(!$response['success']) {                
                return false;
            }
            return true;
        }
        return false;
    }
}*/
?>