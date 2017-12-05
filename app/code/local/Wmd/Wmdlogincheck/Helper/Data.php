<?php
/**
 * Wmd_Wmdlogincheck_Helper_Data
 *
 * WMD Extensions 
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 *
 * @category  Wmd
 * @package   Wmd_Wmdlogincheck
 * @author    Dominik Wyss <info@wmdextensions.com>
 * @copyright 2014 Dominik Wyss | WMD Extensions  
 * @link      http://wmdextensions.com/
 * @license   http://wmdextensions.com/WMD-License-Community.txt 
*/?>
<?php
class Wmd_Wmdlogincheck_Helper_Data extends Mage_Core_Helper_Abstract
{
    
    const CUSTOMER_ACCOUNT_CREATE = 'customer_account_create';
    const CUSTOMER_ACCOUNT_FORGOTPASSWORD = 'customer_account_forgotpassword';
    const DEFAULT_REDIRECT = 'customer/account/login';
    const REDIRECT_ENABLED = 'wmdlogincheck/redirect/enable';
    const REDIRECT_TO_PAGE = 'wmdlogincheck/redirect/redirect_to_page';
    const ENABLED_MODULE = 'wmdlogincheck/general/enable';


    
    protected $_allowedActionNames;
    
    /**
     * return allowed actions. 
     * 
     * @return string
     */	
     
    protected function _returnAllowed()
    {
        if (!$this->_allowedActionNames) {
            $this->_allowedActionNames = Mage::getStoreConfig('wmdlogincheck/actions/allowed');
        }
        return $this->_allowedActionNames;
    } 

    public function getUrltoRedirect(){
        if($this->isEnabledRedirectToPage()){
            
            $url = Mage::getStoreConfig(self::REDIRECT_TO_PAGE);
            if($url == 'home') {
                $url = Mage::getBaseUrl();
            }
        }else{
            $url = self::DEFAULT_REDIRECT;
        }

        return $url;
    }

    /**
    * @return boolean
    *
    */
    public function isEnabledRedirectToPage()
    {
        return (bool)Mage::getStoreConfig(self::REDIRECT_ENABLED);
    }

    /**
    * @return boolean
    *
    */
    public function isEnabled()
    {
        return (bool)Mage::getStoreConfig(self::ENABLED_MODULE);
    }
    
    /**
     * Check for customer_account_forgotpassword in allowed actions. 
     * 
     * @return boolean
     */	 
    public function returnTitle()
    {
        if (!$this->canCreateAccount())
        {
            return $this->__('Login');
        }
        return $this->__('Login or Create an Account'); 
    }
    
    /**
     * Check for customer_account_create in allowed actions. 
     * 
     * @return boolean
     */	 
    public function canCreateAccount()
    {
        if (strstr($this->_returnAllowed(), self::CUSTOMER_ACCOUNT_CREATE))
        {
            return true;
        }
        return false;
    }
    
    /**
     * Check for customer_account_forgotpassword in allowed actions. 
     * 
     * @return boolean
     */	 
    public function canGetNewPassword()
    {
        if (strstr($this->_returnAllowed(), self::CUSTOMER_ACCOUNT_FORGOTPASSWORD))
        {
            return true;
        }
        return false;
    }
        
}