<?php

/**
 * Class Gaboli_Warehouse_Block_Adminhtml_Location_Edit_Tab_Location
 */
class Gaboli_Warehouse_Block_Adminhtml_Location_Edit_Tab_Location extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Prepare form fields and data for Adminhtml Widget Form rendering.
     *
     * @return Gaboli_Warehouse_Block_Adminhtml_Location_Edit_Tab_Location
     */
    protected function _prepareForm()
    {
        $model  = Mage::registry('warehouse_data');
        $isEdit = (bool) $model->getId();

        $form     = new Varien_Data_Form();
        $fieldset = $form->addFieldset('gaboli_warehouse_form', array(
            'legend' => Mage::helper('gaboli_warehouse')->__('Warehouse Information')
        ));

        $this->_prepareFormHiddenFields($fieldset, $isEdit);
        $this->_prepareFormGeneralFields($fieldset);
        $this->_prepareFormAddressFields($fieldset);
        $this->_prepareFormStatusField($fieldset);
        if(!Mage::app()->isSingleStoreMode()) {
            $this->_prepareFormStoreSelectorField($fieldset);
        } else {
            $this->_prepareFormStoreSelectorHiddenField($fieldset);
            $model->setStoreId(Mage::app()->getStore(true)->getId());
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Add hidden fields for id and create/update time to the form.
     *
     * @param $fieldset
     * @param $isEdit
     */
    protected function _prepareFormHiddenFields($fieldset, $isEdit)
    {
        if($isEdit) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addField('created_time', 'hidden', array(
            'name' => 'created_time',
        ));

        $fieldset->addField('update_time', 'hidden', array(
            'name' => 'update_time',
        ));
    }



    /**
     * Add hidden field to specify the current store to the form.
     *
     * @param $fieldset
     */
    protected function _prepareFormStoreSelectorHiddenField($fieldset)
    {
        $fieldset->addField('store_id', 'hidden', array(
            'name'  => 'stores[]',
            'value' => Mage::app()->getStore(true)->getId()
        ));
    }

    /**
     * Add field for store selection to the form.
     *
     * @param $fieldset
     */
    protected function _prepareFormStoreSelectorField($fieldset)
    {
        $field    = $fieldset->addField('store_id', 'multiselect', array(
            'name'     => 'stores[]',
            'label'    => Mage::helper('gaboli_warehouse')->__('Store'),
            'title'    => Mage::helper('gaboli_warehouse')->__('Store'),
            'required' => true,
            'values'   => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false),
        ));
        $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
        $field->setRenderer($renderer);
    }


/**
     * Add status field to the form.
     *
     * @param $fieldset
     */
    protected function _prepareFormStatusField($fieldset)
    {
        $fieldset->addField('status', 'select', array(
            'label'  => Mage::helper('gaboli_warehouse')->__('Status'),
            'name'   => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('gaboli_warehouse')->__('Enabled'),
                ),

                array(
                    'value' => 0,
                    'label' => Mage::helper('gaboli_warehouse')->__('Disabled'),
                ),
            ),
        ));
    }

    /**
     * Add general fields to the form.
     *
     * @param $fieldset
     */
    protected function _prepareFormGeneralFields($fieldset)
    {
        $fieldset->addField('name', 'text', array(
            'label'    => Mage::helper('gaboli_warehouse')->__('Name'),
            'class'    => 'required-entry',
            'required' => true,
            'name'     => 'name',
        ));
    }

    /**
     * Add address fields to the form.
     *
     * @param $fieldset
     */
    protected function _prepareFormAddressFields($fieldset)
    {
        $fieldset->addField('address', 'text', array(
            'label'    => Mage::helper('gaboli_warehouse')->__('Address'),
            'class'    => 'required-entry',
            'required' => true,
            'name'     => 'address',
        ));

        $countryList = Mage::getModel('directory/country')->getCollection()->toOptionArray();
        $country     = $fieldset->addField('country_id', 'select', array(
            'label'    => Mage::helper('gaboli_warehouse')->__('Country'),
            'name'     => 'country_id',
            'title'    => 'country',
            'values'   => $countryList,
        ));

    }
}
