<?php

/**
 * Class Gaboli_Warehouse_Adminhtml_WarehouseController
 */
class Gaboli_Warehouse_Adminhtml_WarehouseController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Index page
     *
     * @return void
     */
    public function indexAction()
    {
        $this->_initAction()->renderLayout();
    }

    /**
     * New Page (redirects to edit)
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit Page
     *
     * @return void
     */
    public function editAction()
    {
        $this->_initAction();
        $locationId    = $this->getRequest()->getParam('id');
        $locationModel = Mage::getModel('gaboli_warehouse/location');

        if($locationId) {
            $locationModel->load($locationId);
            if(!$locationModel->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This location no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($locationModel->getId() ? $locationModel->getName() : $this->__('New Warehouse'));
        $data = Mage::getSingleton('adminhtml/session')->getStoreData(true);
        if(!empty($data)) {
            $locationModel->setData($data);
        }
        Mage::register('warehouse_data', $locationModel);

        $this->loadLayout();
        $this->_setActiveMenu('catalog/gaboli_warehouse');

        $this->_addBreadcrumb($locationId ? Mage::helper('gaboli_warehouse')->__('Edit Warehouse') : Mage::helper('gaboli_warehouse')->__('New Warehouse'), $locationId ? Mage::helper('gaboli_warehouse')->__('Edit Warehouse') : Mage::helper('gaboli_warehouse')->__('New Warehouse'));

        $this->_addContent($this->getLayout()->createBlock('gaboli_warehouse/adminhtml_location_edit'));
        $this->_addLeft($this->getLayout()->createBlock('gaboli_warehouse/adminhtml_location_edit_tabs'));

        $this->renderLayout();

    }


    /**
     * Save...
     *
     * @return void
     *
     * @TODO Refactor: Current function is too complex needs to be broken down into simpler logic
     */
    public function saveAction()
    {
        if($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('gaboli_warehouse/location');
            if($id = $this->getRequest()->getParam('id')) {
                $model->load($id);
            }

            unset($postData['entity_id']);
            $model->setData($postData);

            try {
                if(is_null($model->getCreatedTime()) || $model->getCreatedTime() == '') {
                    $model->setCreatedTime(time());
                }
                $model->setUpdateTime(time());

                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The Warehouse has been saved.'));
                if($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));

                    return;
                }
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/');

                return;
            }

            Mage::getSingleton('adminhtml/session')->setStoreData($postData);
            $this->_redirectReferer();
        }
    }

    /**
     * Delete action
     *
     * @return void
     */
    public function deleteAction()
    {
        if($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('gaboli_warehouse/location');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('gaboli_warehouse')->__('Warehouse was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Mass Delete Action
     *
     * @return void
     */
    public function massDeleteAction()
    {
        $locationIds = $this->getRequest()->getParam('gaboli_warehouse');
        if(!is_array($locationIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('gaboli_warehouse')->__('Please select a warehouse(s)'));
        } else {
            try {
                foreach ($locationIds as $locationId) {
                    $location = Mage::getModel('gaboli_warehouse/location')
                        ->setId($locationId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('gaboli_warehouse')->__(
                        'Total of %d record(s) were successfully deleted', count($locationIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Mass Update Status Action
     *
     * @return void
     */
    public function massStatusAction()
    {
        $locationIds = $this->getRequest()->getParam('gaboli_warehouse');
        if(!is_array($locationIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select a warehouse(s)'));
        } else {
            try {
                foreach ($locationIds as $locationId) {
                    // Start Refactor Eventually switch this to an adapter mass update
                    Mage::getSingleton('gaboli_warehouse/location')
                        ->load($locationId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->save();
                    // End Refactor
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($locationIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Gaboli_Warehouse_Adminhtml_WarehouseController
     */
    protected function _initAction()
    {

        $this->loadLayout()
            // Make the active menu match the menu config nodes (without 'children' inbetween)
            ->_setActiveMenu('gaboli_warehouse')
            ->_title($this->__('Gaboli'))->_title($this->__('Warehouse'))
            ->_addBreadcrumb($this->__('Gaboli'), $this->__('Gaboli'))
            ->_addBreadcrumb($this->__('Warehouse'), $this->__('Warehouse'));

        return $this;
    }

    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/gaboli_warehouse');
    }

    /**
     * Get country by code.
     *
     * @param $needle
     *
     * @return bool|array
     */
    public function getCountry($needle)
    {
        if(is_null($this->_countries)) {
            $countriesList    = Mage::getResourceModel('directory/country_collection')
                ->loadData()
                ->toOptionArray(false);
            $newCountriesList = array();
            foreach ($countriesList as $key => $val) {
                $newCountriesList[strtolower($val['label'])] = $val['value'];;
            }
            $this->_countries = $newCountriesList;
        }
        $countryCode = str_replace('USA', 'US', strtolower($needle));
        if(isset($this->_countries[$countryCode])) {
            return $this->_countries[$countryCode];
        }

        return false;
    }

    /**
     * Get a list of regions for the selected country (AJAX).
     */
    public function regionAction()
    {
        $countryCode = $this->getRequest()->getParam('country');
        $options     = Mage::helper('gaboli_warehouse')->getRegions($countryCode);

        // @TODO Start Refactor : Loop through this array in a view instead where we don't have to echo.
        foreach ($options as $option) {
            echo '<option value="' . $option['value'] . '">' . $option['label'] . '</option>';
        }
    }
}
