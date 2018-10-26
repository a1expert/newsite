<?
use Bitrix\Iblock\Component\Base;

class Orion extends Base
{
    #region fields
    public $elFilter;
    public $elSelect;
    public $elOrder;
    public $editorButton;
    #endregion fields

    public function __construct($component, $active = "Y")
	{
        parent::__construct($component);
        $this->elFilter["ACTIVE"] = $active;
        $this->elSelect = array("IBLOCK_ID", "ID");
        $this->elOrder = array("sort"=>"asc");
	}

    function getIblockElements($elementIterator){}
    function chooseOffer($offers, $iblockId){}
    function getAdditionalCacheId(){}
    function getComponentCachePath(){}

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
        $this->elFilter["IBLOCK_ID"] = $params["IBLOCK_ID"];
        if(!empty($params["ELEMENT_FIELDS_FILTER"]))
        {
            $this->CleanArray($params["ELEMENT_FIELDS_FILTER"]);
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
        if ($cache->initCache($cacheTime, $cacheId, $cacheDir))
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
            $item = $arItem->GetFields();
            $item["PROPERTIES"] = $arItem->GetProperties();
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