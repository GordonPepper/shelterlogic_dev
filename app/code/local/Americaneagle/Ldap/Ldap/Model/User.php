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
                Mage::getSingleton('admin/session')->setInternalName($internalName);
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

    public function getUsername() {
        if ($this->getSessionUser()) {
            $internalName = Mage::getSingleton('admin/session')->getInternalName();
            return parent::getUsername().($internalName != ""?" (".$internalName.")":"");
        } else {
            return parent::getUsername();
        }
    }
}