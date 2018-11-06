<?
use Bitrix\Iblock\Component\Base;
class Orion extends Base
{
    #region fields
    private $elFilter;
    private $elSelect;
    private $elOrder;
    private $editorButton;
    #endregion fields
    #region properties
    public function elFilter($value)
    {
        if(!empty($value))
            $this->elFilter = $value;
        else
            return $this->elFilter;    
    }
    public function elSelect($value)
    {
        if(!empty($value))
            $this->elSelect = $value;
        else
            return $this->elSelect;    
    }
    public function elOrder($value)
    {
        if(!empty($value))
            $this->elOrder = $value;
        else
            return $this->elOrder;    
    }
    #endregion properties

    public function __construct($component)
    {
        parent::__construct($component);
        $this->elSelect(array());
    }

    function getIblockElements($elementIterator){}
    function chooseOffer($offers, $iblockId){}
    function getAdditionalCacheId(){}
    function getComponentCachePath(){}

    /**
     * Статичная функция очистки массива от пустых значений. Работает рекурсивно, очищает полностью весь массив включая вложенные. Ничего не возвращает
     * @var array $array Массив для очистки, передается по ссылке.
     */
    public function CleanArray(&$array)
    {
        foreach ($array as $k=>$v)
        {
            if(is_array($v))
                $this->CleanArray($array[$k]);
            if(empty($v) || empty($array[$k]))
                unset($array[$k]);
        }
    }
    public function ElementFilter($params)
    {
        if(empty($params["IBLOCK_ID"]))
            throw new Exception("Не заполнен обязательный параметр - Инфоблок");
        $this->elFilter(array("IBLOCK_ID"=>$params["IBLOCK_ID"]));
        if(!empty($params["ELEMENT_FIELDS_FILTER"]))
        {
            $this->elFilter = array_merge($this->elFilter, $params["ELEMENT_FIELDS_FILTER"]);
        }
    }
    public function ElementSelect($params)
    {
        if(!empty($params["ELEMENT_FIELDS"]))
        {
            $this->elSelect = array_merge($this->elSelect, $params["ELEMENT_FIELDS"]);
        }
        if(!empty($params["PROPERTY_CODE"]))
        {
            foreach ($params["PROPERTY_CODE"] as $k=>$v)
                $item = "PROPERTY_" . $item;
            $this->elSelect = array_merge($this->elSelect, $params["PROPERTY_CODE"]);
        }
    }
    public function Caching()
    {
        $cache = Bitrix\Main\Data\Cache::createInstance();
        $cacheId = "tc1"; $cacheTime = 300;
        if ($cache->initCache($cacheTime, $cacheId))
        {
            $this->arResult = $cache->getVars();
        }
        elseif ($cache->startDataCache())
        {
            $arResult = $this->arResult;
            if (empty($arResult["ITEMS"]))
                $cache->abortDataCache();
            $cache->endDataCache($arResult);
        }
    }
    
    public function GetElementList($params, $arGroupBy = false, $arNavStartParams = false)
    {
        $this->ElementFilter($params);
        $this->ElementSelect($params);
        $dbres = CIBlockElement::GetList($this->elOrder, $this->elFilter, $arGroupBy, $arNavStartParams, $this->elSelect);
        while ($arItem = $dbres->GetNextElement())
        {  
            $item = $arItem->fields;
            if(!empty($item["PREVIEW_PICTURE"]))
                $item["PREVIEW_PICTURE"] = CFile::GetFileArray($item["PREVIEW_PICTURE"]);
            if(!empty($item["DETAIL_PICTURE"]))
                $item["DETAIL_PICTURE"] = CFile::GetFileArray($item["DETAIL_PICTURE"]);
            if($this->editorButton)
            {
                $arButtons = CIBlock::GetPanelButtons($item["IBLOCK_ID"], $item["ID"], 0, array("SECTION_BUTTONS"=>false, "SESSID"=>false));
                $item["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
                $item["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
            }
            $result[] = $item;
        }
        return array("ITEMS" => $result);
    }
    public function ResToJson($arResult)
    {
        $arrJson = array();
        $jsonItem = array("image"=>"", "name"=>"", "seats"=>"", "type"=>"", "price"=>"", "label"=>"");
        foreach ($arResult["ITEMS"] as $arItem)
        {
            $jsonItem["image"]=$arItem["DETAIL_PICTURE"];
            $jsonItem["name"]=$arItem["NAME"];
            $jsonItem["seats"]=$arItem["PROPERTY_WIDTH_VALUE"];
            $jsonItem["type"]=$arItem["PROPERTY_DENSITY_VALUE"];
            $jsonItem["price"]=$arItem["PROPERTY_LENGTH_VALUE"];
            $jsonItem["label"]=$arItem["PROPERTY_IMPREG_VALUE"];
            $arrJson[]=$jsonItem;
        }
        $this->jsonString = json_encode($arrJson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        
    }
    public function executeComponent()
    {
        $this->editorButton = ($this->arParams["DISPLAY_EDITOR_BUTTONS"] === "Y") ? true : false;
        $this->CleanArray($this->arParams);
        $this->arResult = $this->GetElementList($this->arParams);        
        $this->Caching();
        $this->includeComponentTemplate();
    }
    
}
?>