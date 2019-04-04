<?php

class Goldie_Partnersales_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @var COOKIE_NAME
     */
    const COOKIE_NAME = 'partner_sales';

    /**
     * Set partner cookie
     * @param $partnerId
     */
    public function setPartnerCookie($partnerId)
    {
        if($partnerCookie = Mage::getModel('core/cookie')->get(self::COOKIE_NAME)){
            $partnerData = unserialize($partnerCookie[self::COOKIE_NAME]);
            //we do not need to reset if already exists partner in cookie
            if($partnerData[Goldie_Partnersales_Model_Partners::PARTNER_ID] != $partnerId) {
                $partnerData =  Mage::getModel('goldie_partnersales/partners')->getPartnerData($partnerId);
                Mage::getModel('core/cookie')->set(
                    self::COOKIE_NAME, serialize($partnerData), 86400
                );
            }
        }else{
            //at initial cookieset
            $partnerData =  Mage::getModel('goldie_partnersales/partners')->getPartnerData($partnerId);
            Mage::getModel('core/cookie')->set(
                self::COOKIE_NAME, serialize($partnerData), 86400
            );
        }
    }

    /***
     * Check partner exists in the cookie
     * @return bool
     */
    public function hasPartnerExists()
    {
        if($partnerCookie = Mage::getModel('core/cookie')->get(self::COOKIE_NAME)){
            return true;
        }
        return false;
    }

    /***
     * Get Partner name via cookie
     * @return mixed
     */
    public function getCookiePartnerName()
    {
        if($partnerCookie = Mage::getModel('core/cookie')->get(self::COOKIE_NAME)){
            $partnerData = unserialize($partnerCookie);
            return $partnerData[Goldie_Partnersales_Model_Partners::PARTNER_NAME];
        }
        return;
    }

    /***
     * Clear cookie
     * @throws Exception
     */
    public function clearPartnerCookie()
    {

        if($partnerCookie = Mage::getModel('core/cookie')->get(self::COOKIE_NAME)) {
            Mage::getModel('core/cookie')->delete(self::COOKIE_NAME);
        }
    }
}