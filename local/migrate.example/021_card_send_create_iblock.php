<?
/**
 * Создает инфоблок для отправки фото на карту rehau
 */
use Your\Tools\Data\Migration\Common\MigrationInterface;

define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_STATISTIC', true);
define('STOP_STATISTICS', true);
define('SITE_ID', 's1');

if (empty($_SERVER['DOCUMENT_ROOT'])) {
	$_SERVER['HTTP_HOST'] = 'rehau.pro';
	$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
}

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

while (ob_get_level()) {
	ob_end_flush();
}

if (!CModule::IncludeModule('iblock')) {
	die('Unable to include "iblock" module');
}

/**
 * Class CreateActionIblock
 */
class CreateCardRehauIblock implements MigrationInterface
{
	/**
	 * @var \Your\Tools\LoggerInterface
	 */
	private $logger;

	public function __construct()
	{
		$this->logger = new \Your\Tools\Logger\EchoLogger();
	}

	/**
	 * Применяет миграцию
	 */
	public function up()
	{
		$ib = new CIBlock;
		$dbIbRes = $ib->GetList(array(), array('CODE' => 'card_rehau_foto', 'IBLOCK_TYPE_ID' => 'services'));
		if (!$arIbRes = $dbIbRes->Fetch()) {
			$arFields = Array(
				"ACTIVE" => 'Y',
				"NAME" => 'Фотографии на карты Rehau',
				"CODE" => 'card_rehau_foto',
				"LIST_PAGE_URL" => '',
				"DETAIL_PAGE_URL" => '',
				"IBLOCK_TYPE_ID" => 'services',
				"SITE_ID" => Array(SITE_ID),
				"SORT" => 100,
				"PICTURE" => '',
				"DESCRIPTION" => '',
				"DESCRIPTION_TYPE" => '',
				"GROUP_ID" => Array("2" => "R")
			);
			$ID = $ib->Add($arFields);
			if ($ID) {
				$this->logger->log(sprintf('Iblock "%s" (%s) has been added', 'card_rehau_foto', $ID));
			} else {
				$this->logger->log(sprintf('Unable to add Iblock "%s" (%s) Error:%s', 'card_rehau_foto', $ID,
					$ib->LAST_ERROR));
			}
		} else {
			$this->logger->log(sprintf('Iblock "%s" (%s) already exitst', $arIbRes['CODE'], $arIbRes['ID']));
		}
	}

	/**
	 * Отменяет миграцию
	 */
	public function down()
	{
		throw new \Your\Exception\Common\NotImplementedException('Method "down" was not implement');
	}
}

$migrationIblockCreate = new CreateCardRehauIblock();

try {
	$migrationIblockCreate->up();
} catch (\Your\Exception\Data\Migration\MigrationException $e) {
	echo sprintf('Error of migration apply: "%s"', $e->getMessage()) . PHP_EOL;
}

