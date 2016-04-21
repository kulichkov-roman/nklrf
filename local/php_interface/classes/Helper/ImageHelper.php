<?
namespace Your\Helper;

/**
 * Хелпер для работы с изображениями
 *
 * Class UserHelper
 *
 * @package Your\Helper
 *
 * @author Kulichkov Roman <roman@kulichkov.pro>
 */
class ResizerITC
{
    public $params;

    public function __construct($params)
    {
        //self::$params = $params;
    }

    public static function GetResizeImage()
    {

    }
}

class ResizerTRPIC
{

}

class ResizerFactory
{
    /**
     * @param $resizerType
     * @param $params
     *
     * @return mixed
     * @throws \Exception
     */
    public static function build($resizerType, $params)
    {
        $resizer = "Resizer" . ucfirst($resizerType);

        if (class_exists($resizer))
        {
            return new $resizer($params);
        }
        else
        {
            throw new \Exception("Неверный тип ресайзера");
        }
    }
}

class ImagesHelper
{
    public static function GetResizeImages($resizerType, $params)
    {
        $objResizer = ResizerFactory::build($resizerType);
    }
}
?>
