<?php
/***
 * Model class for the partners
 * Class Goldie_Partnersales_Model_Partners
 */
 
class Goldie_Partnersales_Model_Partners extends Mage_Core_Model_Abstract
{
    const PARTNER_NAME = 'name';
    const PARTNER_ID = 'id';

    protected function _construct()
    {
        $this->_init('goldie_partnersales/partners');
    }

    /****
     * Get partner data by Id
     * @param $id
     *
     * @return array
     */
    public function getPartnerData($id)
    {
        $partnerData = [];
        $partner = $this->load($id,'partner_id');
        $partnerData[self::PARTNER_ID] = $partner->getPartnerId();
        $partnerData[self::PARTNER_NAME] = $partner->getName();

        return $partnerData;
    }
}