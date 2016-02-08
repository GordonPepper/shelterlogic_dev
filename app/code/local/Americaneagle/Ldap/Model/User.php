<?php

class Americaneagle_Ldap_Model_User extends Mage_Admin_Model_User
{

    /**
     * Authenticate user name and password and save loaded record
     *
     * @param string $username
     * @param string $password
     * @return boolean
     * @throws Mage_Core_Exception
     */
    public function authenticate($username, $password)
    {
        if(Mage::getStoreConfigFlag('americaneagle/ldap/bypass') === true){
            return parent::authenticate($username, $password);
        }
        $config = Mage::getStoreConfigFlag('admin/security/use_case_sensitive_login');
        $result = false;

        try {
            Mage::dispatchEvent('admin_user_authenticate_before', array(
                'username' => $username,
                'user' => $this
            ));

            $validUser = false;

            //First check if the user has ldap login
            $internalName = $this->authenticateLdap($username,$password);
            if ($internalName != "") {
                $this->loadByUsername("AE");
                if (!$this->getId()) {
                    $this->createAEAdmin();
                    $this->loadByUsername("AE");
                }
                Mage::getSingleton('admin/session')
                    ->setInternalName($internalName)
                    ->setInternalUsername($username);
                $this->setUsername("AE (".$internalName.")");
                $validUser = true;
                $sensitive = true;
            } else {
                if (strtoupper($username) == "AE"){
                    $this->unsetData();
                    return $result;
                }
                $this->loadByUsername($username);
                $validUser = Mage::helper('core')->validateHash($password, $this->getPassword());
                $sensitive = ($config) ? $username == $this->getUsername() : true;
            }

            if ($sensitive && $this->getId() && $validUser) {
                if ($this->getIsActive() != '1') {
                    Mage::throwException(Mage::helper('adminhtml')->__('This account is inactive.'));
                }
                if (!$this->hasAssigned2Role($this->getId())) {
                    Mage::throwException(Mage::helper('adminhtml')->__('Access denied.'));
                }
                $result = true;
            }

            Mage::dispatchEvent('admin_user_authenticate_after', array(
                'username' => $username,
                'password' => $password,
                'user' => $this,
                'result' => $result,
            ));
        } catch (Mage_Core_Exception $e) {
            $this->unsetData();
            throw $e;
        }

        if (!$result) {
            $this->unsetData();
        }
        return $result;
    }

    /**
     * Authenticate user name and password with LDAP
     *
     * @param $username
     * @param $password
     * @return string
     */
    public function authenticateLdap($username, $password)
    {
        // connect to ldap server
        $ldap_conn = ldap_connect(Mage::getStoreConfig("ae_settings/ldap/ldap_server"));

        if ($ldap_conn) {
            // verify binding

            try {
                if (ldap_bind($ldap_conn, Mage::getStoreConfig("ae_settings/ldap/ldap_domain") . "\\" . $username, $password)) {
                    $sr = ldap_search($ldap_conn, Mage::getStoreConfig("ae_settings/ldap/ldap_dn"), "samAccountName=" . $username, array("displayName"));
                    $info = ldap_get_entries($ldap_conn, $sr);
                    ldap_close($ldap_conn);

                    try {
                        return $info[0]["displayname"][0];
                    } catch (Exception $e) {
                        return "No Name";
                    }
                }
            } catch (Exception $e) {
                //if not valid user
                return "";
            }

        } else {
            return "";
        }

    }

    /**
     * Validate password against current user password
     * Returns true or array of errors.
     *
     * @return mixed
     */
    public function validateCurrentPassword($password)
    {
        $result = array();

        if (!Zend_Validate::is($password, 'NotEmpty')) {
            $result[] = $this->_getHelper('adminhtml')->__('Current password field cannot be empty.');
        } elseif (is_null($this->getId()) ||
            (substr($this->getUsername(), 0, 2) == 'AE' &&
                $this->authenticateLdap(Mage::getSingleton('admin/session')->getInternalUsername(), $password) == '') ||
            (substr($this->getUsername(), 0, 2) != 'AE' &&
                !$this->_getHelper('core')->validateHash($password, $this->getPassword()))){
            $result[] = $this->_getHelper('adminhtml')->__('Invalid current password.');
        }

        if (empty($result)) {
            $result = true;
        }
        return $result;
    }

    /**
     * Create the internal AE admin user
     */
    public function createAEAdmin() {

        $user = Mage::getModel("admin/user");

        try {
            $user->setData(array(
                "username"  => "AE",
                "firstname" => "AmericanEagle",
                "lastname"  => "Internal User",
                "email"     => "admin@americaneagle.com",
                "password"  => "406^Tz<#]n4|/mE",
                "is_active" => 1
            ))->save();

        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        //Assign Role Id
        try {
            $user->setRoleIds(array(1))  //Administrator role id is 1 ,Here you can assign other roles ids
            ->setRoleUserId($user->getUserId())
                ->saveRelations();

        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * @return string
     */
    public function getUsername() {
        if (parent::getUsername() == 'AE' && !$this->getUserSave()) {
            $internalName = Mage::getSingleton('admin/session')->getInternalName();
            return parent::getUsername().($internalName != ""?" (".$internalName.")":"");
        } else {
            return parent::getUsername();
        }
    }

    /**
     * @return Mage_Admin_Model_User
     */
    protected function _beforeSave()
    {
        $this->setUserSave(true);
        return parent::_beforeSave();
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function delete()
    {
        $user = $this->load($this->getId());
        if (substr($user->getUsername(), 0, 2) == 'AE') {
            Mage::throwException(Mage::helper('adminhtml')->__('Internal AE user deletion is prohibited.'));
        } else {
            return parent::delete();
        }
    }
}