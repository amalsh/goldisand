<?php
/***
 * Resource class
 * Class Goldie_Partnersales_Model_Resource_Partners
 */
 
class Goldie_Partnersales_Model_Resource_Partners extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('goldie_partnersales/partners', 'partner_id');
    }

}