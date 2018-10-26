<?
namespace A1expert
{
    use Bitrix\Main\Entity,
        Bitrix\Main\Type;
    class CommonInfo extends Entity\DataManager
    {
        public static function getTableName()
    {
        return "common_info";
    }
    
    public static function getUfId()
    {
        return "COMMON_INFO";
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField("ID", array(
                "primary" => true,
                "autocomplete" => true
            )),
            new Entity\StringField("headerPhone"),
            new Entity\StringField("headerLogo"),
            new Entity\DateField("PUBLISH_DATE")
        );
    }

    // код для создания таблицы в MySQL 
    // (получен путем вызова BookTable::getEntity()->compileDbTableStructureDump())
    // CREATE TABLE `my_book` (
    //     `ID` int NOT NULL AUTO_INCREMENT,
    //     `ISBNCODE` varchar(255) NOT NULL,
    //     `TITLE` varchar(255) NOT NULL,
    //     `PUBLISH_DATE` date NOT NULL,
    //     PRIMARY KEY(`ID`)
    // );

    }
    
}
?>