<?php namespace Lovata\Shopaholic\Controllers;

use Lang;
use Event;
use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use Lovata\Shopaholic\Classes\Event\Warehouse\WarehouseModelHandler;
use Lovata\Shopaholic\Classes\Import\ImportWarehouseModelFromXML;

/**
 * Class Warehouses
 * @package Lovata\Shopaholic\Controllers
 */
class Warehouses extends Controller
{
    /** @var array */
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend\Behaviors\ReorderController',
        'Backend.Behaviors.FormController',
    ];
    /** @var string */
    public $listConfig = 'config_list.yaml';
    /** @var string */
    public $reorderConfig = 'config_reorder.yaml';
    /** @var string */
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    /**
     * Warehouses constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Lovata.Shopaholic', 'shopaholic-menu-warehouses');
    }

    /**
     * Ajax handler onReorder event
     */
    public function onReorder()
    {
        $obResult = parent::onReorder();
        Event::fire(WarehouseModelHandler::EVENT_UPDATE_SORTING);

        return $obResult;
    }

    /**
     * Start import from XML
     */
    public function onImportWarehouseFromXML()
    {
        $obImport = new ImportWarehouseModelFromXML();
        $obImport->import();

        $arReportData = [
            'created' => $obImport->getCreatedCount(),
            'updated' => $obImport->getUpdatedCount(),
            'skipped' => $obImport->getSkippedCount(),
            'processed' => $obImport->getProcessedCount(),
        ];

        Flash::info(Lang::get('lovata.toolbox::lang.message.import_from_xml_report', $arReportData));

        return $this->listRefresh();
    }
}
