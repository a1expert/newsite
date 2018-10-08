<?
/**
 * @var принтуемый массив
 * @mode по умолчанию тру = испольщуется print_r. false = используется var_dump
 * @show режим показа на странице по умолчанию true = показывать. false = скроет результат работы со страницы но оставинт просмотр в инструментах разработчика во вкладке Элементы (Elements)
 */
function ShowRes($var, $mode = true, $show = true)
{
    echo '<style>pre{background-color:#000000;color:#1ace38;font-size:14px;width:100%;max-width:1200px;margin:0 auto;padding:30px;height:900px;overflow:scroll;}</style>';
    echo (($show) ? '<pre>' : '<pre style="display:none;">');
    if ($mode)
    {
        print_r($var);
    }else
    {
        var_dump($var);
    }
    echo '</pre>';
}
?>