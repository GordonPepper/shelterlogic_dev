<?php
class Americaneagle_Ldap_Model_Session extends Mage_Admin_Model_Session
{
    public function getUser() {
        $user = parent::getUser();
        if ($user) {
            $user->setSessionUser(true);
        }
        return $user;
    }
}