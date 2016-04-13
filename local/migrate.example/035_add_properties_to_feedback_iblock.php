<?php
/**
 * Миграция добавляет свойства к инфоблоку «Обратная связь»
 */
ignore_user_abort(true);
set_time_limit(0);

define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_STATISTIC', true);
define('STOP_STATISTICS', true);

if (!defined('SITE_ID')) {
	define('SITE_ID', 's1');
}

if (empty($_SERVER['DOCUMENT_ROOT'])) {
	$_SERVER['HTTP_HOST'] = 'momentum.ratio.bz';
	$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
}

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if (!CModule::IncludeModule('iblock')) {
	echo 'Unable to include iblock module';
	exit;
}

use Your\Tools\Data\Migration\Bitrix\AbstractIBlockPropertyMigration;

/**
 * Class AddPropertiesToSMSPromoRequestsIBlockMigration
 */
class AddPropertiesToSMSPromoRequestsIBlockMigration extends AbstractIBlockPropertyMigration
{
	/**
	 * {@inheritdoc}
	 */
	public function up()
	{
		$logger = new \Your\Tools\Logger\EchoLogger();

		try {
			$this->createStringProperty(
				'E-Mail',
				'EMAIL'
			);

			$this->createStringProperty(
				'Телефон',
				'PHONE'
			);

			$logger->log('Properties have been created successfully');
		} catch (\Your\Exception\Data\Migration\MigrationException $exception) {
			$logger->log(sprintf('ERROR: %s', $exception->getMessage()));
		}
	}

	/**
	 * @throws \Your\Exception\Common\NotImplementedException
	 */
	public function down()
	{
		throw new \Your\Exception\Common\NotImplementedException('Method down was not implemented');
	}
}

$iBlockMigrations = new AddPropertiesToSMSPromoRequestsIBlockMigration(
	$environment->get('feedbackIBlockId')
);

$iBlockMigrations->up();
