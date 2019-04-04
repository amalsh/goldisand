<?php

/***
 * Partners collection for evaluate partners
 * Class Goldie_Partnersales_Model_Resource_Partners_Collection
 */
class Goldie_Partnersales_Model_Resource_Partners_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('goldie_partnersales/partners');
    }

}