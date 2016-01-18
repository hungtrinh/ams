<?php

namespace Achievement\Student\Model;

/**
 * Defenition a student profile info
 */
interface ProfileInterface
{
    /**
     * @return string
     */
    public function getRegistrationCode();
    
    /**
     * @return string
     */
    public function getPhoneticName();
    
    /**
     * @return string
     */
    public function getFullname();
    
    /**
     * @return \DateTime | null
     */
    public function getDob();
    
    /**
     * @return string
     */
    public function getGender();
    
    /**
     * @return string
     */
    public function getGrade();
    
    /**
     * @return \Achievement\Account\Model\AccountBasicInterface
     */
    public function getAccount();
}
