<?php


class Observer
{

    /***
     * Set partner cookies when controller before load
     */
    public function setPartnerCookie()
    {

        $partnerId = null;
        $partnerId = Mage::app()->getRequest()->getParam('partner');
        if($partnerId){
            Mage::helper('goldie_partnersales')->setPartnerCookie($partnerId);
        }

    }

}