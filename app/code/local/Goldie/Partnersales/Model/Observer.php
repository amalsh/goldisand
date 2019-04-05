<?php

/***
 * Partner sales capture observer
 *
 * Class Goldie_Partnersales_Model_Observer
 */
class Goldie_Partnersales_Model_Observer
{

    /***
     * Set partner cookies when controller before load
     */
    public function setPartnerCookie(Varien_Event_Observer $observer)
    {

        $partnerId = null;
        $partnerId = Mage::app()->getRequest()->getParam('partner');
        //if only parameter exists set cookies
        if ($partnerId != null) {

            Mage::helper('goldie_partnersales')->setPartnerCookie($partnerId);
        }

    }

    /***
     * Split invoces and shipments
     *
     * @param $observer
     */
    public function partnerInvoiceCreator(Varien_Event_Observer $observer)
    {
        $oorderIds = [];
        //if only partner exists we need to split invoices
        if (Mage::helper('goldie_partnersales')->hasPartnerExists()) {
            $oorderIds = $observer->getEvent()->getOrderIds();
            if(count($oorderIds)) {
                $order = Mage::getSingleton('sales/order')->load($oorderIds[0]);
                $splitter = new Goldie_Partnersales_Model_Ordersplitter($order);
                $splitter->splitPartnerSales();
            }
        }
    }
}