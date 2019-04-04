<?php


class Observer
{

    /***
     * Set partner cookies when controller before load
     */
    public function setPartnerCookie($observer)
    {

        $partnerId = null;
        $partnerId = Mage::app()->getRequest()->getParam('partner');
        //if only parameter exists set cookies
        if ($partnerId) {
            Mage::helper('goldie_partnersales')->setPartnerCookie($partnerId);
        }

    }

    /***
     * Split invoces and shipments
     * @param $observer
     */
    public function partnerInvoiceCreator($observer)
    {   //if only partner exists we need to split invoices
        if (Mage::helper('goldie_partnersales')->hasPartnerExists()) {

        }
    }
}