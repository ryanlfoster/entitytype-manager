<?php
class Goodahead_Etm_Block_Adminhtml_Entity_Types_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _construct()
    {
        $this->setId('entityTypesGrid');
        $this->_controller = 'adminhtml_entity_types';
        $this->setUseAjax(true);

        //$this->setDefaultSort('id');
        //$this->setDefaultDir('DESC');


    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('goodahead_etm/entity_type')->getCollection();
        $resource = $collection->getResource();

        /*$collection->getSelect()
            ->columns(array('user_name' => 'au.username'))
            ->joinLeft(array('au' => $resource->getTable('admin/user')), 'au.user_id = main_table.user_id', array('username'))
            ->where('(main_table.user_id = 0) OR (main_table.user_id = ?)', Mage::getSingleton('admin/session')->getUser()->getUserId());*/

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }


    protected function _prepareColumns()
    {
        $this->addColumn('entity_type_id', array(
            'header'            => Mage::helper('goodahead_etm')->__('Entity Type ID'),
            'width'             => '100',
            'filter_index'      => 'entity_type_id',
            'index'             => 'entity_type_id',
            'type'              => 'number'
        ));


        $this->addColumn('entity_type_code', array(
            'header'            => Mage::helper('goodahead_etm')->__('Entity Type Code'),
            'filter_index'      => 'entity_type_code',
            'index'             => 'entity_type_code',
            'type'              => 'text'
        ));


        $this->addColumn('entity_type_name', array(
            'header'            => Mage::helper('goodahead_etm')->__('Entity Type Name'),
            'filter_index'      => 'entity_type_name',
            'index'             => 'entity_type_name',
            'type'              => 'text'
        ));


        $this->addColumn('action', array(
            'header'            => Mage::helper('goodahead_etm')->__('Action'),
            'width'             => '100',
            'type'              => 'action',
            'getter'            => 'getId',
            'actions'           => array(
                array(
                    'caption' => Mage::helper('goodahead_etm')->__('Delete'),
                    'url'     => array(
                        'base' => '*/*/delete',
                    ),
                    'field'   => 'entity_type_id',
                    'confirm' => Mage::helper('goodahead_etm')->__('Are you sure?')
                )
            ),
            'filter'            => false,
            'sortable'          => false,
            'index'             => 'entity_type_id',
        ));



        return parent::_prepareColumns();
    }


    public function getRowUrl($template)
    {
        return $this->getUrl('*/*/use', array(
            'id' => $template->getId(),
        ));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}