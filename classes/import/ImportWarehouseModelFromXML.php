<?php namespace Lovata\Shopaholic\Classes\Import;

use Lang;
use Lovata\Toolbox\Classes\Helper\AbstractImportModelFromXML;

use Lovata\Shopaholic\Models\Warehouse;
use Lovata\Shopaholic\Models\XmlImportSettings;

/**
 * Class ImportWarehouseModelFromXML
 * @package Lovata\Shopaholic\Classes\Import
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class ImportWarehouseModelFromXML extends AbstractImportModelFromXML
{
    const EXTEND_FIELD_LIST = 'shopaholic.warehouse.extend_xml_import_fields';
    const EXTEND_IMPORT_DATA = 'shopaholic.warehouse.extend_xml_import_data';

    const MODEL_CLASS = Warehouse::class;

    /** @var Warehouse */
    protected $obModel;

    /**
     * ImportWarehouseModelFromCSV constructor.
     */
    public function __construct()
    {
        $this->arExistIDList = (array) Warehouse::whereNotNull('external_id')->pluck('external_id', 'id');
        $this->arExistIDList = array_filter($this->arExistIDList);

        $this->prepareImportSettings();

        parent::__construct();
    }

    /**
     * Get import fields
     * @return array
     */
    public function getFields() : array
    {
        $this->arFieldList = [
            'external_id'         => Lang::get('lovata.toolbox::lang.field.external_id'),
            'active'              => Lang::get('lovata.toolbox::lang.field.active'),
            'name'                => Lang::get('lovata.toolbox::lang.field.name'),
            'code'                => Lang::get('lovata.toolbox::lang.field.code'),
            'address'             => Lang::get('lovata.toolbox::lang.field.address'),
            'email'               => Lang::get('lovata.toolbox::lang.field.email'),
            'phone'               => Lang::get('lovata.toolbox::lang.field.phone'),
            'description'         => Lang::get('lovata.toolbox::lang.field.description'),
        ];

        return parent::getFields();
    }

    /**
     * Start import
     * @param $obProgressBar
     * @throws
     */
    public function import($obProgressBar = null)
    {
        parent::import($obProgressBar);

        $this->deactivateElements();
    }

    /**
     * Prepare array of import data
     */
    protected function prepareImportData()
    {
        $this->setActiveField();

        parent::prepareImportData();
    }

    /**
     * Process model object after creation/updating
     */
    protected function processModelObject()
    {
        parent::processModelObject();
    }

    /**
     * Prepare import settings
     */
    protected function prepareImportSettings()
    {
        $this->arXMLFileList = XmlImportSettings::getValue('file_list');

        $this->bDeactivate = (bool) XmlImportSettings::getValue('warehouse_deactivate');
        $this->arImportSettings = XmlImportSettings::getValue('warehouse');
        $this->sElementListPath = XmlImportSettings::getValue('warehouse_path_to_list');

        $iFileNumber = XmlImportSettings::getValue('warehouse_file_path');
        if ($iFileNumber !== null) {
            $this->sMainFilePath = array_get($this->arXMLFileList, $iFileNumber.'.path');
            $this->sPrefix = array_get($this->arXMLFileList, $iFileNumber.'.path_prefix');
            $this->sNamespace = array_get($this->arXMLFileList, $iFileNumber.'.file_namespace');
            $this->sMainFilePath = trim($this->sMainFilePath, '/');
        }
    }
}
